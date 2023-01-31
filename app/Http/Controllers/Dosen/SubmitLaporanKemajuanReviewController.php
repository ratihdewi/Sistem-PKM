<?php

namespace App\Http\Controllers\Dosen;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

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
            'hasil_review' => 'required',
            'komentar' => 'required',
            'hasil_evaluasi' => ['mimes:pdf', Rule::when(($request->hasil_review == 'revision'), ['required'])]
        ]);

        $file_hasil_evaluasi = null;
        $status_laporan_kemajuan = $document->status_laporan_kemajuan;
        $comments = json_decode($document->laporan_kemajuan_comments) ?? [];

        if ($request->has('hasil_evaluasi')) {
            $file = $request->hasil_evaluasi;
            $file_name = Carbon::now()->timestamp . '-hasil-evaluasi-' . $file->getClientOriginalName();
            $this->upload($file_name, $file, 'documents/hasil_evaluasi/laporan_kemajuan');
            $file_hasil_evaluasi = $file_name;
        }

        $comment = [
            'reviewer' => auth()->user()->name,
            'status' => DocumentStatus::getDescription($request->hasil_review),
            'komentar' => $request->komentar,
            'file_evaluasi' => $file_hasil_evaluasi,
            'waktu' => Carbon::now()->timestamp
        ];
        array_push($comments, $comment);

        if ($request->hasil_review == 'approved') {
            $status_laporan_kemajuan = DocumentStatus::Approved;
        } elseif ($request->hasil_review == 'revision') {
            $status_laporan_kemajuan = DocumentStatus::Revision;
        }

        $document->fill(['status_laporan_kemajuan' => $status_laporan_kemajuan, 'laporan_kemajuan_comments' => json_encode($comments)]);
        $document->save();

        return redirect(route('review.index'))->with('success', 'Laporan kemajuan berhasil ditinjau');
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
