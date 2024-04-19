<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    public function gmtq(){
        return $this->belongsTo(GMTQ::class, 'golongan_id', 'id');
    }
	public function kontingen(){
        return $this->belongsTo(Kontingen::class, 'kontingen_id', 'id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'username',
        'name',
        'kk',
        'email',
        'password',
		'nomor_induk',
        'tempat_lahir',
        'tanggal_lahir',
		'pekerjaan',
		'telp',
		'satker',
		'alamat',
		'kontingen_id',
        'role',
		'dept_id',
		'golongan_id',
		'kategori_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
		'nip' => 'integer',
        'kk' => 'integer',
        'nomor_induk' => 'integer',
        'email' => 'string',
    ];
}