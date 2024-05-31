@php
    use App\Function\Helper;
@endphp


@extends('layouts.admin')

@section('content')
    <h1 class="my-4">{{ $project->title }} - {{ Helper::formatDate($project->updated_at) }}</h1>
    @if ($project->technology)
        <p>Technology: <span class="badge bg"> {{ $project->technology->name }} </span></p>
    @endif

    @if (count($project->types) > 0)
    <p> Type:@foreach ($project->types as $type)
            <span class="badge bg"> {{ $type->name }} </span>
            </td>
        @endforeach </p>
    @endif

    <p>Time reading: {{ $project->reading_time }} mins.</p>

    <div class="mt-4">
        <img class="mt-3 mb-3 img-fluid" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->tutle }}"
            onerror="this.src = '/img/no-image.jpg'">
        <p>{{ $project->image_original_name }}</p>
        <p>{{ $project->text }}</p>
    </div>
@endsection
