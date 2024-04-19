<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSemifinal extends Model
{
    protected $table = 'mtq_peserta_semifinal';

    protected $fillable = [   
        'nama',
        'utusan',
        'jk',
        'nomor',
        'kategori_id',
        'golongan_id',
        'total',
        'operator',
        'created_at',
        'updated_at',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'kategori_id', 'id');
    }
	public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'golongan_id', 'id');
    }
}
