<?php

namespace App\Exports;

use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;

class FilteredLemburExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lembur::all();
    }
}
