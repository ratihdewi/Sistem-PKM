<?php

namespace App\Http\Controllers\Dosen;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SubmitLaporanKemajuanReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Document $document)
    {
        $request->validate([
            'komentar' => 'required',
            'hasil_evaluasi' => 'required|mimes:pdf'
        ]);

        $file_hasil_evaluasi = null;
        $status_laporan_kemajuan = $document->status_laporan_kemajuan;
        $comments = json_decode($document->laporan_kemajuan_comments) ?? [];

        if ($request->has('hasil_evaluasi')) {
            $file = $request->hasil_evaluasi;
            $file_name = Carbon::now()->timestamp . '-hasil-evaluasi-' . $file->getClientOriginalName();
            $this->upload($file_name, $file, 'documents/laporan_kemajuan');
            $file_hasil_evaluasi = $file_name;
        }

        $comment = [
            'reviewer' => auth()->user()->name,
            'komentar' => $request->komentar,
            'hasil_evaluasi' => $file_hasil_evaluasi,
            'waktu' => Carbon::now()->timestamp
        ];
        array_push($comments, $comment);

        if ($request->hasil_review == 'setuju') {
            $status_laporan_kemajuan = DocumentStatus::Approved;
        } elseif ($request->hasil_review == 'revisi') {
            $status_laporan_kemajuan = DocumentStatus::Revision;
        }

        $document->fill(['status_laporan_kemajuan' => $status_laporan_kemajuan, 'laporan_kemajuan_comments' => json_encode($comments)]);
        $document->save();

        return redirect(route('review.index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}