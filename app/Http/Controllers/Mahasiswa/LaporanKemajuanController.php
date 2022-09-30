<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'luaran_laporan_kemajuan' => 'required|mimes:pdf',
            'laporan_kemajuan' => 'required|mimes:pdf'
        ]);

        $luaran_laporan_kemajuan = null;
        $file_laporan_kemajuan = null;
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

        $validated['status_laporan_kemajuan'] = DocumentStatus::Submitted;
        $validated['berkas'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('laporan-kemajuan.index'));
    }

    public function destroy(Document $document)
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

        return redirect(route('laporan-kemajuan.index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
