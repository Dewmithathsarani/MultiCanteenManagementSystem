<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canteen;
use App\Models\CanteenReview;

class CanteenReviewController extends Controller
{
    public function store(Request $request, Canteen $canteen)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        CanteenReview::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'canteen_id' => $canteen->id,
            ],
            $data
        );

        return back()->with('success', 'Review submitted.');
    }

}