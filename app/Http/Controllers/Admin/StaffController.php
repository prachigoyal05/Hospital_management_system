<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StaffExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class StaffController extends Controller
{
     public function index(Request $request)
    {
        // Base query for staff only
        $staff = User::where('role', 'staff');

        // Apply search if present
        if ($request->has('search')) {
            $staff->where(function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                      ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        // Apply status filter if present
        if ($request->has('status')) {
            $staff->where('is_active', $request->status == 'active');
        }

        // Apply sorting
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $staff->orderBy($sort, $direction);

        // Get paginated results
        $staff = $staff->latest()->paginate(10);

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

    public function show($id)
   {
    $staff = User::findOrFail($id);
    return view('admin.staff.show', compact('staff'));
}

    public function export() 
{
    return Excel::download(new StaffExport, 'staff_'.now()->format('Y-m-d').'.xlsx');
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
