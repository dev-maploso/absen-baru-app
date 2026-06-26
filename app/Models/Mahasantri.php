<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasantri extends Model
{
    protected $fillable = [
        'master_id',
        'nim',
        'name',

        'kelas_id',
        'kode_kelas',
        'nama_kelas',

        'kamar_id',
        'kode_kamar',
        'nama_kamar',
    ];

    // public function attendances()
    // {
    //     return $this->hasMany(Attendance::class);
    // }
}
