@extends('layouts.app')
@section('content')
    <main id="main-content" class="p-4">
        <div class="catalog-page-header mb-4">
            <div class="catalog-heading">
                <i class="fas fa-plus fa-lg"></i>
                <h3>Add Staff</h3>
            </div>
            <div class="catalog-page-actions">
                <a href="{{ route('staff.index') }}" type="button" class="btn" aria-label="Back to staff" title="Back to staff">
                    <i class="fas fa-arrow-left"></i><span class="back-label">Back</span>
                </a>
            </div>
        </div>
        @include('staff.messages')
        <div class="card editor-card mt-4">
            <div class="card-board">
                <form class="editor-form" action="{{ route('staff.store') }}" method="POST">
                    @include('staff.form')
                </form>
            </div>
        </div>
    </main>
@endsection
