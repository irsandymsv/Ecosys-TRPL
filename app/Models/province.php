<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    public function regency()
    {
    	return $this->hasMany('App\Models\regency');
    }
}
