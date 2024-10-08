<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'id_karyawan',
        'nama_karyawan',
        'jenis_kelamin',
        'jabatan',
        'status',
        'gaji',
    ];

      public $timestamps = true;
}