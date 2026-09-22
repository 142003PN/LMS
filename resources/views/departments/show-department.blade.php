@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb-4">
            <div class="catalog-heading">
                <i class="fas fa-building fa-lg"></i>
                <h3>Mathematics Department</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="departments.html" type="button" class="btn" aria-label="Back to departments" title="Back to departments">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>

        <div class="detail-summary row g-3 g-lg-4 mb-4">
            <div class="col-12 col-md-4">
                <div class="detail-stat-card card shadow-sm border-0 h-100">
                    <div class="detail-stat-card-body">
                        <div class="icon-badge icon-primary">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <p>Total learners</p>
                            <h4>248</h4>
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
                            <h4>12</h4>
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
                            <h4>06</h4>
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
                        <div class="department-badge">M</div>
                        <div>
                            <h5>Mathematics</h5>
                            <span>Academic department</span>
                        </div>
                    </div>
                    <ul class="detail-info-list">
                        <li>
                            <span class="label">Head of Department</span>
                            <strong>Chanda Tembo</strong>
                        </li>
                        <li>
                            <span class="label">Email</span>
                            <strong>chanda.tembo@school.edu</strong>
                        </li>
                        <li>
                            <span class="label">Established</span>
                            <strong>2018</strong>
                        </li>
                        <li>
                            <span class="label">Classes</span>
                            <strong>08 classes</strong>
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
                                <strong>88%</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 88%;"></span>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Attendance</span>
                                <strong>94%</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 94%;"></span>
                            </div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-meta">
                                <span>Homework completion</span>
                                <strong>82%</strong>
                            </div>
                            <div class="progress-track">
                                <span style="width: 82%;"></span>
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
                            <tbody>
                                <tr>
                                    <td>Chanda Tembo</td>
                                    <td>Algebra</td>
                                    <td>Grade 10</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Geometry</td>
                                    <td>Grade 11</td>
                                </tr>
                                <tr>
                                    <td>Peter Ndlovu</td>
                                    <td>Statistics</td>
                                    <td>Grade 12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
