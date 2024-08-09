<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;


class DashboardController extends Controller
{
    public function index()
    {
        return view('/app/Dashboard');
    }
}
