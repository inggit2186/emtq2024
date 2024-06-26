<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Petugas extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
	
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'staff';
	
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dept_id',
        'nomor_induk',
        'tempat_lahir',
        'tanggal_lahir',
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
    ];
	
	public function tanggapan(){
        return $this->hasMany(tanggapan::class, 'user_id', 'id');
    }
	public function usersrequest(){
        return $this->hasMany(UsersRequest::class, 'user_id', 'nomor_induk');
    }
}
