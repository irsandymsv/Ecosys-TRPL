<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $guarded =['id'];
    // public $timestamps = false;

    public function User()
    {
    	return $this->belongsTo('App\Models\User', 'id_penulis');
    }

    public function setDateAttribute($value)
	{
    	$this->attributes['dibuat'] = Carbon::createFromFormat('Y-m-d H:i:s', $value);	
	}
}
