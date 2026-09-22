@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb4">
            <div class="catalog-heading">
                <i class="fas fa-plus fa-lg"></i>
                <h3>Add Department</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="departments.html" type="button" class="btn" aria-label="Back to dashboard" title="Back to dashboard">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
        <div class="card shadow-sm border-0 h-100 mt-4">
            <div class="card-board">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="departmentName">Department Name</label>
                        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
                    </div>
                    <div class="form-group">
                        <label for="headOfDepartment">Head of Department</label>
                        <input type="text" class="form-control" id="headOfDepartment" name="headOfDepartment" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Department</button>
                </form>
            </div>
        </div>
    </main>
@endsection