<?php

namespace App\Http\Controllers;

use App\Models\ActivityDocument;
use App\Models\Document;
use App\Models\Master\Prodi;
use App\Models\Master\SkemaPKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (Gate::allows('mahasiswa')) {
            $peran = $this->checkFileRole();

            return view('page.index', compact('peran'));
        } else if (Gate::allows('dosen')) {
            $dokumen = ActivityDocument::with(['jenis_surat', 'tahun_akademik'])->orderBy('id', 'asc')->get();

            return view('page.index', compact('dokumen'));
        } else {
            $skema_pkm = SkemaPKM::with(['jenis_pkm', 'documents'])->orderBy('id', 'asc')->get();
            $prodi = Prodi::orderBy('id', 'asc')->get();

            return view('page.index', compact('skema_pkm', 'prodi'));
        }
    }

    private function checkFileRole(): string
    {
        $doc_ketua = Document::whereHas('document_owners', fn ($q) => $q->where('id_ketua', (string) auth()->user()->id))->first();

        if ($doc_ketua) {
            return 'Ketua';
        } else {
            $doc_anggota = Document::whereHas('document_owners', fn ($q) => $q->whereJsonContains('id_anggota', (string) auth()->user()->id))->first();

            if ($doc_anggota) {
                return 'Anggota';
            }

            return '-';
        }
    }
}
