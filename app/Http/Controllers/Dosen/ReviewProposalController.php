<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewProposalController extends Controller
{
    public function index()
    {
        return view('page.dosen.review.index');
    }
}
