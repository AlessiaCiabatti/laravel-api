@extends('layouts.admin')

@section('content')
    <h1>Technologies</h1>

    @if ($errors->any())
        <div class="w-50 alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="w-50 alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="w-50 alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <div class="my-4 w-50">
        <form action="{{ route('admin.technologies.store') }}" method="POST" class="d-flex">
            @csrf
            <input class="form-control me-2" type="search" placeholder="Add" name="name">
            <button class="btn btn-outline-success" type="submit">Send</button>
        </form>
    </div>

    <table class="table crud-table w-50">
        <thead>
            <tr>
                <th scope="col">Technology</th>
                <th class="second_th" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <td>
                        <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST"
                            id="form-edit-{{ $technology->id }}">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{ $technology->name }}" name="name">
                        </form>
                    </td>

                    <td>
                        <div class="d-flex">
                            <button class="btn my_bgy me-2" onclick="submitForm({{ $technology->id }})"><i
                                    class="fa-solid fa-pencil"></i></button>

                                    @include('admin.partials.delete-form', ['route'=> route('admin.technologies.destroy', $technology->id),
                                                                            'message'=>'Are you sure to delete this technology?',
                                                                            ])
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function submitForm(id) {
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>
@endsection
