<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    public function index(DepartmentResource $request)
    {
        $departments = Department::with('hod')->orderBy('name')->paginate(15);

        return view('departments.index', compact('departments'));
    }

    public function create(DepartmentResource $request)
    {
        $department = new Department;
        $heads = User::where('role', User::HOD)->orderBy('first_name')->orderBy('last_name')->get();

        return view('departments.create', compact('department', 'heads'));
    }

    public function store(DepartmentResource $request)
    {
        $department = Department::create($request->validated());

        return redirect()->route('department.show', $department)->with('success', 'Department created.');
    }

    public function show(DepartmentResource $request, Department $department)
    {
        $department->load('hod');

        return view('departments.show-department', compact('department'));
    }

    public function edit(DepartmentResource $request, Department $department)
    {
        $heads = User::where('role', User::HOD)->orderBy('first_name')->orderBy('last_name')->get();

        return view('departments.edit', compact('department', 'heads'));
    }

    public function update(DepartmentResource $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('department.show', $department)->with('success', 'Department updated.');
    }

    public function destroy(DepartmentResource $request, Department $department)
    {
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department deleted.');
    }
}
