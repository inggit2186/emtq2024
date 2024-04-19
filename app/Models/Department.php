<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'ktd_department';

    protected $fillable = [   
        'nama',
        'deskripsi',
        'kode',
        'status',
		'created_at',
		'updated_at'
    ];
	
    public function usersrequest(){
        return $this->hasMany(UsersRequest::class, 'dept_id', 'id');
    }
	public function layanan(){
        return $this->hasMany(UsersRequest::class, 'dept_id', 'id');
    }
}

?>