<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [   
        'user_id',
        'aktifitas',
        'target',
        'location',
		'ip',
		'useragent',
		'created_at',
		'updated_at',
    ];
	
	public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
