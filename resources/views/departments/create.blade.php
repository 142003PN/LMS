@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb-4">
            <div class="catalog-heading">
                <i class="fas fa-plus fa-lg"></i>
                <h3>Add Department</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="{{ route('department.index') }}" type="button" class="btn" aria-label="Back to departments" title="Back to departments">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
        @include('departments.messages')
        <div class="card editor-card mt-4">
            <div class="card-board">
                <form class="editor-form" action="{{ route('department.store') }}" method="POST">
                    @include('departments.form')
                </form>
            </div>
        </div>
    </main>
@endsection
