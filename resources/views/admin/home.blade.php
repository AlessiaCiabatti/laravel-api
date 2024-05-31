@php
    use App\Function\Helper;
@endphp


@extends('layouts.admin')

@section('content')
    <h1>There are {{ $count_project }} projects</h1>

    <div class="date d-flex justify-content-end">
        <p>Last project: {{ Helper::formatDate($last_project->updated_at) }}</p>
    </div>

    <div class="mt-4">
        <h2>{{ $last_project->title }}</h2>
        <p>{{ $last_project->text }}</p>
    </div>
@endsection
