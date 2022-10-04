<?php

namespace App\Http\Controllers\Mahasiswa\LaporanKemajuan;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DeleteLaporanKemajuanController extends Controller
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

        if (array_key_exists('laporan_akhir', $file)) {
            return back();
        }

        if (isset($document->berkas->laporan_kemajuan)) {
            if ($document->berkas->laporan_kemajuan->luaran_laporan_kemajuan != null || $document->berkas->laporan_kemajuan->file_laporan_kemajuan != null) {
                unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->luaran_laporan_kemajuan}")));
                unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->file_laporan_kemajuan}")));
            }

            unset($file['laporan_kemajuan']);
        }

        $document->fill(['berkas' => json_encode($file), 'status_laporan_kemajuan' => DocumentStatus::NotSubmitted]);
        $document->save();

        return redirect(route('laporan.index'));
    }
}
