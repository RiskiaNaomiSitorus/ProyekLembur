<?php

namespace App\Exports;

use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LemburExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Lembur::whereBetween('tanggal_lembur', [$this->startDate, $this->endDate])->get();
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
            'Gaji',
            'Jam Kerja Lembur',
            'Jam I',
            'Jam II',
            'Jam III',
            'Jam IV',
            'Upah Lembur',
            'Keterangan'
        ];
    }

    public function map($lembur): array
    {
        return [
            $lembur->id,
            $lembur->id_karyawan,
            $lembur->nama_lengkap,
            $lembur->tanggal_lembur->format('d-m-Y'),
            $lembur->jenis_lembur,
            $lembur->jam_masuk->format('H:i'),
            $lembur->jam_keluar->format('H:i'),
            'Rp. ' . number_format($lembur->gaji, 0, ',', '.'),
            number_format($lembur->jam_kerja_lembur, 1, ',', '.'),
            number_format($lembur->jam_i, 1, ',', '.'),
            number_format($lembur->jam_ii, 1, ',', '.'),
            number_format($lembur->jam_iii, 1, ',', '.'),
            number_format($lembur->jam_iv, 1, ',', '.'),
            'Rp. ' . number_format($lembur->upah_lembur, 0, ',', '.'),
            $lembur->keterangan
        ];
    }
}
