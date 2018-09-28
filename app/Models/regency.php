<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regency extends Model
{
    public function province()
    {
    	return $this->belongsTo('App\Models\province');
    }
}
