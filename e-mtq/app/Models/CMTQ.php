<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMTQ extends Model
{
    protected $table = 'mtq_category';

    protected $fillable = [   
        'kategori',
        'penanya',
    ];

	public function golmtq(){
        return $this->hasMany(GMTQ::class, 'cmtq_id', 'id');
    }
    public function peserta(){
        return $this->hasMany(Peserta::class, 'kategori_id', 'id');
    }
}
