<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasDetail extends Model
{
    use HasFactory;

    protected $table = 'tugas_details';

    protected $fillable = ['id_tugas','file', 'pesan', 'penulis', 'status_tugas'];
}
