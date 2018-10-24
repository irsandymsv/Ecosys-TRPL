<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    protected $table = 'laporan';
    protected $guarded =['id'];

    public function User()
    {
    	return $this->belongsTo('App\Models\User', 'id_penulis');
    	return $this->belongsTo('App\Models\User', 'id_pengubah');

    }

    public function tags()
    {
    	return  $this->belongsToMany('App\Models\tag')->using('App\Models\laporan_tag')->as('tags');
    }

    public function profesi()
    {
    	return  $this->belongsToMany('App\Models\profesi', 'laporan_prof', 'laporan_id', 'profesi_id')->using('App\Models\laporan_prof')->as('prof');
    }

    public function getTag()
    {
        return  $this->hasManyThrough('App\Models\tag', 'App\Models\laporan_tag');
    }

    public function getprof()
    {
        return  $this->hasManyThrough('App\Models\prof', 'App\Models\laporan_prof');
    }
}
