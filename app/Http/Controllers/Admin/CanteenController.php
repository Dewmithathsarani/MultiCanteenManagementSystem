<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canteen;
use App\Models\User;

class CanteenController extends Controller
{
     public function index()
    {
        $canteens = Canteen::latest()->paginate(10);

        return view('admin.canteens.index', compact('canteens'));
    }

    public function create()
    {
        $owners = User::where('role', 'canteen')->get();

        return view('admin.canteens.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'open_time'   => 'nullable',
            'close_time'  => 'nullable',
            'user_id'     => 'nullable|exists:users,id',
        ]);

        $canteen = Canteen::create([
        'name'        => $request->name,
        'location'    => $request->location,
        'description' => $request->description,
        'open_time'   => $request->open_time,
        'close_time'  => $request->close_time,
        'user_id'     => $request->user_id,
        ]);

        if ($request->filled('user_id')) {
        User::where('id', $request->user_id)->update([
            'role'       => 'canteen',
            'canteen_id' => $canteen->id,
        ]);
        }

        return redirect()->route('admin.canteens.index')
        ->with('success', 'Canteen created successfully.');
    }

    public function edit(Canteen $canteen)
    {
        $owners = User::where('role', 'canteen')->get();

        return view('admin.canteens.edit', compact('canteen', 'owners'));
    }

    public function update(Request $request, Canteen $canteen)
    {
        $request->validate([
        'name'        => 'required|string|max:255',
        'location'    => 'required|string|max:255',
        'description' => 'nullable|string',
        'open_time'   => 'required',
        'close_time'  => 'required',
        'user_id'     => 'nullable|exists:users,id',
    ]);

       $canteen->update([
        'name'        => $request->name,
        'location'    => $request->location,
        'description' => $request->description,
        'open_time'   => $request->open_time,
        'close_time'  => $request->close_time,
        // add this line:
        'user_id'     => $request->user_id,
    ]);

    return redirect()->route('admin.canteens.index')
        ->with('success', 'Canteen updated successfully.');
    }

    public function destroy(Canteen $canteen)
    {
        $canteen->delete();

        return redirect()->route('admin.canteens.index')
            ->with('success', 'Canteen deleted successfully.');
    }

    public function show(Canteen $canteen)
    {
        $canteen->load(['reviews.user']); // <-- add here

        return view('student.canteens.show', compact('canteen'));
    }
}
