<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class LaporanController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('document_owners', function ($q) {
            $q->whereJsonContains('id_mahasiswa', (string) auth()->user()->id);
        })->get();

        return view('page.mahasiswa.laporan.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('page.mahasiswa.laporan.review', compact('document'));
    }

    public function create(Request $request, Document $document)
    {
        $key = 'submit';
        $budgets = DocumentBudget::where('document_id', $document->id)->get();

        if ($request->is('laporan-akhir*')) {
            $file = (array) $document->berkas;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key'));
        } else {
            if ($request->is('laporan-kemajuan*') && $document->status_proposal !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key'));
        }
    }

    public function edit(Request $request, Document $document)
    {
        $key = 'edit';
        $budgets = DocumentBudget::where('document_id', $document->id)->get();

        if ($request->is('laporan-akhir*')) {
            $file = (array) $document->berkas;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key'));
        } else {
            if ($request->is('laporan-kemajuan*') && $document->status_proposal !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key'));
        }
    }

    public function pengeluaran(Request $request)
    {
        $validated = $request->validate([
            'deskripsi_item' => 'required',
            'jumlah' => 'required',
            'harga_satuan' => 'required',
            'bukti_transaksi' => 'required'
        ]);

        if ($request->has('bukti_transaksi')) {
            $file = $request->bukti_transaksi;
            $file_name = Carbon::now()->timestamp . '-' . $file->getClientOriginalName();
            $this->upload($file_name, $file, 'documents/bukti_transaksi');
            $validated['bukti_transaksi'] = $file_name;
        }

        $validated['document_id'] = $request->document_id;

        DocumentBudget::create($validated);

        return back();
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
