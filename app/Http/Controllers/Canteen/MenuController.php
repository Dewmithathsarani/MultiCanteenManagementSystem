<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuController extends Controller
{
    public function index()
    {
        // for now, show all items – later you can filter by owner canteen_id
          $canteen = auth()->user()->canteen;

    if (! $canteen) {
        // empty paginator if no canteen assigned
        $menus = new LengthAwarePaginator(
            collect([]),
            0,
            10,
            1,
            ['path' => request()->url()]
        );

        return view('canteen.menu.index', compact('menus'))
            ->with('message', 'No canteen is assigned to your account yet.');
    }

    $menus = $canteen->menus()
        ->latest()
        ->paginate(10);

    return view('canteen.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('canteen.menu.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'canteen_id'   => 'required|integer',
            'item_name'    => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'meal_type'    => 'required|string',
            'curries'      => 'nullable|string',
            'availability' => 'nullable|boolean',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]); // [web:848][web:852]

        $data = $request->all();
        $data['availability'] = $request->has('availability');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('menu_photos', 'public');
            $data['photo_path'] = $path; // column in menus table
        }

        Menu::create($data);

        return redirect()
            ->route('canteen.menu.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'item_name'    => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'availability' => 'nullable|boolean',
            'meal_type'    => 'required|string',
            'curries'      => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'item_name'    => $request->item_name,
            'price'        => $request->price,
            'availability' => $request->boolean('availability'),
            'meal_type'    => $request->meal_type,
            'curries'      => $request->curries,
        ];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('menu_photos', 'public');
            $data['photo_path'] = $path;
        }

        $menu->update($data);

        return redirect()->route('canteen.menu.index')
            ->with('success', 'Menu item updated successfully.');
    }
    
    public function edit(Menu $menu)
    {
        return view('canteen.menu.edit', compact('menu'));
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('canteen.menu.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
