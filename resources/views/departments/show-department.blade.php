@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb-4">
            <div class="catalog-heading">
                <i class="fas fa-building fa-lg"></i>
                <h3>{{ $department->name }} Department</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="{{ route('department.edit', $department) }}" class="btn btn-primary"><i class="fas fa-edit"></i><span>Edit</span></a>
                <form action="{{ route('department.destroy', $department) }}" method="POST" data-confirm='{"title":"Delete department","message":"Delete this department? This cannot be undone.","icon":"warning","confirmButtonText":"Yes, delete it","cancelButtonText":"Cancel"}'>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i><span>Delete</span></button>
                </form>
                <a href="{{ route('department.index') }}" type="button" class="btn" aria-label="Back to departments" title="Back to departments">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>

        @include('departments.messages')
        <p class="text-muted">Learner, staff, subject and performance statistics are not available yet.</p>
        <div class="detail-summary row g-3 g-lg-4 mb-4">
            <div class="col-12 col-md-4">
                <div class="detail-stat-card card shadow-sm border-0 h-100">
                    <div class="detail-stat-card-body">
                        <div class="icon-badge icon-primary">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <p>Total learners</p>
                            <h4>&mdash;</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="detail-stat-card card shadow-sm border-0 h-100">
                    <div class="detail-stat-card-body">
                        <div class="icon-badge icon-success">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <p>Teaching staff</p>
                            <h4>&mdash;</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="detail-stat-card card shadow-sm border-0 h-100">
                    <div class="detail-stat-card-body">
                        <div class="icon-badge icon-warning">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <p>Subjects</p>
                            <h4>&mdash;</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 h-100 detail-card">
                    <div class="detail-card-header">
                        <h4>Department profile</h4>
                    </div>
                    <div class="department-profile-box">
                        <div class="department-badge">{{ mb_substr($department->name, 0, 1) }}</div>
                        <div>
                            <h5>{{ $department->name }}</h5>
                            <span>Academic department</span>
                        </div>
                    </div>
                    <ul class="detail-info-list">
                        <li>
                            <span class="label">Head of Department</span>
                            <strong>{{ $department->hod ? $department->hod->first_name.' '.$department->hod->last_name : 'Unassigned' }}</strong>
                        </li>
                        <li>
                            <span class="label">Email</span>
                            <strong>{{ $department->hod?->email ?? 'Not available' }}</strong>
                        </li>
                        <li>
                            <span class="label">Created</span>
                            <strong>{{ $department->created_at->format('d M Y') }}</strong>
                        </li>
                        <li>
                            <span class="label">Classes</span>
                            <strong>Not available</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0 detail-card">
                    <div class="detail-card-header">
                        <h4>Department performance</h4>
                    </div>
                    <div class="performance-grid">
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Exam pass rate</span>
                                <strong>Not available</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 0%;"></span>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Attendance</span>
                                <strong>Not available</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 0%;"></span>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Homework completion</span>
                                <strong>Not available</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 0%;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 detail-card mt-4">
                    <div class="detail-card-header">
                        <h4>Assigned faculty</h4>
                    </div>
                    <div class="card-board">
                        <table>
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Class</th>
                                </tr>
                            </thead>
                            <tbody><tr><td colspan="3">Faculty assignments are not available yet.</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
