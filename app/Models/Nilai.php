<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'mtq_nilai';

    protected $fillable = [   
        'peserta',
        'kategori_id',
        'golongan_id',
        'status',
		'hakim',
		'penanya',
        'bidang_id',
		'nilai',
        'total',
		'created_at',
		'updated_at',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'kategori_id', 'id');
    }
	public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'golongan_id', 'id');
    }
	public function bidang(){
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
	public function peserta(){
        return $this->belongsTo(Peserta::class, 'peserta', 'nama');
    }
}
