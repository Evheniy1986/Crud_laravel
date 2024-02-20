@extends('layouts.main')

@section('title', 'CRUD')

@section('content')
    @if (isset($user))
        <h1 class="text-center mb-3">Редактировать Пользователя</h1>
    @else
    <h1 class="text-center mb-3">Создать Пользователя</h1>
    @endif

    <form
        action="{{isset($user) ? route('users.update', $user) : route('users.store') }}"
        method="post" class="w-50 m-auto">
        @csrf
        @isset($user)
            @method('patch')
        @endisset
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input name="name" value="{{isset($user) ? $user->name : old('name') }}" type="text" class="form-control" id="exampleFormControlInput1"
                   placeholder="Введите ваше имя">
            @error('name')
               <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input name="email" value=" {{isset($user) ? $user->email : old('email') }} " type="email" class="form-control" id="exampleFormControlInput1"
                   placeholder="Введите ваш Email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <input class="btn btn-primary" type="submit" value="Create">
    </form>
@endsection
