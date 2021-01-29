@extends('layouts.users_app')

@if($errors->any())
    <h3>Errors</h3>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@section('content')
    <h1>Show</h1>
    <h3>Name: {{$user->name}}</h3>
    <h3>Phone: {{$user->phone}}</h3>

    <a href="{{route('users.index')}}">Go back</a>
@endsection
