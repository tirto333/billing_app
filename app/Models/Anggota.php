<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function projects()
    // {
    //     return $this->hasMany(Project::class, 'kepala_projek', 'nama_anggota');
    // }
}
