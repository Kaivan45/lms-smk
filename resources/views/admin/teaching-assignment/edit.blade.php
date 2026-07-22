@extends('layouts.app')

@section('title', 'Edit Penugasan Mengajar')

@section('sidebar-menu')
    @include('layouts.partials.sidebar-menu')
@endsection

@section('content')
    <div class="mb-3">
        <h4 class="fw-medium mb-0">Edit Penugasan Mengajar</h4>
        <p class="text-muted small mb-0">
            {{ $teachingAssignment->teacher->name ?? '-' }} &middot;
            {{ $teachingAssignment->subject->name ?? '-' }} &middot;
            {{ $teachingAssignment->schoolClass->name ?? '-' }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.penugasan-mengajar.update', $teachingAssignment) }}" method="POST">
                @method('PUT')
                @include('admin.teaching-assignment._form')
            </form>
        </div>
    </div>
@endsection
