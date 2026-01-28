<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Canteen;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(Request $request)
    {
        $query = Canteen::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q2) use ($search) {
                $q2->where('name', 'like', '%'.$search.'%')
                   ->orWhere('location', 'like', '%'.$search.'%');
            });
        }

        if ($request->boolean('open_now')) {
            $now = now()->format('H:i:s');
            $query->where('open_time', '<=', $now)
                  ->where('close_time', '>=', $now);
        }

        $canteens = $query->orderBy('name')->paginate(12);

        return view('student.canteens.index', compact('canteens'));
    }

    public function show(Canteen $canteen)
    {
        $query = $canteen->menus()->where('availability', true);

        if (request('search')) {
            $search = request('search');
            $query->where('item_name', 'like', "%{$search}%");
        }

        if (request('meal_type')) {
            $query->where('meal_type', request('meal_type'));
        }

        $menus = $query->orderBy('meal_type')
                       ->orderBy('item_name')
                       ->get();

        return view('student.canteens.show', [
            'canteen' => $canteen,
            'menus'   => $menus,
        ]);
    }
}
