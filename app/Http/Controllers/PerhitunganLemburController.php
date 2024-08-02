<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;
use Illuminate\Support\Facades\Validator;

class PerhitunganLemburController extends Controller
{
    public function index()
    {
        $lemburRecords = Lembur::orderBy('tanggal_lembur', 'asc')->paginate(10);
        return view('app.Perhitungan Lembur', compact('lemburRecords'));
    }

    public function store(Request $request)
    {

        // Define validation rules and custom messages
        $validator = Validator::make($request->all(), [
            'namaLengkap' => 'required|string|max:255',
            'IDKaryawan' => 'required|numeric',
            'tanggalLembur' => 'required|date',
            'jamMasuk' => 'required|date_format:H:i',
            'jamKeluar' => 'required|date_format:H:i',
            'jenisLembur' => 'required|string',
            'gaji' => 'required|numeric',
            'jamKerjaLembur' => 'nullable|numeric',
            'jamI' => 'nullable|numeric',
            'jamII' => 'nullable|numeric',
            'jamIII' => 'nullable|numeric',
            'jamIV' => 'nullable|numeric',
            'totalJamLembur' => 'nullable|numeric',
            'upahLembur' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ], [
            'namaLengkap.required' => 'Nama Lengkap harus diisi.',
            'IDKaryawan.required' => 'ID Karyawan harus diisi.',
            'tanggalLembur.required' => 'Tanggal Lembur harus diisi.',
            'jamMasuk.required' => 'Jam Masuk harus diisi.',
            'jamKeluar.required' => 'Jam Keluar harus diisi.',
            'jenisLembur.required' => 'Jenis Lembur harus dipilih.',
            'gaji.required' => 'Gaji harus diisi.',
            'jamKerjaLembur.numeric' => 'Jam Kerja Lembur harus berupa angka.',
            'jamI.numeric' => 'Jam I harus berupa angka.',
            'jamII.numeric' => 'Jam II harus berupa angka.',
            'jamIII.numeric' => 'Jam III harus berupa angka.',
            'jamIV.numeric' => 'Jam IV harus berupa angka.',
            'totalJamLembur.numeric' => 'Total Jam Lembur harus berupa angka.',
            'upahLembur.numeric' => 'Upah Lembur harus berupa angka.',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->route('perhitungan-lembur')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan data lembur.'); // Custom error message
        }
    
        // Create a new Lembur record
        Lembur::create($validator->validated());
    
        // Redirect back with success message
        return redirect()->route('perhitungan-lembur')->with('success', 'Data Lembur berhasil ditambahkan.');
    }
    


}
