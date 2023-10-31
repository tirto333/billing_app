<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaProjek extends Model
{
    use HasFactory;

    protected $table = 'kepala_projeks';

    public function projek()
    {
        return $this->belongsTo(Projek::class, 'id_projek', 'id');
    }
    
}
