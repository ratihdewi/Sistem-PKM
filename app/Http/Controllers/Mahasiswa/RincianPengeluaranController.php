<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DocumentBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class RincianPengeluaranController extends Controller
{

    public function create(Request $request)
    {
        $laporan_akhir_status = filter_var($request->laporan_akhir_status, FILTER_VALIDATE_BOOLEAN);

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
        if ($laporan_akhir_status) $validated['flag'] = 1;

        DocumentBudget::create($validated);

        return back();
    }

    public function update(Request $request)
    {
        $item = DocumentBudget::where('id', (int)$request->document_budget_id)->first();

        $validated = $request->validate([
            'deskripsi_item' => 'required',
            'jumlah' => 'required',
            'harga_satuan' => 'required',
            'bukti_transaksi' => 'nullable'
        ]);

        if ($request->has('bukti_transaksi')) {
            $file = $request->bukti_transaksi;
            $file_name = Carbon::now()->timestamp . '-' . $file->getClientOriginalName();
            $this->upload($file_name, $file, 'documents/bukti_transaksi');
            $validated['bukti_transaksi'] = $file_name;

            unlink(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}"));
        }

        $item->update($validated);

        return back();
    }

    public function delete(DocumentBudget $item)
    {
        unlink(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}"));
        $item->delete();

        return back();
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
