<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuBrowseController extends Controller
{
    public function index(Request $request)
    {
        $mealType = $request->get('meal_type', 'lunch');   // default meal
        $search   = $request->get('search');               // new search term

        $menusQuery = Menu::with('canteen')
            ->where('meal_type', $mealType);

        // If search text is provided, filter by item_name or curries
        if (!empty($search)) {
            $menusQuery->where(function ($q) use ($search) {
                $q->where('item_name', 'like', '%' . $search . '%')
                  ->orWhere('curries', 'like', '%' . $search . '%');
            });
        }

        $menus = $menusQuery
            ->orderBy('canteen_id')
            ->get();

        return view('student.menus.index', compact('menus', 'mealType', 'search'));
    }
}

