<?php

namespace App\Http\Controllers\Mahasiswa\LaporanAkhir;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class SubmitLaporanAkhirController extends Controller
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
            'luaran_laporan_akhir' => ['mimes:pdf', Rule::when(($request->key === 'submit'), ['required'])],
            'laporan_akhir' => ['mimes:pdf', Rule::when(($request->key === 'submit'), ['required'])]
        ]);

        $luaran_laporan_akhir = $document->berkas->laporan_akhir->luaran_laporan_akhir ?? null;
        $file_laporan_akhir = $document->berkas->laporan_akhir->file_laporan_akhir ?? null;
        $file = (array) $document->berkas;

        if ($request->has('luaran_laporan_akhir')) {
            $file_luaran = $request->luaran_laporan_akhir;
            $file_name = Carbon::now()->timestamp . '-luaran-' . $file_luaran->getClientOriginalName();
            $this->upload($file_name, $file_luaran, 'documents/laporan_akhir');
            $luaran_laporan_akhir = $file_name;

            if (isset($document->berkas->laporan_akhir)) {
                if (file_exists(public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->luaran_laporan_akhir}"))) {
                    unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->luaran_laporan_akhir}")));
                }
            }
        }

        if ($request->has('laporan_akhir')) {
            $file_laporan = $request->laporan_akhir;
            $file_name = Carbon::now()->timestamp . '-' . $file_laporan->getClientOriginalName();
            $this->upload($file_name, $file_laporan, 'documents/laporan_akhir');
            $file_laporan_akhir = $file_name;

            if (isset($document->berkas->laporan_akhir)) {
                if (file_exists(public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->file_laporan_akhir}"))) {
                    unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->file_laporan_akhir}")));
                }
            }
        }

        $file["laporan_akhir"] = [
            "luaran_laporan_akhir" => $luaran_laporan_akhir,
            "file_laporan_akhir" => $file_laporan_akhir
        ];

        if ($request->key === 'submit') $validated['status_laporan_akhir'] = DocumentStatus::Submitted;
        $validated['berkas'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('laporan.index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
