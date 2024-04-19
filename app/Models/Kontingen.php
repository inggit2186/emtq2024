<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontingen extends Model
{
    protected $table = 'mtq_kontingen';

    protected $fillable = [   
        'id',
        'kontingen',
        'jml_p',
        'jml_w',
		'created_at',
		'updated_at',
    ];
}
