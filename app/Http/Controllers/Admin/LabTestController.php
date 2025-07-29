<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LabTest;

class LabTestController extends Controller
{
    public function index()
{
    $tests = LabTest::paginate(10);
    return view('admin.lab_tests.index', compact('tests'));
}

public function create()
{
    return view('admin.lab_tests.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'nullable|numeric',
    ]);

    LabTest::create($request->all());

    return redirect()->route('admin.lab-tests.index')->with('success', 'Test added.');
}

public function edit(LabTest $labTest)
{
    return view('admin.lab_tests.edit', compact('labTest'));
}

public function update(Request $request, LabTest $labTest)
{
    $request->validate([
        'name' => 'required',
        'price' => 'nullable|numeric',
    ]);

    $labTest->update($request->all());

    return redirect()->route('admin.lab-tests.index')->with('success', 'Test updated.');
}

public function destroy(LabTest $labTest)
{
    $labTest->delete();
    return redirect()->route('admin.lab-tests.index')->with('success', 'Test deleted.');
}

}
