<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasDari extends Model
{
    use HasFactory;

    protected $table = 'tugas_daris';

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id');
    }
}
