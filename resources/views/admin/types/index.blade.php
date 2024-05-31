@extends('layouts.admin')

@section('content')
    <h2>Types</h2>

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
        <form action="{{ route('admin.types.store') }}" method="POST" class="d-flex">
            @csrf
            <input class="form-control me-2" type="search" placeholder="Add" name="name">
            <button class="btn btn-outline-success" type="submit">Send</button>
        </form>
    </div>

    <table class="table crud-table w-50">
        <thead>
            <tr>
                <th scope="col">Types</th>
                <th class="second_th" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td class="last_td">
                        <form action="{{ route('admin.types.update', $type->id) }}" method="POST"
                            id="form-edit-{{ $type->id }}">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{ $type->name }}" name="name">
                        </form>
                    </td>

                    <td>
                        <div class="d-flex">
                            <button class="btn my_bgy me-2" onclick="submitForm({{ $type->id }})"><i
                                    class="fa-solid fa-pencil"></i></button>

                                    @include('admin.partials.delete-form', ['route'=> route('admin.types.destroy', $type->id),
                                                                                            'message'=>'Are you sure to delete this type?',
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
