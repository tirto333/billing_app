<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjekDetail extends Model
{
    use HasFactory;

    protected $table = 'projek_details';

    protected $fillable = ['id_projek', 'pesan', 'penulis'];
}
