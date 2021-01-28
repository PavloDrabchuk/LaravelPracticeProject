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
    <h1>Users | Index</h1>
    <a href="{{route('users.create')}}">Create</a>

    @if($message=\Illuminate\Support\Facades\Session::get('ok'))
        <h2 style="color: #1e9e3c">{{$message}}</h2>
    @endif

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>CRUD</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                        <a href="{{route('users.show', $user->id)}}">Read</a>
                        <a href="{{route('users.edit', $user->id)}}">Update</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

