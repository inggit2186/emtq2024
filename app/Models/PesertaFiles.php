<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaFiles extends Model
{
    protected $table = 'peserta_berkas';

    protected $fillable = [
		'user_id',
        'foto',
        'kk',
        'ktp',
        'akta',
        'ijazah',
        'sertifikat',
        'tambahan',
        'created_at',
        'updated_at',
    ];
	
	public function users(){
        return $this->belongsTo(Layanan::class, 'user_id', 'id');
    }
}
