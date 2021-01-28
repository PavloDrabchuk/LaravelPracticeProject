@extends('layouts.app')

@if($errors->any())
    <h3>Errors</h3>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@section('content')
    <h1>Edit</h1>

    <form action="{{route('users.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:
            <input type="text" name="name" value="{{$user->name}}" placeholder="Name">
        </label>

        <br/>

        <label for="phone">Phone:
            <input type="tel" name="phone" value="{{$user->phone}}" placeholder="Name">
        </label>

        <br/>

        <label for="password">Password:
            <input type="password" name="password" placeholder="password">
        </label>
        <br/>
        <label for="password">Password confirm:
            <input type="password" name="password_confirmation" placeholder="password">
        </label>
        <br/>

        <input type="submit" value="Edit user">
    </form>

    <a href="{{route('users.index')}}">Go back</a>

@endsection
