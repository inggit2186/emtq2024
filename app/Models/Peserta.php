<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'mtq_peserta';

    protected $fillable = [   
        'user_id',
        'jk',
        'team',
        'nomor',
        'kategori_id',
        'golongan_id',
        'total',
        'verifikator',
        'operator',
        'status',
        'keterangan',
        'created_at',
        'updated_at',
    ];
	
	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'kategori_id', 'id');
    }
	public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'golongan_id', 'id');
    }
}
