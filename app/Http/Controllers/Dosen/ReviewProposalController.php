<?php

namespace App\Http\Controllers\Dosen;

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
}
