<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    protected $table = 'ktd_syarat';

    protected $fillable = [
		'layanan_id',
        'syarat'
    ];
	
	public function sLayanan(){
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }
}
