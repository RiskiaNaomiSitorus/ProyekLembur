<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FilteredLemburExport; // Import the new export class

class RekapitulasiJamLemburController extends Controller
{
    public function index(Request $request)
    {
        $query = Lembur::query();

        if ($request->filled('nama_lengkap')) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_masuk', [$request->start_date, $request->end_date]);
        }

        $lemburRecords = $query->get();

        // Group records by nama_lengkap
        $groupedRecords = $lemburRecords->groupBy('nama_lengkap')->map(function (Collection $group) {
            return [
                'totalJamKerja' => $group->sum('jam_kerja_lembur'),
                'totalUpahLembur' => $group->sum('upah_lembur'),
            ];
        });

        // Calculate overall totals
        $totalJamKerja = $lemburRecords->sum('jam_kerja_lembur');
        $totalUpahLembur = $lemburRecords->sum('upah_lembur');

        // Return JSON response for AJAX request
        if ($request->ajax()) {
            return response()->json([
                'table' => view('app.Rekapitulasi Jam Lembur Table', [
                    'groupedRecords' => $groupedRecords,
                    'totalJamKerja' => $totalJamKerja,
                    'totalUpahLembur' => $totalUpahLembur,
                ])->render(),
                'totalJamKerja' => number_format($totalJamKerja, 2),
                'totalUpahLembur' => number_format($totalUpahLembur, 2),
                'totalUpahLembur' => number_format($totalUpahLembur, 2),
            ]);
        }

        // For normal requests (non-AJAX)
        return view('app.Rekapitulasi Jam Lembur', [
            'groupedRecords' => $groupedRecords,
            'totalJamKerja' => $totalJamKerja,
            'totalUpahLembur' => $totalUpahLembur,
        ]);
    }

    public function printFilteredData(Request $request)
{
    $query = Lembur::query();

    if ($request->filled('printnama_lengkap2')) {
        $query->where('nama_lengkap', 'like', '%' . $request->printnama_lengkap2 . '%');
    }

    if ($request->filled('printstart_date') && $request->filled('printend_date')) {
        $query->whereBetween('tanggal_lembur', [$request->printstart_date, $request->printend_date]);
    }

    $lemburRecords = $query->get();

    // Group records by nama_lengkap
    $groupedRecords = $lemburRecords->groupBy('nama_lengkap')->map(function ($group) {
        return [
            'totalJamKerja' => $group->sum('jam_kerja_lembur'),
            'totalUpahLembur' => $group->sum('upah_lembur'),
        ];
    });

    // Calculate overall totals
    $totalJamKerja = $lemburRecords->sum('jam_kerja_lembur');
    $totalUpahLembur = $lemburRecords->sum('upah_lembur');

    // Pass grouped data to the view
    return view('PrintViewSummary', [
        'groupedRecords' => $groupedRecords,
        'totalJamKerja' => $totalJamKerja,
        'totalUpahLembur' => $totalUpahLembur,
    ]);
}

    
    

}



