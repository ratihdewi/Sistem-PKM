<?php

namespace App\Http\Controllers\Dosen;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCheck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SubmitProposalReviewController extends Controller
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
            'hasil_evaluasi' => 'nullable|mimes:pdf'
        ]);

        $file_hasil_evaluasi = null;
        $status_proposal = $document->status_proposal;
        $comments = json_decode($document->proposal_comments) ?? [];

        if ($request->has('hasil_evaluasi')) {
            $file = $request->hasil_evaluasi;
            $file_name = Carbon::now()->timestamp . '-hasil-evaluasi-' . $file->getClientOriginalName();
            $this->upload($file_name, $file, 'documents/hasil_evaluasi/proposal');
            $file_hasil_evaluasi = $file_name;
        }

        $comment = [
            'reviewer' => auth()->user()->name,
            'komentar' => $request->komentar,
            'file_evaluasi' => $file_hasil_evaluasi,
            'waktu' => Carbon::now()->timestamp
        ];
        array_push($comments, $comment);

        if ($request->hasil_review == 'setuju') {
            $status_proposal = DocumentStatus::Approved;
        } elseif ($request->hasil_review == 'revisi') {
            $status_proposal = DocumentStatus::Revision;
        }

        $document->fill(['status_proposal' => $status_proposal, 'proposal_comments' => json_encode($comments)]);
        $document->save();

        DocumentCheck::where('document_id', $document->id)->update([
            'kreativitas' => ($request->has('kreativitas')) ? 0 : 1,
            'bidang_pkm' => ($request->has('bidang_pkm')) ? 0 : 1,
            'kelengkapan_dokumen' => ($request->has('kelengkapan_dokumen')) ? 0 : 1,
            'personalia_pendamping' => ($request->has('personalia_pendamping')) ? 0 : 1,
            'dana_pendamping' => ($request->has('dana_pendamping')) ? 0 : 1,
            'luaran' => ($request->has('luaran')) ? 0 : 1,
            'format_inti' => ($request->has('format_inti')) ? 0 : 1,
            'format_pendukung' => ($request->has('format_pendukung')) ? 0 : 1,
        ]);

        return redirect(route('review.index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
