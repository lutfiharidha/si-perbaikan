<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    public function fasilitas_has_ruang()
    {
        return $this->belongsTo('App\Ruang', 'ruang_id');
    }

    public function fasilitas_has_kerusakan()
    {
        return $this->hasMany('App\Kerusakan');
    }
}
