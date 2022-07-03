<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rule';
    protected $fillable = [
        'penyakit_id',
        'gejala_id',
    ];
}
