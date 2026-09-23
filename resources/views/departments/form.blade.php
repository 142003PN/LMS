@csrf
<h4 class="editor-form-title">Department details</h4>
<div class="form-grid">
<div class="form-group">
    <label for="name">Department Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $department->name) }}" maxlength="20" required>
</div>
<div class="form-group">
    <label for="hod_id">Head of Department</label>
    <select class="form-control" id="hod_id" name="hod_id">
        <option value="">Unassigned</option>
        @foreach ($heads as $head)
            <option value="{{ $head->id }}" @selected((string) old('hod_id', $department->hod_id) === (string) $head->id)>{{ $head->first_name }} {{ $head->last_name }} (ID: {{ $head->id }})</option>
        @endforeach
    </select>
</div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary">{{ $department->exists ? 'Save changes' : 'Add Department' }}</button>
    <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>
</div>
