<?php

namespace App\Exports;

use App\Models\DocumentBudget;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanAkhirBudgetsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $document_id;

    public function __construct($document_id)
    {
        $this->document_id = $document_id;
    }

    public function collection()
    {
        $budgets = DocumentBudget::where('document_id', $this->document_id)->orderBy('flag', 'asc')->get();

        $budgets->transform(function ($item) {
            return [
                'deskripsi_item' => $item->deskripsi_item,
                'jumlah' => (int) $item->jumlah,
                'harga_satuan' => (int) $item->harga_satuan,
                'total' => (int) $item->jumlah * (int) $item->harga_satuan,
            ];
        });

        return $budgets;
    }

    public function headings(): array
    {
        return [
            'Deskripsi Item',
            'Jumlah',
            'Harga Satuan',
            'Total'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
