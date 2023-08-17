<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'url_image',
    ];
    protected $hidden = [
        'password',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function createProduct(): HasMany 
    {
        return $this->hasMany(Product::class,'creater_id','id');
    }
    public function updateProduct(): HasMany 
    {
        return $this->hasMany(Product::class,'updater_id','id');
    }
    public function address():HasMany
    {
        return $this->hasMany(Address::class,'user_id','id');
    }
}
