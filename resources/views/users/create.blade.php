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
    <h1>Create</h1>

    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <label for="name">Name:
            <input type="text" name="name" placeholder="name">
        </label>
        <br/>

        <label for="phone">Phone:
            <input type="tel" name="phone" placeholder="phone">
        </label>
        <br/>
        <label for="password">Password:
            <input type="password" name="password" placeholder="password">
        </label>
        <br/>
        <label for="password">Password:
            <input type="password" name="password_confirmation" placeholder="password">
        </label>
        <br/>
        <input type="submit" value="Create user" name="submit">


    </form>

@endsection
