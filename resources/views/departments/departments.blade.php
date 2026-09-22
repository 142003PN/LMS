@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb4">
            <div class="catalog-heading">
                <i class="fas fa-building fa-lg"></i>
                <h3>Departments</h3>
            </div>
            <div class="catalog-page-actions">
                <a class="btn btn-primary d-flex" type="button" href="create.html">
                    <i class="fas fa-plus"></i><span class="add-label">Add Department</span>
                </a>
                <a href="dashboard.html" type="button" class="btn" aria-label="Back to dashboard" title="Back to dashboard">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
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
                        <tr onclick="window.location.href='show-department.html'">
                            <td>1</td>
                            <td>Mathematics</td>
                            <td>Chanda Tembo</td>
                        </tr>
                        <tr onclick="window.location.href='show-department.html'">
                            <td>2</td>
                            <td>Science</td>
                            <td>Jane Smith</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection