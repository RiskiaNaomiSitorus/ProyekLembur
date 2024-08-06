<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Import Rule class
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
    $id = $request->input('editID'); // Retrieve the ID of the record being updated

    // Define validation rules and custom messages
    $validator = Validator::make($request->all(), [
        // Ensure that `id_karyawan` is unique, except for the current record
        'editIDKaryawan' => 'required|numeric|unique:karyawan,id_karyawan,' . $id,
        
        // Ensure that `nama_karyawan` is unique, except for the current record
        'editName' => 'required|string|max:255|unique:karyawan,nama_karyawan,' . $id,
        
        'editGender' => 'required|in:Laki-laki,Perempuan',
        'editPosition' => 'required|string|max:255',
        'editStatus' => 'required|in:Aktif,Tidak Aktif',
        'editSalary' => 'required|numeric|min:0',
    ], [
        'editIDKaryawan.required' => 'ID Karyawan harus diisi.',
        'editIDKaryawan.unique' => 'ID Karyawan sudah terdaftar.',
        'editName.required' => 'Nama Karyawan harus diisi.',
        'editName.unique' => 'Nama Karyawan sudah terdaftar.',
        'editGender.required' => 'Jenis Kelamin harus dipilih.',
        'editPosition.required' => 'Jabatan harus diisi.',
        'editStatus.required' => 'Status harus dipilih.',
        'editSalary.required' => 'Gaji harus diisi.',
        'editSalary.min' => 'Gaji tidak boleh kurang dari 0.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Gagal mengedit data karyawan.'); // Custom error message;
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

public function autocomplete(Request $request)
    {
        $query = $request->get('term');
        $karyawan = Karyawan::where('id_karyawan', 'LIKE', "%{$query}%")
                            ->get(['id_karyawan'])
                            ->pluck('id_karyawan');
        return response()->json($karyawan);
    }

    public function autocompleteNama(Request $request)
    {
        $query = $request->get('term');
        $karyawan = Karyawan::where('nama_karyawan', 'LIKE', "%{$query}%")
                            ->get(['nama_karyawan'])
                            ->pluck('nama_karyawan');
        return response()->json($karyawan);
    }

    public function getGaji(Request $request)
    {
        $idKaryawan = $request->query('id_karyawan');
        $namaLengkap = $request->query('nama_lengkap');

        $query = Karyawan::query();

        if ($idKaryawan) {
            $query->where('id_karyawan', $idKaryawan);
        } elseif ($namaLengkap) {
            $query->where('nama_lengkap', $namaLengkap);
        }

        $karyawan = $query->first();

        if ($karyawan) {
            return response()->json(['gaji' => $karyawan->gaji]);
        }

        return response()->json(['gaji' => null]);
    }
    
}