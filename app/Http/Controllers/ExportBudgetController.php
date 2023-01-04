<?php

namespace App\Http\Controllers;

use App\Exports\LaporanAkhirBudgetsExport;
use App\Exports\LaporanKemajuanBudgetsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportBudgetController extends Controller
{
    public function laporan_kemajuan($document_id)
    {
        return Excel::download(new LaporanKemajuanBudgetsExport((int) $document_id), 'budget-laporan-kemajuan.xlsx');
    }

    public function laporan_akhir($document_id)
    {
        return Excel::download(new LaporanAkhirBudgetsExport((int) $document_id), 'budget-laporan-akhir.xlsx');
    }
}
