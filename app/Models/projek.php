<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projek extends Model
{
    use HasFactory;

    // public function anggotaProjeks() {
    //     return $this->belongsToMany(AnggotaProjek::class, 'nama_anggota', 'kepala_projek');
    // }
}
