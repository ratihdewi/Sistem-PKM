<?php

namespace App\Http\Controllers\Dosen;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
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
        return view('page.dosen.review.proposal', compact('document'));
    }

    public function laporan_kemajuan(Document $document)
    {
        if ($document->status_laporan_kemajuan === 'not_submitted') {
            return back();
        }

        return view('page.dosen.review.laporan_kemajuan', compact('document'));
    }

    public function laporan_akhir(Document $document)
    {
        if ($document->status_laporan_akhir === 'not_submitted') {
            return back();
        }

        return view('page.dosen.review.laporan_akhir', compact('document'));
    }
}
