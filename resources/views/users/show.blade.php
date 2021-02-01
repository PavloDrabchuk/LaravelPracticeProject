@extends('layouts.dashboard_app')



@section('content')

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <h3>Errors</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Show</h1>

    <h3>Name: {{$user->name}}</h3>
    <h3>Phone: {{$user->phone}}</h3>

    <a href="{{route('users.index')}}">Go back</a>
@endsection
