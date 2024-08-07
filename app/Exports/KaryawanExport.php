<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Karyawan::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'ID Karyawan',
            'Nama Karyawan',
            'Jenis Kelamin',
            'Jabatan',
            'Status',
            'Gaji (Rp.)',
        ];
    }

    public function map($karyawan): array
    {
        return [
            $karyawan->id,
            $karyawan->id_karyawan,
            $karyawan->nama_karyawan,
            $karyawan->jenis_kelamin,
            $karyawan->jabatan,
            $karyawan->status,
            $karyawan->gaji,
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
    }
}
