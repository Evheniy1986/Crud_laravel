@extends('layouts.main')

@section('title', 'CRUD')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('users.index') }}" method="get">
        <div class="d-flex">
            <input type="text" name="name" class="form-control w-25">
            <input type="submit" value="search" class="btn btn-success ml-1">
        </div>
    </form>
    <h1 class="text-center mb-3">Таблица Пользователей</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td><a class="btn btn-warning" href="{{ route('users.edit', $user) }}">Edit</a></td>
                <form action="{{ route('users.destroy', $user) }}" method="post">
                    @csrf
                    @method('delete')
                    <td>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </td>
                </form>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
@endsection
