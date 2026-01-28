<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Canteen; 
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Canteen $canteen)
    {
        $user = auth()->user();
        $user->favouriteCanteens()->syncWithoutDetaching([$canteen->id]);

        return back();
    }

    public function destroy(Canteen $canteen)
    {
        $user = auth()->user();
        $user->favouriteCanteens()->detach($canteen->id);

        return back();
    }

}
