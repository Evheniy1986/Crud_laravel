@extends('layouts.main')

@section('title', 'show')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h1 class="text-center mb-5">Создать Юзера</h1>
    <div><a class="btn btn-secondary" href="{{ route('users.index') }}">Back</a></div>
    <div class="card m-auto" style="width: 30rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">User Name: {{ $user->name }}</li>
            <li class="list-group-item">User Email: {{ $user->email }}</li>
            <li class="list-group-item">User Created: {{ $user->created_at->format('H:i:s d-m-Y') }}</li>
            <li class="list-group-item">User Updated: {{ $user->updated_at->format('H:i:s d-m-Y') }}</li>
        </ul>
        <a class="btn btn-warning" href="{{ route('users.edit', $user) }}">Edit</a>
        <form action="{{ route('users.destroy', $user) }}" method="post">
            @csrf
            @method('delete')
            <td>
                <button type="submit" class="btn btn-danger w-100">Delete</button>
            </td>
        </form>
    </div>
@endsection
