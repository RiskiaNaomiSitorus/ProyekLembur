<?php

namespace App\Exports;

use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Events\AfterSheet;

class LemburExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $counter = 1; // Initialize counter
    protected $startDate;
    protected $endDate;
    protected $namaLengkap;
    protected $idKaryawan;

    public function __construct($startDate, $endDate, $namaLengkap = null, $idKaryawan = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->namaLengkap = $namaLengkap;
        $this->idKaryawan = $idKaryawan;
    }

    public function collection()
    {
        $query = Lembur::whereBetween('tanggal_lembur', [$this->startDate, $this->endDate]);

        if ($this->namaLengkap) {
            $query->where('nama_lengkap', $this->namaLengkap);
        }

        if ($this->idKaryawan) {
            $query->where('id_karyawan', $this->idKaryawan);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'ID Karyawan',
            'Nama Lengkap',
            'Tanggal Lembur',
            'Jenis Lembur',
            'Jam Masuk',
            'Jam Keluar',
            'Gaji (Rp.)',
            'Jam Kerja Lembur',
            'Jam I',
            'x 1.5',
            'Jam II',
            'x 2',
            'Jam III',
            'x 3',
            'Jam IV',
            'x 4',
            'Upah Lembur (Rp.)',
            'Keterangan'
        ];
    }
    
    public function map($lembur): array
    {
        return [
            $this->counter++, // Increment and use counter for row numbers
            $lembur->id_karyawan,
            $lembur->nama_lengkap,
            $this->formatDateInIndonesian($lembur->tanggal_lembur), // Format the date
            $lembur->jenis_lembur,
            $lembur->jam_masuk->format('H:i'),
            $lembur->jam_keluar->format('H:i'),
            $lembur->gaji ?? 0, // Numeric, default to 0 if null
            $lembur->jam_kerja_lembur ?? 0, // Numeric, default to 0 if null
            $lembur->jam_i ?? 0, // Numeric, default to 0 if null
            ($lembur->jam_i ?? 0) * 1.5, // Numeric, default to 0 if null
            $lembur->jam_ii ?? 0, // Numeric, default to 0 if null
            ($lembur->jam_ii ?? 0) * 2, // Numeric, default to 0 if null
            $lembur->jam_iii ?? 0, // Numeric, default to 0 if null
            ($lembur->jam_iii ?? 0) * 3, // Numeric, default to 0 if null
            $lembur->jam_iv ?? 0, // Numeric, default to 0 if null
            ($lembur->jam_iv ?? 0) * 4, // Numeric, default to 0 if null
            $lembur->upah_lembur ?? 0, // Numeric, default to 0 if null
            $lembur->keterangan
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

        $numberColumns = ['H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R']; // Columns for numbers
        foreach ($numberColumns as $column) {
            $sheet->getStyle($column . '2:' . $column . $highestRow)
                  ->getNumberFormat()
                  ->setFormatCode('#,##0.0');
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $numberColumns = ['H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R']; // Columns for numbers
                
                foreach ($numberColumns as $column) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $cellValue = $sheet->getCell($column . $row)->getValue();
                        if ($cellValue === null || $cellValue === '') {
                            $sheet->setCellValue($column . $row, 0);
                        }
                    }
                }
            },
        ];
    }

    // Helper function for formatting date
    private function formatDateInIndonesian($date)
    {
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $weekdays = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        $dateObj = new \DateTime($date);
        $dayName = $dateObj->format('l'); // Day of the week
        $monthName = $dateObj->format('F'); // Full month name
        $day = $dateObj->format('d'); // Day of the month
        $year = $dateObj->format('Y'); // Year

        $dayNameIndonesian = $weekdays[$dayName];
        $monthNameIndonesian = $months[$monthName];

        return "{$dayNameIndonesian}, {$day} {$monthNameIndonesian} {$year}";
    }
}
