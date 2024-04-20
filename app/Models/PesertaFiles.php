<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaFiles extends Model
{
    protected $table = 'peserta_files';

    protected $fillable = [
		'user_id',
        'files_id',
		'filename',
		'status',
		'keterangan',
        'created_at',
        'updated_at',
    ];
	
	public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
