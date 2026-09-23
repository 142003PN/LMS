<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Department;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        $staffMembers = Staff::with(['user', 'department'])->orderBy('created_at')->paginate(15);

        return view('staff.index', compact('staffMembers'));
    }

    public function create(): View
    {
        abort_unless(Auth::user()?->canManageStaff(), 403);

        $staff = new Staff;
        $users = User::whereIn('role', [User::TEACHER, User::HOD, User::DEPUTY_HEAD_TEACHER])->orderBy('first_name')->get();
        $departments = Department::orderBy('name')->get();

        return view('staff.create', compact('staff', 'users', 'departments'));
    }

    public function store(StaffRequest $request): RedirectResponse
    {
        abort_unless($request->user()?->canManageStaff(), 403);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        $staff = Staff::create([
            'user_id' => $user->id,
            'dept_id' => $request->dept_id,
            'nrc' => $request->nrc,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff member created.');
    }

    public function show(Staff $staff): View
    {
        abort_unless(Auth::user()?->canManageStaff() || Auth::id() === $staff->user_id, 403);

        $staff->load(['user', 'department']);

        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff): View
    {
        abort_unless(Auth::user()?->canManageStaff() || Auth::id() === $staff->user_id, 403);

        $users = User::whereIn('role', [User::TEACHER, User::HOD, User::DEPUTY_HEAD_TEACHER])->orderBy('first_name')->get();
        $departments = Department::orderBy('name')->get();

        return view('staff.edit', compact('staff', 'users', 'departments'));
    }

    public function update(StaffRequest $request, Staff $staff): RedirectResponse
    {
        abort_unless($request->user()?->canManageStaff() || $request->user()?->id === $staff->user_id, 403);

        $validated = $request->validated();
        $user = $staff->user;

        $user->update([
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
            'email' => $request->input('email', $user->email),
            'phone_number' => $request->input('phone_number', $user->phone_number),
            'role' => $request->input('role', $user->role),
        ]);

        if (! $request->user()?->canManageStaff()) {
            $validated['dept_id'] = $staff->dept_id;
        }

        $staff->update([
            'dept_id' => $validated['dept_id'] ?? $staff->dept_id,
            'nrc' => $request->input('nrc', $staff->nrc),
        ]);

        return redirect()->route('staff.show', $staff)->with('success', 'Staff member updated.');
    }

    public function destroy(Staff $staff): RedirectResponse
    {
        abort_unless(Auth::user()?->canManageStaff(), 403);

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member deleted.');
    }
}
