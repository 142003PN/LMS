@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb4">
            <div class="catalog-heading">
                <i class="fas fa-building fa-lg"></i>
                <h3>Departments</h3>
            </div>
            <div class="catalog-page-actions">
                <a class="btn btn-primary d-flex" type="button" href="{{ route('department.create') }}">
                    <i class="fas fa-plus"></i><span class="add-label">Add Department</span>
                </a>
                <a href="{{ route('dashboard') }}" type="button" class="btn" aria-label="Back to dashboard" title="Back to dashboard">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
        @include('departments.messages')
        <div class="card shadow-sm border-0 h-100 mt-4">
            <div class="card-board">
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Department Name</th>
                            <th>Head of Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr onclick="window.location.href=this.querySelector('a').href">
                                <td>{{ $departments->firstItem() + $loop->index }}</td>
                                <td><a class="text-reset text-decoration-none" href="{{ route('department.show', $department) }}">{{ $department->name }}</a></td>
                                <td>{{ $department->hod ? $department->hod->first_name.' '.$department->hod->last_name : 'Unassigned' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No departments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-3">{{ $departments->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </main>
@endsection
