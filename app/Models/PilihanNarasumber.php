<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanNarasumber extends Model
{
    protected $table = 'pilihan_narasumber';
    protected $fillable = [
        'gejala_id',
        'pilihan_id',
        'nilai_user',
        'nilai_pakar',
    ];
}
