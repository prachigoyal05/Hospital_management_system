<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class StaffController extends Controller
{
    public function index()
    {
          $staff = User::where('role', 'staff')->latest()->paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:staff,doctor,nurse,admin',
        'department' => 'nullable|string|max:255'
    ]);

    // Then use the validated data consistently
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'],
        'department' => $validated['department'] ?? null
    ]);


        return redirect()->route('admin.staff.index')->with('success', 'Staff created successfully.');
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $staff->id,
        ]);

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully.');
    }
}
