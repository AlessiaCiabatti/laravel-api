@php
    use App\Function\Helper;
@endphp


@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Edit of {{ $project->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="w-50" action="{{ route('admin.projects.update', $project) }}" method="POST"
    enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title (*)</label>
            <input class="form-control @error('title') is-invalid @enderror" id="title" type="text" placeholder="Title" name="title" value="{{ old('title', $project->title) }}">
            @error('title')
                <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Technology</label>

            <select name="technology_id" class="form-select" aria-label="Default select example">
                <option value="">Select Technology</option>
                @foreach ($technologies as $technology)
                    <option value="{{ $technology->id }}"
                        @if (old('technology_id' , $project->technology?->id) == $technology->id) selected @endif
                        >{{ $technology->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Types: </label>
            <div class="btn-group btn-group-sm" role="group">

                @foreach ($types as $type)
                    <input name="types[]" id="type_{{ $type->id }}" type="checkbox"
                        class="btn-check" id="btncheck1" autocomplete="off"
                        value="{{ $type->id }}"
                        @if ( $errors->any() && in_array($type->id, old('types', []))
                        || !$errors->any() && $project->types->contains($type->id))
                        checked @endif>
                    <label class="btn btn-outline-primary" for="type_{{ $type->id }}">{{ $type->name }}</label>
                @endforeach

            </div>
        </div>

        <div class="mb-3">
            <label for="reading_time" class="form-label">Reading time</label>
            <input class="form-control" id="reading_time" type="number" placeholder="Reading time" name="reading_time" value="{{ old('reading_time', $project->reading_time) }}">
        </div>

        <div class="mb-3">
            <label id="thumb" for="image" class="form-label">Image</label>
            <input class="form-control" id="image" type="file" name="image"
            onchange="showImage(event)">
            <img src="{{ asset('storage/' . $project->image) }}" class="thumb" onerror="this.src='/img/no-image.jpg'">
            <p>{{ $project->image_original_name }}</p>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Description (*)</label>
            <textarea class="form-control me-2 @error('text') is-invalid @enderror" name="text"> {{  old('text', $project->text) }}</textarea>
            @error('text')
                <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-outline-success" type="submit">Send</button>
            <button class="btn my_bgr">Reset</button>
        </div>
    </form>

    <script>
        function showImage(event){
            const thumb = document.getElementById('thumb');
            console.log(thumb);
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
