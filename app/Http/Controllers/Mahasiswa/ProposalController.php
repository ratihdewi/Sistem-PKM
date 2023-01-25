<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentBudget;
use App\Models\DocumentCheck;
use App\Models\DocumentOwner;
use App\Models\Master\JenisPKM;
use App\Models\Master\SkemaPKM;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProposalController extends Controller
{
    public function index()
    {
        $documents = Document::with('skema_pkm')->whereHas('document_owners', function ($q) {
            $q->where('id_ketua', (string) auth()->user()->id)->orWhereJsonContains('id_anggota', (string) auth()->user()->id);
        })->get();

        return view('page.mahasiswa.proposal.index', compact('documents'));
    }

    public function create()
    {
        $jenis_pkm = JenisPKM::where('is_active', 1)->orderBy('id', 'asc')->get();
        $data_dosen = User::userRoleId(2)->get();

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
            'proposal' => 'required|mimes:pdf',
            'anggota' => 'required',
            'dosen_pendamping' => 'required'
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

        $document = Document::create($validated);

        $id_mahasiswa = $request->anggota_id;
        $id_mahasiswa = array_unique($id_mahasiswa);

        if (in_array((string) auth()->user()->id, $id_mahasiswa)) {
            if (($key = array_search((string)auth()->user()->id, $id_mahasiswa)) !== false) {
                unset($id_mahasiswa[$key]);
            }
        }

        DocumentOwner::create([
            'document_id' => $document->id,
            'id_dosen' => $request->dosen_pendamping,
            'id_ketua' => strval(auth()->user()->id),
            'id_anggota' => json_encode(array_values($id_mahasiswa) ?? [])
        ]);

        DocumentCheck::create([
            'document_id' => $document->id
        ]);

        return redirect(route('proposal.index'));
    }

    public function show(Document $document)
    {
        $comments = collect(json_decode($document->proposal_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        return view('page.mahasiswa.proposal.review', compact('document', 'comments'));
    }

    public function edit(Document $document)
    {
        $jenis_pkm = JenisPKM::where('is_active', 1)->orderBy('id', 'asc')->get();
        $data_dosen = User::userRoleId(2)->get();

        return view('page.mahasiswa.proposal.update', compact('document', 'jenis_pkm', 'data_dosen'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'skema_pkm' => 'required',
            'judul_proposal' => 'required',
            'pendanaan_dikti' => 'required',
            'pendanaan_pt' => 'required',
            'luaran_proposal' => 'required',
            'proposal' => 'nullable|mimes:pdf',
            'anggota_1' => 'required',
            'anggota_2' => 'nullable',
            'anggota_3' => 'nullable',
            'anggota_4' => 'nullable',
            'dosen_pendamping' => 'required'
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

        DocumentOwner::where('document_id', $document->id)->update([
            'id_dosen' => $request->dosen_pendamping,
            'id_mahasiswa' => json_encode([$request->anggota_1_id, $request->anggota_2_id, $request->anggota_3_id, $request->anggota_4_id] ?? [])
        ]);

        return redirect(route('proposal.index'));
    }

    public function destroy(Document $document)
    {
        DocumentOwner::where('document_id', $document->id)->delete();
        DocumentCheck::where('document_id', $document->id)->delete();

        $document_budgets = DocumentBudget::where('document_id', $document->id)->get();

        foreach ($document_budgets as $data) {
            unlink((public_path("documents/bukti_transaksi/{$data->bukti_transaksi}")));
            $data->delete();
        }

        if (isset($document->laporan_akhir_comments)) {
            foreach (json_decode($document->laporan_akhir_comments) as $data) {
                if ($data->file_evaluasi !== null) unlink((public_path("documents/hasil_evaluasi/laporan_akhir/{$data->file_evaluasi}")));
            }
        }

        if (isset($document->laporan_kemajuan_comments)) {
            foreach (json_decode($document->laporan_kemajuan_comments) as $data) {
                if ($data->file_evaluasi !== null) unlink((public_path("documents/hasil_evaluasi/laporan_kemajuan/{$data->file_evaluasi}")));
            }
        }

        if (isset($document->proposal_comments)) {
            foreach (json_decode($document->proposal_comments) as $data) {
                if ($data->file_evaluasi !== null) unlink((public_path("documents/hasil_evaluasi/proposal/{$data->file_evaluasi}")));
            }
        }

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
        $data = User::where('nomor_induk', $request->mhs)->first();

        return $data ?? null;
    }

    private function upload($name, UploadedFile $file, $folder)
    {
        $destination_path = $folder;
        $file->move($destination_path, $name);
    }
}
