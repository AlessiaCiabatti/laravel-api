@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">List technologies</h1>

    <table class="tech-pro table crud-table">
        <thead>
            <tr>
                <th scope="col">Technology</th>
                <th class="second_th" scope="col">Projects</th>
                {{-- <th class="second_th" scope="col">Type</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <td class="last_td w-25">
                        {{ $technology->name }}
                    </td>
                    <td>
                        <ul class="list-group d-flex">
                            @foreach ($technology->projects as $projects)
                                <li class="list-group-item py-4">
                                    <a class="text-black" href="{{ route('admin.projects.show', $projects) }}">
                                        {{ $projects->id }} - {{ $projects->title }}
                                    </a>

                                    <div class="d-flex justify-content-end">
                                        <div>
                                            {{-- Types: --}}
                                            @forelse ($projects->types as $type)
                                                <span class="badge bg">{{ $type->name }} </span>
                                            @empty
                                                No types
                                            @endforelse
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
