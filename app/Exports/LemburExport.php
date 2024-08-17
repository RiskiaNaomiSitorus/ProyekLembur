<?php

namespace App\Exports;

use App\Models\Lembur;
use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LemburExport implements FromView
{
    protected $startDate;
    protected $endDate;
    protected $namaLengkap;

    public function __construct($startDate, $endDate, $namaLengkap)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->namaLengkap = $namaLengkap;
    }

    public function view(): View
    {
        // Fetch the Lembur data with the joined Karyawan table to get jabatan
        $lemburData = Lembur::select('lembur.*', 'karyawan.jabatan') // Select all fields from lembur and jabatan from karyawan
                            ->join('karyawan', 'lembur.nama_lengkap', '=', 'karyawan.nama_karyawan')
                            ->whereBetween('lembur.tanggal_lembur', [$this->startDate, $this->endDate])
                            ->where('lembur.nama_lengkap', 'like', '%' . $this->namaLengkap . '%')
                            ->get();
    
        return view('excelPerhitunganLembur', [
            'lemburData' => $lemburData,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'namaLengkap' => $this->namaLengkap
        ]);
    }
    
}
