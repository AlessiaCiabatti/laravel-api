@php
    use App\Function\Helper;
@endphp


@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Projects List</h1>

    @if (isset($_GET['toSearch']))
        <div class="date d-flex justify-content-end">
            <p>Search for: {{ $_GET['toSearch'] }} | Find: {{ $count_search }}</p>
        </div>
    @endif

    @if (session('delete'))
        <div class="w-50 alert alert-success" role="alert">
            {{ session('delete') }}
        </div>
    @endif

    <table class="table crud-table">
        <thead>
            <tr>
                <th scope="col">&#8226;<a class="text-black" href="{{ route('admin.orderBy',  ['direction'=>$direction, 'column'=>'id']) }}">ID</a></th>
                <th scope="col">&#8226;<a class="text-black" href="{{ route('admin.orderBy',  ['direction'=>$direction, 'column'=>'title']) }}">Title</a></th>
                <th scope="col">Technology</th>
                <th scope="col">Type</th>
                <th scope="col">Image</th>
                <th scope="col">&#8226;<a class="text-black" href="{{ route('admin.orderBy',  ['direction'=>$direction, 'column'=>'updated_at']) }}">Data</a></th>
                <th class="second_th-pro" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td class="project">{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->technology?->name }}</td>
                    <td>
                        @forelse ($project->types as $type)
                            <span class="badge bg"> {{ $type->name }} </span>
                        @empty
                            No types
                        @endforelse
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $project->image) }}" class="thumb-index"
                            onerror="this.src='/img/no-image.jpg'">
                    </td>
                    <td>{{ Helper::formatDate($project->updated_at) }}</td>
                    <td>
                        <div class="d-flex mx-4">
                            <a href="{{ route('admin.projects.show', $project) }}" class="btn my_bgy me-2"><i
                                    class="fa-solid fa-glasses"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn my_bgy me-2"><i
                                    class="fa-solid fa-pencil"></i></a>
                            @include('admin.partials.delete-form', [
                                'route' => route('admin.projects.destroy', $project->id),
                                'message' => 'Are you sure to delete this project?',
                            ])
                        </div>
                    </td>
                </tr>

            @empty
                <h4 class="mb-4">No items found</h4>
            @endforelse

        </tbody>
    </table>

    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
