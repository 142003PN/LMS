@csrf
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $staff->user?->first_name) }}" maxlength="255" required>
</div>
<div class="form-group mt-3">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $staff->user?->last_name) }}" maxlength="255" required>
</div>
<div class="form-group mt-3">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->user?->email) }}" maxlength="255" required>
</div>
<div class="form-group mt-3">
    <label for="phone_number">Phone Number</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $staff->user?->phone_number) }}" maxlength="255" required>
</div>
@if (! $staff->exists)
    <div class="form-group mt-3">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option value="">Select a role</option>
            <option value="{{ App\Models\User::TEACHER }}" @selected(old('role') === App\Models\User::TEACHER)>Teacher</option>
            <option value="{{ App\Models\User::HOD }}" @selected(old('role') === App\Models\User::HOD)>HOD</option>
            <option value="{{ App\Models\User::DEPUTY_HEAD_TEACHER }}" @selected(old('role') === App\Models\User::DEPUTY_HEAD_TEACHER)>Deputy Head Teacher</option>
        </select>
    </div>
    <div class="form-group mt-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
    </div>
@else
    <div class="form-group mt-3">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option value="{{ App\Models\User::TEACHER }}" @selected(old('role', $staff->user?->role) === App\Models\User::TEACHER)>Teacher</option>
            <option value="{{ App\Models\User::HOD }}" @selected(old('role', $staff->user?->role) === App\Models\User::HOD)>HOD</option>
            <option value="{{ App\Models\User::DEPUTY_HEAD_TEACHER }}" @selected(old('role', $staff->user?->role) === App\Models\User::DEPUTY_HEAD_TEACHER)>Deputy Head Teacher</option>
        </select>
    </div>
@endif
<div class="form-group mt-3">
    <label for="dept_id">Department</label>
    <select class="form-control" id="dept_id" name="dept_id" @disabled(auth()->user()?->canManageStaff() === false && $staff->exists)>
        <option value="">Unassigned</option>
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" @selected((string) old('dept_id', $staff->dept_id) === (string) $department->id)>{{ $department->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group mt-3">
    <label for="nrc">NRC</label>
    <input type="text" class="form-control" id="nrc" name="nrc" value="{{ old('nrc', $staff->nrc) }}" maxlength="255" required>
</div>
<button type="submit" class="btn btn-primary mt-3">{{ $staff->exists ? 'Save changes' : 'Add Staff' }}</button>
