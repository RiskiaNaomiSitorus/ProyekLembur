<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;

class PerhitunganLemburController extends Controller
{
    public function index()
    {
        $lemburRecords = Lembur::all(); // Fetch all recordss
        return view('app.Perhitungan Lembur',compact('lemburRecords'));
    }
}
