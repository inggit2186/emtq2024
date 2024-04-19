<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'cat_bidang';

    protected $fillable = [   
        'nama',
        'cat_id',
		'nilai',
		'hakim',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'cat_id', 'id');
    }
}
