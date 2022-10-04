<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id', 'asc')->get();

        return view('page.mahasiswa.laporan.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('page.mahasiswa.laporan.review', compact('document'));
    }

    public function edit(Request $request, Document $document)
    {
        if ($request->is('laporan-akhir*')) {
            $file = (array) $document->berkas;

            if (!array_key_exists('laporan_kemajuan', $file)) {
                return back();
            }

            return view('page.mahasiswa.laporan.update', compact('document'));
        } else {
            return view('page.mahasiswa.laporan.update', compact('document'));
        }
    }
}
