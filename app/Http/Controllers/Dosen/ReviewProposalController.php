<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewProposalController extends Controller
{
    public function index()
    {
        $documents = Document::query();

        if (Gate::allows('is_reviewer')) {
            $documents = $documents->with('skema_pkm')->whereHas('document_owners', function ($q) {
                $q->where('id_dosen', (string) auth()->user()->id)->orWhereJsonContains('id_reviewer', (string) auth()->user()->id);
            })->get();
        } else {
            $documents = $documents->with(['skema_pkm', 'document_owners'])->whereHas('document_owners', function ($q) {
                $q->where('id_dosen', (string) auth()->user()->id);
            })->get();
        }

        return view('page.dosen.review.index', compact('documents'));
    }

    public function proposal(Document $document)
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

        $data_ketua = $document->document_owners->data_mahasiswa->first(function ($item) use ($document) {
            return $item->id == (int) $document->document_owners->id_ketua;
        });
        $data_anggota = $document->document_owners->data_mahasiswa->filter(function ($item) use ($document) {
            return in_array($item->id, array_map('intval',  json_decode($document->document_owners->id_anggota)));
        });

        return view('page.dosen.review.proposal', compact('document', 'comments', 'data_ketua', 'data_anggota'));
    }

    public function laporan_kemajuan(Document $document)
    {
        $comments = collect(json_decode($document->laporan_kemajuan_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        if ($document->status_laporan_kemajuan === 'not_submitted') {
            return back();
        }

        $laporan_kemajuan_budgets = $document->document_budgets->filter(fn ($item) => $item->flag === 0);
        $laporan_kemajuan_budgets->transform(function ($item) {
            $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

            return [
                'deskripsi_item' => $item->deskripsi_item,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->harga_satuan,
                'bukti_transaksi' => $item->bukti_transaksi,
                'is_image' => $is_image
            ];
        });

        return view('page.dosen.review.laporan_kemajuan', compact('document', 'comments', 'laporan_kemajuan_budgets'));
    }

    public function laporan_akhir(Document $document)
    {
        $comments = collect(json_decode($document->laporan_akhir_comments));
        $comments->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        if ($document->status_laporan_akhir === 'not_submitted') {
            return back();
        }

        $laporan_akhir_budgets = $document->document_budgets->sortBy('flag');
        $laporan_akhir_budgets->transform(function ($item) {
            $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

            return [
                'deskripsi_item' => $item->deskripsi_item,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->harga_satuan,
                'bukti_transaksi' => $item->bukti_transaksi,
                'is_image' => $is_image
            ];
        });

        return view('page.dosen.review.laporan_akhir', compact('document', 'comments', 'laporan_akhir_budgets'));
    }
}
