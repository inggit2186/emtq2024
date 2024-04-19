<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GMTQ extends Model
{
    protected $table = 'mtq_golongan';

    protected $fillable = [   
        'golongan',
        'cmtq_id',
        'jml_p',
        'jml_w',
		'kode',
        'min',
        'max',
		'user_id',
    ];
	
	public function cmtq(){
        return $this->belongsTo(CMTQ::class, 'cmtq_id', 'id');
    }
	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	public function peserta(){
		return $this->hasMany(Peserta::class, 'id', 'golongan_id');
	}
}
