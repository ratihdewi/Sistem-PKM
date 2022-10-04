<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\PKM\JenisPKM;
use App\Models\PKM\SkemaPKM;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProposalController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id', 'asc')->get();

        return view('page.mahasiswa.proposal.index', compact('documents'));
    }

    public function create()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();
        $data_dosen = User::where('role_id', 2)->get();

        return view('page.mahasiswa.proposal.create', compact('jenis_pkm', 'data_dosen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skema_pkm' => 'required',
            'judul_proposal' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'luaran_proposal' => 'required',
            'proposal' => 'required|mimes:pdf'
        ]);

        $proposal_name = null;
        $file = [];

        if ($request->has('proposal')) {
            $file_proposal = $request->proposal;
            $file_name = Carbon::now()->timestamp . '-' . $file_proposal->getClientOriginalName();
            $this->upload($file_name, $file_proposal, 'documents/proposal');
            $proposal_name = $file_name;
        }

        $file = ["proposal" => [
            'luaran_proposal' => $request->luaran_proposal,
            'file_proposal' => $proposal_name
        ]];

        $validated['skema_pkm_id'] = $request->skema_pkm;
        $validated['berkas'] = json_encode($file);

        Document::create($validated);

        return redirect(route('proposal.index'));
    }

    public function show(Document $document)
    {
        return view('page.mahasiswa.proposal.review', compact('document'));
    }

    public function edit(Document $document)
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();
        $skema_pkm = SkemaPKM::where('jenis_pkm_id', $document->skema_pkm->jenis_pkm->id)->orderBy('id', 'asc')->get();
        $data_dosen = User::where('role_id', 2)->get();

        return view('page.mahasiswa.proposal.update', compact('document', 'jenis_pkm', 'skema_pkm', 'data_dosen'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'skema_pkm' => 'required',
            'judul_proposal' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'luaran_proposal' => 'required',
            'proposal' => 'nullable|mimes:pdf'
        ]);

        $proposal_name = null;
        $file = (array) $document->berkas;

        if ($request->has('proposal')) {
            $file_proposal = $request->proposal;
            $file_name = Carbon::now()->timestamp . '-' . $file_proposal->getClientOriginalName();
            $this->upload($file_name, $file_proposal, 'documents/proposal');
            $proposal_name = $file_name;

            unlink(public_path("documents/proposal/{$document->berkas->proposal->file_proposal}"));
        }

        $file['proposal'] = [
            'luaran_proposal' => $request->luaran_proposal,
            'file_proposal' => $proposal_name ?? $document->berkas->proposal->file_proposal
        ];

        $validated['skema_pkm_id'] = $request->skema_pkm;
        $validated['berkas'] = json_encode($file);

        $document->fill($validated);
        $document->save();

        return redirect(route('proposal.index'));
    }

    public function destroy(Document $document)
    {
        if (isset($document->berkas->laporan_akhir)) {
            if ($document->berkas->laporan_akhir->luaran_laporan_akhir != null || $document->berkas->laporan_akhir->file_laporan_akhir != null) {
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->luaran_laporan_akhir}")));
                unlink((public_path("documents/laporan_akhir/{$document->berkas->laporan_akhir->file_laporan_akhir}")));
            }
        }

        if (isset($document->berkas->laporan_kemajuan)) {
            if ($document->berkas->laporan_kemajuan->luaran_laporan_kemajuan != null || $document->berkas->laporan_kemajuan->file_laporan_kemajuan != null) {
                unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->luaran_laporan_kemajuan}")));
                unlink((public_path("documents/laporan_kemajuan/{$document->berkas->laporan_kemajuan->file_laporan_kemajuan}")));
            }
        }

        unlink(public_path("documents/proposal/{$document->berkas->proposal->file_proposal}"));
        $document->delete();

        return redirect(route('proposal.index'));
    }

    public function skema_pkm($parent_id)
    {
        $skema_pkm = SkemaPKM::where('jenis_pkm_id', $parent_id)->orderBy('id', 'asc')->get();

        return $skema_pkm;
    }

    public function mahasiswa(Request $request)
    {
        $data = User::where('username', $request->mhs)->first();

        return $data->name ?? 'Nama Tidak Ditemukan';
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
