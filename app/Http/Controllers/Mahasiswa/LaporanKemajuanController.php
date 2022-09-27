<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id', 'asc')->get();

        return view('page.mahasiswa.laporan.index', compact('documents'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Document $document)
    {
        return view('page.mahasiswa.laporan.review', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('page.mahasiswa.laporan.update', compact('document'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
