<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;


class DataKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::paginate(10);
        return view('app.Data Karyawan', compact('karyawan'));
    }
}
