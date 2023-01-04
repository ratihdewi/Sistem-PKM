<?php

namespace App\Http\Controllers\Mahasiswa\LaporanAkhir;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DeleteLaporanAkhirController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Document $document)
    {
        $file = (array) $document->berkas;

        if (isset($document->laporan_akhir_comments)) {
            foreach (json_decode($document->laporan_akhir_comments) as $data) {
                if ($data->file_evaluasi !== null) unlink((public_path("documents/hasil_evaluasi/laporan_akhir/{$data->file_evaluasi}")));
            }
        }

        if (isset($document->berkas->laporan_akhir)) {
            if ($document->berkas->laporan_akhir->luaran_laporan_akhir != null || $document->berkas->laporan_akhir->file_laporan_akhir != null) {
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->luaran_laporan_akhir}")));
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->file_laporan_akhir}")));
            }

            unset($file['laporan_akhir']);
        }

        $document->fill(['berkas' => json_encode($file), 'status_laporan_akhir' => DocumentStatus::NotSubmitted, 'laporan_akhir_comments' => null]);
        $document->save();

        return redirect(route('laporan.index'));
    }
}
