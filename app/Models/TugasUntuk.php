<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasUntuk extends Model
{
    use HasFactory;

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id');
    }
}
