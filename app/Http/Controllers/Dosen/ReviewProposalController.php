<?php

namespace App\Http\Controllers\Dosen;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewProposalController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('document_owners', function ($q) {
            $q->where('id_dosen', (string) auth()->user()->id);
        })->get();

        return view('page.dosen.review.index', compact('documents'));
    }

    public function proposal(Document $document)
    {
        $comments = collect(json_decode($document->proposal_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        return view('page.dosen.review.proposal', compact('document', 'comments'));
    }

    public function laporan_kemajuan(Document $document)
    {
        $comments = collect(json_decode($document->laporan_kemajuan_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        if ($document->status_laporan_kemajuan === 'not_submitted') {
            return back();
        }

        return view('page.dosen.review.laporan_kemajuan', compact('document', 'comments'));
    }

    public function laporan_akhir(Document $document)
    {
        $comments = collect(json_decode($document->laporan_akhir_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        if ($document->status_laporan_akhir === 'not_submitted') {
            return back();
        }

        return view('page.dosen.review.laporan_akhir', compact('document', 'comments'));
    }
}
