<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoPeserta extends Model
{
    protected $table = 'no_peserta';

    protected $fillable = [   
        'peserta',
        'nik',
        'jk',
        'asal',
        'cmtq_id',
        'gmtq_id',
        'noloot',
        'operator',
        'created_at',
        'updated_at',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'cmtq_id', 'id');
    }
	public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'gmtq_id', 'id');
    }
}
