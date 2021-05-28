<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $table = 'kerusakan';

    public function kerusakan_has_fasilitas()
    {
        return $this->belongsTo('App\Fasilitas', 'fasilitas_id');
    }

    public function kerusakan_has_user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
