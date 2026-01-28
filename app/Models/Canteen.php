<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Order;


class Canteen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'description',
        'open_time',
        'close_time',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function reviews()
{
    return $this->hasMany(CanteenReview::class);
}

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
