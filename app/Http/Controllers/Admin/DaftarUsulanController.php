<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentOwner;
use App\Models\User;
use Carbon\Carbon;
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
                'status_proposal' => $item->status_proposal,
                'status_laporan_kemajuan' => $item->status_laporan_kemajuan,
                'status_laporan_akhir' => $item->status_laporan_akhir,
                'nama_ketua' => $ketua->name,
                'nim_ketua' => $ketua->nomor_induk,
                'data_reviewer' => $item->document_owners->data_reviewer
            ];
        });

        return view('page.admin.daftar_usulan.index', compact('documents'));
    }

    public function review(Document $document)
    {
        $proposal_comments = collect(json_decode($document->proposal_comments));
        $proposal_comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        $laporan_kemajuan_comments = collect(json_decode($document->laporan_kemajuan_comments));
        $laporan_kemajuan_comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        $laporan_akhir_comments = collect(json_decode($document->laporan_akhir_comments));
        $laporan_akhir_comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        return view('page.admin.daftar_usulan.review', compact('proposal_comments', 'laporan_kemajuan_comments', 'laporan_akhir_comments'));
    }

    public function reviewer(Document $document)
    {
        $data_reviewer = $this->reviewers();
        $reviewers = $document->document_owners->data_reviewer;
        $proposal_comments = json_decode($document->document_owners->document->proposal_comments);

        return view('page.admin.daftar_usulan.reviewer', compact('document', 'data_reviewer', 'reviewers', 'proposal_comments'));
    }

    public function add_reviewer(Request $request)
    {
        $document_owners = DocumentOwner::where('document_id', (int) $request->document_id)->first();
        $id_reviewer = json_decode($document_owners->id_reviewer);

        foreach ($request->anggota as $data) {
            if ($data !== $document_owners->id_dosen) {
                array_push($id_reviewer, $data);
            }
        }

        $id_reviewer = array_unique($id_reviewer);
        $document_owners->id_reviewer = json_encode(array_values($id_reviewer) ?? []);
        $document_owners->save();

        return back()->with('success', 'Berhasil menambahkan reviewer');
    }

    public function delete_reviewer(Request $request)
    {
        $document_owners = DocumentOwner::where('document_id', (int) $request->document_id)->first();
        $id_reviewer = json_decode($document_owners->id_reviewer);

        $proposal_comments = json_decode($document_owners->document->proposal_comments);
        $checkReviewerApproval = array_search($request->reviewer_name, array_column($proposal_comments, 'reviewer'));

        if ($checkReviewerApproval !== false) {
            return back();
        }

        if (in_array($request->reviewer_id, $id_reviewer)) {
            if (($key = array_search($request->reviewer_id, $id_reviewer)) !== false) {
                unset($id_reviewer[$key]);
            }
        }

        $document_owners->id_reviewer = json_encode(array_values($id_reviewer) ?? []);
        $document_owners->save();

        return back()->with('success', 'Berhasil menghapus reviewer');
    }

    public function reviewers()
    {
        return User::userRoleId(2)->active()->reviewer()->get();
    }
}
