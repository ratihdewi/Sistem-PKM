<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentOwner;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarUsulanController extends Controller
{
    public function index()
    {
        $documents = Document::with(['skema_pkm', 'document_owners'])->get();
        $documents->transform(function ($item) {
            $ketua = User::where('id', (int) $item->document_owners->id_ketua)->first();

            return [
                'id' => $item->id,
                'tahun' => $item->created_at->format('Y'),
                'skema_pkm' => $item->skema_pkm->name,
                'judul_pengajuan' => $item->judul_proposal,
                'nama_ketua' => $ketua->name,
                'nim_ketua' => $ketua->nomor_induk,
                'data_reviewer' => $item->document_owners->data_reviewer
            ];
        });

        $reviewers = $this->reviewers();

        return view('page.admin.daftar_usulan.index', compact('documents', 'reviewers'));
    }

    public function reviewers()
    {
        return User::userRoleId(2)->active()->reviewer()->get();
    }

    public function add_reviewer(Request $request)
    {
        $document_owners = DocumentOwner::where('document_id', (int) $request->document_id)->first();
        $id_reviewer = json_decode($document_owners->id_reviewer);

        foreach ($request->anggota as $data) {
            array_push($id_reviewer, $data);
        }

        $id_reviewer = array_unique($id_reviewer);
        $document_owners->id_reviewer = json_encode(array_values($id_reviewer) ?? []);
        $document_owners->save();

        return redirect(route('daftar-usulan.index'));
    }

    public function delete_reviewer(Request $request)
    {
        $document_owners = DocumentOwner::where('document_id', (int) $request->document_id)->first();
        $id_reviewer = json_decode($document_owners->id_reviewer);

        if (in_array($request->reviewer_id, $id_reviewer)) {
            if (($key = array_search($request->reviewer_id, $id_reviewer)) !== false) {
                unset($id_reviewer[$key]);
            }
        }

        $document_owners->id_reviewer = json_encode(array_values($id_reviewer) ?? []);
        $document_owners->save();

        return redirect(route('daftar-usulan.index'));
    }
}
