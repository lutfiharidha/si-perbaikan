<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang';

    public function ruang_has_fasilitas()
    {
        return $this->hasMany('App\Fasilitas');
    }

}
