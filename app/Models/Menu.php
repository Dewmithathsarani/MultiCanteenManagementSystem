<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Menu extends Model
{
     use HasFactory;

    protected $fillable = [
        'canteen_id',
        'item_name',
        'price',
        'availability',
        'meal_type',
        'curries',
    ];

    public function canteen()
    {
        return $this->belongsTo(Canteen::class);
    }
}
