<?php

namespace App\Http\Controllers\Mahasiswa\LaporanKemajuan;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class SubmitLaporanKemajuanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Document $document)
    {
        $validated = $request->validate([
            'luaran_laporan_kemajuan' => ['mimes:pdf', Rule::when(($request->key === 'submit'), ['required'])],
            'laporan_kemajuan' => ['mimes:pdf', Rule::when(($request->key === 'submit'), ['required'])]
        ]);

        $luaran_laporan_kemajuan = $document->berkas->laporan_kemajuan->luaran_laporan_kemajuan ?? null;
        $file_laporan_kemajuan = $document->berkas->laporan_kemajuan->file_laporan_kemajuan ?? null;
        $file = (array) $document->berkas;

        if ($request->has('luaran_laporan_kemajuan')) {
            $file_luaran = $request->luaran_laporan_kemajuan;
            $file_name = Carbon::now()->timestamp . '-luaran-' . $file_luaran->getClientOriginalName();
            $this->upload($file_name, $file_luaran, 'documents/laporan_kemajuan');
            $luaran_laporan_kemajuan = $file_name;

            if (isset($document->berkas->laporan_kemajuan)) {
                if (file_exists(public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->luaran_laporan_kemajuan}"))) {
                    unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->luaran_laporan_kemajuan}")));
                }
            }
        }

        if ($request->has('laporan_kemajuan')) {
            $file_laporan = $request->laporan_kemajuan;
            $file_name = Carbon::now()->timestamp . '-' . $file_laporan->getClientOriginalName();
            $this->upload($file_name, $file_laporan, 'documents/laporan_kemajuan');
            $file_laporan_kemajuan = $file_name;

            if (isset($document->berkas->laporan_kemajuan)) {
                if (file_exists(public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->file_laporan_kemajuan}"))) {
                    unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->file_laporan_kemajuan}")));
                }
            }
        }

        $file["laporan_kemajuan"] = [
            "luaran_laporan_kemajuan" => $luaran_laporan_kemajuan,
            "file_laporan_kemajuan" => $file_laporan_kemajuan
        ];

        if ($request->key === 'submit') $validated['status_laporan_kemajuan'] = DocumentStatus::Submitted;
        $validated['berkas'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('laporan.index'))->with('success', $this->message($request->key));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }

    private function message($key): string
    {
        if ($key === 'submit') {
            return 'Laporan kemajuan berhasil diajukan';
        } elseif ($key === 'edit') {
            return 'Laporan kemajuan berhasil diubah';
        }

        return '';
    }
}
