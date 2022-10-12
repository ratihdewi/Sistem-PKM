<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentBudget;
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

    public function create(Request $request, Document $document)
    {
        $budgets = $this->budget($document->id);

        if ($request->is('laporan-akhir*')) {
            $file = (array) $document->berkas;

            if (!array_key_exists('laporan_kemajuan', $file)) {
                return back();
            }

            return view('page.mahasiswa.laporan.update', compact('document', 'budgets'));
        } else {
            return view('page.mahasiswa.laporan.update', compact('document', 'budgets'));
        }
    }

    public function pengeluaran(Request $request)
    {
        $validated = $request->validate([
            'deskripsi_item' => 'required',
            'jumlah' => 'required',
            'harga_satuan' => 'required'
        ]);

        $validated['document_id'] = $request->document_id;
        $validated['bukti_transaksi'] = 'test';

        $budget = DocumentBudget::create($validated);

        $budgets = $this->budget((int) $request->document_id);

        return $budgets;
    }

    private function budget($document_id)
    {
        $budgets = DocumentBudget::where('document_id', $document_id)->get();

        return $budgets;
    }
}
