<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Karyawan;

class DataKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::latest()->paginate(10);
        return view('app.Data Karyawan', compact('karyawan'));
    }

    public function store(Request $request)
    {
        // Define validation rules and custom messages
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|numeric|unique:karyawan,id_karyawan',
            'nama_karyawan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'gaji' => 'required|numeric|min:0',
        ], [
            'id_karyawan.required' => 'ID Karyawan harus diisi.',
            'id_karyawan.unique' => 'ID Karyawan sudah terdaftar.',
            'nama_karyawan.required' => 'Nama Karyawan harus diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'status.required' => 'Status harus dipilih.',
            'gaji.required' => 'Gaji harus diisi.',
            'gaji.min' => 'Gaji tidak boleh kurang dari 0.',
        ]);
    

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('data-karyawan')
                ->withErrors($validator)
                ->withInput();
        }
    

        // Create a new Karyawan record
        Karyawan::create($validator->validated());
    
        // Redirect back with success message
        return redirect()->route('data-karyawan')->with('success', 'Karyawan added successfully.');
    }
    
}
