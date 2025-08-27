<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji_kehadiran_absensi extends Model
{
    protected $table = 'gaji_kehadiran_absensi';
    protected $fillable = [
        'id_periode',
        'id_karyawan',
        'tot_hari',
        'upah_harian',
        'tot_libur',
        'tot_ph',
        'tot_izin',
        'tot_alfa',
        'tot_sakit',
        'tot_cuti',
        'tot_masuk',
        'reff',
    ];
}
