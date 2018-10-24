<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profesi extends Model
{
    protected $table ='profesi';
    protected $primaryKey = 'id_prof';

    public function laporan()
    {
    	return $this->belongsToMany('App\Models\laporan', 'laporan_prof', 'profesi_id', 'laporan_id');
    }
}
