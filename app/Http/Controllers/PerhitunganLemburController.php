<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;
use App\Models\Karyawan;
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
            return redirect()->route('perhitungan-lembur')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan data lembur.'); // Custom error message
        }

        // Check if ID Karyawan and Nama Lengkap exist in Karyawan table
        $karyawan = Karyawan::where('id_karyawan', $request->input('IDKaryawan'))
            ->where('nama_karyawan', $request->input('namaLengkap'))
            ->first();

        // Check if karyawan exists and is active
        if (!$karyawan || $karyawan->status === 'Tidak Aktif') {
            return redirect()->route('perhitungan-lembur')
                ->with('error', 'ID Karyawan dan Nama Lengkap tidak terdaftar, tidak aktif, atau tidak cocok di Data Karyawan.')
                ->withInput();
        }

        $lembur = new Lembur();
        $lembur->nama_lengkap = $request->input('namaLengkap');
        $lembur->id_karyawan = $request->input('IDKaryawan');
        $lembur->tanggal_lembur = $request->input('tanggalLembur');
        $lembur->jam_masuk = $request->input('jamMasuk');
        $lembur->jam_keluar = $request->input('jamKeluar');
        $lembur->jenis_lembur = $request->input('jenisLembur');
        $lembur->gaji = $request->input('gaji');
        $lembur->jam_kerja_lembur = $request->input('jamKerjaLembur');
        $lembur->jam_i = $request->input('jamI');
        $lembur->jam_ii = $request->input('jamII');
        $lembur->jam_iii = $request->input('jamIII');
        $lembur->jam_iv = $request->input('jamIV');
        $lembur->total_jam_lembur = $request->input('totalJamLembur');
        $lembur->upah_lembur = $request->input('upahLembur');
        $lembur->keterangan = $request->input('keterangan');
        $lembur->save();

        // Redirect back with success message
        return redirect()->route('perhitungan-lembur')->with('success', 'Data Lembur berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $id = $request->input('editID');
   // Dump request data before validation
    // dd('Before Validation:', $request->all());

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
            // dd('Validation Errors:', $validator->errors()->all());
            return redirect()->route('perhitungan-lembur')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data lembur.'); // Custom error message
        }

         // Dump request data after validation
        // dd('After Validation:', $request->all());
    
        // Check if ID Karyawan and Nama Lengkap exist in Karyawan table
        $karyawan = Karyawan::where('id_karyawan', $request->input('IDKaryawan'))
            ->where('nama_karyawan', $request->input('namaLengkap'))
            ->first();
    
        // Check if karyawan exists and is active
        if (!$karyawan || $karyawan->status === 'Tidak Aktif') {
            return redirect()->route('perhitungan-lembur')
                ->with('error', 'ID Karyawan dan Nama Lengkap tidak terdaftar, tidak aktif, atau tidak cocok di Data Karyawan.')
                ->withInput();
        }
    
        $lembur = Lembur::findOrFail($id);
        $lembur->nama_lengkap = $request->input('namaLengkap');
        $lembur->id_karyawan = $request->input('IDKaryawan');
        $lembur->tanggal_lembur = $request->input('tanggalLembur');
        $lembur->jam_masuk = $request->input('jamMasuk');
        $lembur->jam_keluar = $request->input('jamKeluar');
        $lembur->jenis_lembur = $request->input('jenisLembur');
        $lembur->gaji = $request->input('gaji');
        $lembur->jam_kerja_lembur = $request->input('jamKerjaLembur');
        $lembur->jam_i = $request->input('jamI');
        $lembur->jam_ii = $request->input('jamII');
        $lembur->jam_iii = $request->input('jamIII');
        $lembur->jam_iv = $request->input('jamIV');
        $lembur->total_jam_lembur = $request->input('totalJamLembur');
        $lembur->upah_lembur = $request->input('upahLembur');
        $lembur->keterangan = $request->input('keterangan');
        $lembur->save();
    
        // Redirect back with success message
        return redirect()->route('perhitungan-lembur')->with('success', 'Data Lembur berhasil diperbarui.');
    }
    

    public function destroy($id)
    {
        // Find and delete the Lembur record
        $lembur = Lembur::where('id', $id)->first();

        if ($lembur) {
            // Delete the Lembur record
            $lembur->delete();

            // Redirect back with success message
            return redirect()->route('perhitungan-lembur')->with('success', 'Data Lembur berhasil dihapus.');
        } else {
            // Redirect back with error message
            return redirect()->route('perhitungan-lembur')->with('error', 'Gagal menghapus data lembur.');
        }
    }
}

