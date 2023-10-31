<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas_anggotas';

    protected $guarded = [];

    public function tugasDari()
    {
        return $this->belongsToMany(TugasDari::class, 'penerima_tugas', 'mengetahui');
    }
}
