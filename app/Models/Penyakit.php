<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';
    protected $fillable = [
        'nama',
        'solusi',
        'kode',
    ];

    public function rule()
    {
        return $this->hasOne(Rule::class, 'penyakit_id', 'id');
    }
}
