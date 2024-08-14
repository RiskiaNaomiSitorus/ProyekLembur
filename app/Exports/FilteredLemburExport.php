<?php

namespace App\Exports;

use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Http\Request;

class FilteredLemburExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $request;
    protected $counter = 1; // Initialize counter

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Lembur::query();
    
        // Apply filters
        if ($this->request->filled('nama_lengkap_excel')) {
            $query->where('nama_lengkap', 'like', '%' . $this->request->nama_lengkap_excel . '%');
        }
    
        if ($this->request->filled('start_date_excel') && $this->request->filled('end_date_excel')) {
            $query->whereBetween('tanggal_lembur', [
                $this->request->start_date_excel, 
                $this->request->end_date_excel
            ]);
        }
    
        $lemburRecords = $query->get();
    
        // Group records by nama_lengkap and aggregate totals
        $groupedRecords = $lemburRecords->groupBy('nama_lengkap')->map(function ($group) {
            return [
                'nama_lengkap' => $group->first()->nama_lengkap, // Use the first record's nama_lengkap
                'jam_kerja_lembur' => $group->sum('jam_kerja_lembur'),
                'upah_lembur' => $group->sum('upah_lembur'),
            ];
        })->values(); // Use values() to get a collection of the aggregated records
    
        // Calculate totals for footer
        $totalJamKerjaLembur = $groupedRecords->sum('jam_kerja_lembur');
        $totalUpahLembur = $groupedRecords->sum('upah_lembur');
    
        // Add totals to the collection
        $groupedRecords->push([
            'nama_lengkap' => 'Total',
            'jam_kerja_lembur' => $totalJamKerjaLembur,
            'upah_lembur' => $totalUpahLembur,
        ]);
    
        return $groupedRecords;
    }
    


    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Jumlah Jam Kerja Lembur',
            'Jumlah Upah Lembur',
        ];
    }

    public function map($data): array
    {
        // Skip counter increment for 'Total' row
        if ($data['nama_lengkap'] === 'Total') {
            return [
                '', // Empty for 'No' column
                $data['nama_lengkap'],
                number_format($data['jam_kerja_lembur'], 1),
                'Rp. ' . number_format($data['upah_lembur'], 0, ',', '.'),
            ];
        }

        // Return data with the incremented counter
        return [
            $this->counter++, // Increment counter
            $data['nama_lengkap'],
            number_format($data['jam_kerja_lembur'], 1),
            'Rp. ' . number_format($data['upah_lembur'], 0, ',', '.'),
        ];
    }


    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $cellRange = 'A1:' . $highestColumn . $highestRow;

        // Apply font style
        $sheet->getStyle($cellRange)
              ->getFont()
              ->setName('Book Antiqua')
              ->setSize(9);
        
        // Center align all cells
        $sheet->getStyle($cellRange)
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER)
              ->setVertical(Alignment::VERTICAL_CENTER);
        
        // Apply borders to all cells
        $sheet->getStyle($cellRange)
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        $numberColumns = ['C', 'D']; // Columns for numbers
        foreach ($numberColumns as $column) {
            $sheet->getStyle($column . '2:' . $column . $highestRow)
                  ->getNumberFormat()
                  ->setFormatCode('#,##0.0');
        }
    }
}
