<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $documents = Document::with('skema_pkm')->whereHas('document_owners', function ($q) {
            $q->where('id_ketua', (string) auth()->user()->id)->orWhereJsonContains('id_anggota', (string) auth()->user()->id);
        })->get();

        return view('page.mahasiswa.laporan.index', compact('documents'));
    }

    public function show(Document $document)
    {
        $comments_laporan_kemajuan = collect(json_decode($document->laporan_kemajuan_comments));
        $comments_laporan_akhir = collect(json_decode($document->laporan_akhir_comments));

        $comments_laporan_kemajuan->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

        $comments_laporan_akhir->transform(function ($item) {
            return [
                'waktu' => Carbon::createFromTimestamp($item->waktu)->format('d/m/Y H:i'),
                'status' => $item->status,
                'reviewer' => $item->reviewer,
                'komentar' => $item->komentar,
                'file_evaluasi' => $item->file_evaluasi
            ];
        });

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

        return view('page.mahasiswa.laporan.review', [
            'laporan_kemajuan_budgets' => $laporan_kemajuan_budgets,
            'laporan_akhir_budgets' => $laporan_akhir_budgets,
        ], compact('document', 'comments_laporan_kemajuan', 'comments_laporan_akhir'));
    }

    public function create(Request $request, Document $document)
    {
        $key = 'submit';
        $laporan_akhir = false;
        $budgets = DocumentBudget::query()->where('document_id', $document->id);

        if ($request->is('laporan-akhir*')) {
            $budgets = $budgets->orderBy('flag', 'asc')->get();
            $budgets->transform(function ($item) {
                $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

                return [
                    'deskripsi_item' => $item->deskripsi_item,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                    'bukti_transaksi' => $item->bukti_transaksi,
                    'is_image' => $is_image
                ];
            });

            $file = (array) $document->berkas;
            $laporan_akhir = true;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        } else {
            $budgets = $budgets->where('flag', 0)->get();
            $budgets->transform(function ($item) {
                $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

                return [
                    'id' => $item->id,
                    'deskripsi_item' => $item->deskripsi_item,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                    'bukti_transaksi' => $item->bukti_transaksi,
                    'is_image' => $is_image
                ];
            });

            if ($request->is('laporan-kemajuan*') && $document->status_proposal !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        }
    }

    public function edit(Request $request, Document $document)
    {
        $key = 'edit';
        $laporan_akhir = false;
        $budgets = DocumentBudget::query()->where('document_id', $document->id);

        if ($request->is('laporan-akhir*')) {
            $budgets = $budgets->orderBy('flag', 'asc')->get();
            $budgets->transform(function ($item) {
                $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

                return [
                    'id' => $item->id,
                    'deskripsi_item' => $item->deskripsi_item,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                    'bukti_transaksi' => $item->bukti_transaksi,
                    'is_image' => $is_image
                ];
            });

            $file = (array) $document->berkas;
            $laporan_akhir = true;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        } else {
            $budgets = $budgets->where('flag', 0)->get();
            $budgets->transform(function ($item) {
                $is_image = exif_imagetype(public_path("documents/bukti_transaksi/{$item->bukti_transaksi}")) ? true : false;

                return [
                    'id' => $item->id,
                    'deskripsi_item' => $item->deskripsi_item,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                    'bukti_transaksi' => $item->bukti_transaksi,
                    'is_image' => $is_image
                ];
            });

            if ($request->is('laporan-kemajuan*') && $document->status_proposal !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        }
    }
}
