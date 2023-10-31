<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaProjek extends Model
{
    use HasFactory;

    protected $table = 'anggota_projeks';

    public function projeks() {
        return $this->belongsToMany(projek::class, 'nama_anggota', 'kepala_projek');
    }
}
