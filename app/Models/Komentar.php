<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
	
	protected $table = 'komentar';
	
    protected $fillable = [
        'user_id',
        'komentar',
		'to_user',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	public function to_user(){
        return $this->belongsTo(User::class, 'to_user', 'id');
    }
}
