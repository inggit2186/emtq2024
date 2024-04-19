<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'ktd_layanan';

    protected $fillable = [
		'dept_id',
        'nama',
        'deskripsi',
        'status'
    ];
	
    public function usersrequest(){
        return $this->hasMany(UsersRequest::class, 'layanan_id', 'id');
    }
	public function dept(){
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }
}
