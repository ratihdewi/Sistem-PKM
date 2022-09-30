<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class LaporanAkhirController extends Controller
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
        $file = (array) $document->berkas;

        if (!array_key_exists('laporan_kemajuan', $file)) {
            return back();
        }

        return view('page.mahasiswa.laporan.update', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'luaran_laporan_akhir' => 'required|mimes:pdf',
            'laporan_akhir' => 'required|mimes:pdf'
        ]);

        $luaran_laporan_akhir = null;
        $file_laporan_akhir = null;
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

        $validated['status_laporan_akhir'] = DocumentStatus::Submitted;
        $validated['berkas'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('laporan-akhir.index'));
    }

    public function destroy(Document $document)
    {
        $file = (array) $document->berkas;

        if (isset($document->berkas->laporan_akhir)) {
            if ($document->berkas->laporan_akhir->luaran_laporan_akhir != null || $document->berkas->laporan_akhir->file_laporan_akhir != null) {
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->luaran_laporan_akhir}")));
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->file_laporan_akhir}")));
            }

            unset($file['laporan_akhir']);
        }

        $document->fill(['berkas' => json_encode($file), 'status_laporan_akhir' => DocumentStatus::NotSubmitted]);
        $document->save();

        return redirect(route('laporan-akhir.index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
