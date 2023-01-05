<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityDocument;
use App\Models\Master\JenisSurat;
use App\Models\Master\TahunAkademik;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PengaturanDokumenController extends Controller
{
    public function create()
    {
        $jenis_surat = JenisSurat::orderBy('id', 'asc')->get();
        $tahun_akademik = TahunAkademik::orderBy('tahun', 'asc')->get();
        $data_dosen = User::userRoleId(2)->get();

        return view('page.admin.pengaturan_dokumen.create', compact('jenis_surat', 'tahun_akademik', 'data_dosen'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'file_name' => 'required',
            'file_sk' => 'required|mimes:pdf'
        ]);

        if ($request->has('file_sk')) {
            $file_sk = $request->file_sk;
            $file_name = Carbon::now()->timestamp . '-' . $file_sk->getClientOriginalName();
            $this->upload($file_name, $file_sk, 'activity_documents');
            $validated['file_sk'] = $file_name;
        }

        $validated['jenis_surat_id'] = (int) $request->jenis_surat;
        $validated['tahun_akademik_id'] = (int) $request->periode_akademik;
        $validated['id_reviewer'] = json_encode($request->reviewer ?? []);
        ActivityDocument::create($validated);

        return redirect(route('index'));
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
