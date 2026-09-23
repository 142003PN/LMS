@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb4">
            <div class="catalog-heading">
                <i class="fas fa-users fa-lg"></i>
                <h3>Staff</h3>
            </div>
            <div class="catalog-page-actions">
                <a class="btn btn-primary d-flex" type="button" href="{{ route('staff.create') }}">
                    <i class="fas fa-plus"></i><span class="add-label">Add Staff</span>
                </a>
                <a href="{{ route('dashboard') }}" type="button" class="btn" aria-label="Back to dashboard" title="Back to dashboard">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
        @include('staff.messages')
        <div class="card shadow-sm border-0 h-100 mt-4">
            <div class="card-board">
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Staff Name</th>
                            <th>Department</th>
                            <th>NRC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffMembers as $staff)
                            <tr onclick="window.location.href=this.querySelector('a').href">
                                <td>{{ $staffMembers->firstItem() + $loop->index }}</td>
                                <td><a class="text-reset text-decoration-none" href="{{ route('staff.show', $staff) }}">{{ $staff->user->first_name }} {{ $staff->user->last_name }}</a></td>
                                <td>{{ $staff->department?->name ?? 'Unassigned' }}</td>
                                <td>{{ $staff->nrc }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No staff yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-3">{{ $staffMembers->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </main>
@endsection
