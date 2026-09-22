@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="row g-3 g-lg-4 mb-4 dashboard-stat-cards">
            <div class="col-6 col-xl-3">
                <a href="#" class="text-decoration-none text-reset">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-cog fa-lg"></i>
                            </div>
                            <div class="ecms-tg-stat-copy">
                                <h6 class="text-muted mb-1">Classes</h6>
                                    <p class="fs-3 fw-bold mb-0 text-primary">10</p>
                                </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a href=""  class="text-decoration-none text-reset">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-building fa-lg"></i>
                            </div>
                            <div class="ecms-tg-stat-copy">
                                <h6 class="text-muted mb-1">Departments</h6>
                                <p class="fs-3 fw-bold mb-0 text-primary">15</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3" style="cursor: pointer;" onclick="window.location.href=''">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-graduate fa-lg"></i>
                        </div>
                        <div class="ecms-tg-stat-copy">
                            <h6 class="text-muted mb-1">Learners</h6>
                            <p class="fs-3 fw-bold mb-0 text-primary">5</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <a href="" class="text-decoration-none text-reset">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-chalkboard-teacher fa-lg"></i>
                            </div>
                            <div class="ecms-tg-stat-copy">
                                <h6 class="text-muted mb-1">Teachers</h6>
                                <p class="fs-3 fw-bold mb-0 text-primary">23</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    </div>

        <div class="row g-3 g-lg-4 dashboard-charts">
            <div class="col-12 col-xl-8">
                <section class="card chart-card h-100">
                    <div class="chart-card-header">
                        <div>
                            <h2>Enrollment overview</h2>
                            <p>New learners added this year</p>
                        </div>
                        <span class="chart-period">2026</span>
                    </div>
                    <div class="chart-container">
                        <canvas id="enrollment-chart" aria-label="Line chart showing learner enrollment throughout 2024"></canvas>
                    </div>
                </section>
            </div>
            <div class="col-12 col-xl-4">
                <section class="card chart-card h-100">
                    <div class="chart-card-header">
                        <div>
                            <h2>Department mix</h2>
                            <p>Learners by department</p>
                        </div>
                    </div>
                    <div class="chart-container chart-container-doughnut">
                        <canvas id="department-chart" aria-label="Doughnut chart showing learners by department"></canvas>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
