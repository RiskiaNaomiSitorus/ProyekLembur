<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Validate the request
        $request->validate([
            'id_karyawan' => 'required|numeric|unique:karyawan,id_karyawan',
            'nama_karyawan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'gaji' => 'required|numeric|min:0',
        ]);
    
        // Create a new Karyawan record
        Karyawan::create([
            'id_karyawan' => $request->id_karyawan,
            'nama_karyawan' => $request->nama_karyawan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'gaji' => $request->gaji,
        ]);
    
        // Redirect back with success message
        return redirect()->route('data-karyawan')->with('success', 'Karyawan added successfully.');
    }
    
}
