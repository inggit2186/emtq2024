<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTQFiles extends Model
{
    protected $table = 'mtq_files';

    protected $fillable = [
		'id',
        'nama',
		'wajib',
		'created_at',
		'updated_at'
    ];
	
	public function sLayanan(){
        return $this->hasMany(PesertaFiles::class, 'files_id', 'id');
    }
}
