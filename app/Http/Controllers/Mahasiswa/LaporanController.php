<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class LaporanController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('document_owners', function ($q) {
            $q->whereJsonContains('id_mahasiswa', (string) auth()->user()->id);
        })->get();

        return view('page.mahasiswa.laporan.index', compact('documents'));
    }

    public function show(Document $document)
    {
        $comments_laporan_kemajuan = collect(json_decode($document->laporan_kemajuan_comments));
        $comments_laporan_akhir = collect(json_decode($document->laporan_akhir_comments));
        $budgets = DocumentBudget::where('document_id', $document->id)->orderBy('flag', 'asc')->get();

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

        return view('page.mahasiswa.laporan.review', [
            'laporan_kemajuan_budgets' => $budgets->filter(fn ($item) => $item->flag === 0),
            'laporan_akhir_budgets' => $budgets,
        ], compact('document', 'comments_laporan_kemajuan', 'comments_laporan_akhir'));
    }

    public function create(Request $request, Document $document)
    {
        $key = 'submit';
        $laporan_akhir = false;
        $budgets = DocumentBudget::query()->where('document_id', $document->id);

        if ($request->is('laporan-akhir*')) {
            $budgets = $budgets->orderBy('flag', 'asc')->get();
            $file = (array) $document->berkas;
            $laporan_akhir = true;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        } else {
            $budgets = $budgets->where('flag', 0)->get();

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
            $file = (array) $document->berkas;
            $laporan_akhir = true;

            if (!array_key_exists('laporan_kemajuan', $file) || $document->status_laporan_kemajuan !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        } else {
            $budgets = $budgets->where('flag', 0)->get();

            if ($request->is('laporan-kemajuan*') && $document->status_proposal !== 'approved') {
                return back();
            }

            return view('page.mahasiswa.laporan.submit', compact('document', 'budgets', 'key', 'laporan_akhir'));
        }
    }
}
