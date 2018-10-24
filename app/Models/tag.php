<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public function laporan()
    {
    	return $this->belongsToMany('App\Models\laporan')->as('laporan');
    }
}
