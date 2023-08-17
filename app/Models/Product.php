<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'type',
        'brand',
        'model',
        'price',
        'discount',
        'detail',
        'pro_image',
        'creater_id',
        'updater_id',
    ] ;
    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class,'creater_id','updater_id','id');
    }
}
