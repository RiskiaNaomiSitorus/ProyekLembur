<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Karyawan;

class DataKaryawanController extends Controller
{
    public function index()
    {
        // Fetch the Karyawan records sorted alphabetically by 'nama_karyawan'
        $karyawan = Karyawan::orderBy('nama_karyawan', 'asc')->paginate(10);
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
                ->withInput()
                ->with('error', 'Gagal menambahkan data karyawan.'); // Custom error message
        }
    

        // Create a new Karyawan record
        Karyawan::create($validator->validated());
    
        // Redirect back with success message
        return redirect()->route('data-karyawan')->with('success', 'Karyawan added successfully.');
    }

    public function destroy($id)
{
    // Find and delete the Karyawan record
    $karyawan = Karyawan::where('id', $id)->first();

    if ($karyawan) {
        // Delete the Karyawan record
        $karyawan->delete();

        // Redirect back with success message
        return redirect()->route('data-karyawan')->with('success', 'Karyawan deleted successfully.');
    } else {
        // Redirect back with error message
        return redirect()->route('data-karyawan')->with('error', 'No Karyawan found with ID: ' . $id);
    }
}

public function update(Request $request)
{
    $id = $request->input('editID');

    // Define validation rules and custom messages
    $validator = Validator::make($request->all(), [
        'editIDKaryawan' => 'required|numeric|unique:karyawan,id_karyawan,' . $id . ',id',
        'editName' => 'required|string|max:255',
        'editGender' => 'required|in:Laki-laki,Perempuan',
        'editPosition' => 'required|string|max:255',
        'editStatus' => 'required|in:Aktif,Tidak Aktif',
        'editSalary' => 'required|numeric|min:0',
    ], [
        'editIDKaryawan.required' => 'ID Karyawan harus diisi.',
        'editIDKaryawan.unique' => 'ID Karyawan sudah terdaftar.',
        'editName.required' => 'Nama Karyawan harus diisi.',
        'editGender.required' => 'Jenis Kelamin harus dipilih.',
        'editPosition.required' => 'Jabatan harus diisi.',
        'editStatus.required' => 'Status harus dipilih.',
        'editSalary.required' => 'Gaji harus diisi.',
        'editSalary.min' => 'Gaji tidak boleh kurang dari 0.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Find and update the Karyawan record
    $karyawan = Karyawan::findOrFail($id);
    $karyawan->id_karyawan = $request->input('editIDKaryawan');
    $karyawan->nama_karyawan = $request->input('editName');
    $karyawan->jenis_kelamin = $request->input('editGender');
    $karyawan->jabatan = $request->input('editPosition');
    $karyawan->status = $request->input('editStatus');
    $karyawan->gaji = $request->input('editSalary');
    $karyawan->save();

    // Redirect back with success message
    return redirect()->route('data-karyawan')->with('success', 'Karyawan updated successfully.');
}



}
