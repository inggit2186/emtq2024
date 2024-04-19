<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoLoot extends Model
{
    protected $table = 'no_loot';

    protected $fillable = [   
        'cmtq_id',
        'gmtq_id',
        'kode',
        'min',
        'max',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'cmtq_id', 'id');
    }
	public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'gmtq_id', 'id');
    }
}
