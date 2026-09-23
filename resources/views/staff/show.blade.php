@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb-4">
            <div class="catalog-heading">
                <i class="fas fa-user fa-lg"></i>
                <h3>{{ $staff->user->first_name }} {{ $staff->user->last_name }}</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="{{ route('staff.edit', $staff) }}" class="btn btn-primary"><i class="fas fa-edit"></i><span>Edit</span></a>
                <form action="{{ route('staff.destroy', $staff) }}" method="POST" data-confirm='{"title":"Delete staff","message":"Delete this staff member? This cannot be undone.","icon":"warning","confirmButtonText":"Yes, delete it","cancelButtonText":"Cancel"}'>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i><span>Delete</span></button>
                </form>
                <a href="{{ route('staff.index') }}" type="button" class="btn" aria-label="Back to staff" title="Back to staff">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>

        @include('staff.messages')
        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 h-100 detail-card">
                    <div class="detail-card-header">
                        <h4>Staff profile</h4>
                    </div>
                    <div class="department-profile-box">
                        <div class="department-badge">{{ mb_substr($staff->user->first_name, 0, 1) }}{{ mb_substr($staff->user->last_name, 0, 1) }}</div>
                        <div>
                            <h5>{{ $staff->user->first_name }} {{ $staff->user->last_name }}</h5>
                            <span>{{ str_replace('_', ' ', $staff->user->role) }}</span>
                        </div>
                    </div>
                    <ul class="detail-info-list">
                        <li>
                            <span class="label">Email</span>
                            <strong>{{ $staff->user->email }}</strong>
                        </li>
                        <li>
                            <span class="label">Phone</span>
                            <strong>{{ $staff->user->phone_number }}</strong>
                        </li>
                        <li>
                            <span class="label">Department</span>
                            <strong>{{ $staff->department?->name ?? 'Unassigned' }}</strong>
                        </li>
                        <li>
                            <span class="label">Created</span>
                            <strong>{{ $staff->created_at->format('d M Y') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0 detail-card">
                    <div class="detail-card-header">
                        <h4>Staff details</h4>
                    </div>
                    <div class="performance-grid">
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Full name</span>
                                <strong>{{ $staff->user->first_name }} {{ $staff->user->last_name }}</strong>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Email address</span>
                                <strong>{{ $staff->user->email }}</strong>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Phone number</span>
                                <strong>{{ $staff->user->phone_number }}</strong>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>NRC number</span>
                                <strong>{{ $staff->nrc }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 detail-card mt-4">
                    <div class="detail-card-header">
                        <h4>Assigned department</h4>
                    </div>
                    <div class="card-board">
                        <table>
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $staff->department?->name ?? 'Unassigned' }}</td>
                                    <td>{{ str_replace('_', ' ', $staff->user->role) }}</td>
                                    <td>Active</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
