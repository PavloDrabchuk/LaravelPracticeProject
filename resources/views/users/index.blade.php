@extends('layouts.app')

@section('content')
    <h1>Users | Index</h1>
    <a href="{{route('users.create')}}">Create</a>
{{--    <a href="{{route('users.show')}}">Read</a>--}}
{{--    <a href="{{route('users.edit')}}">Update</a>--}}

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>CRUD</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$loop->index}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            <a href="{{route('users.show',$user->id)}}">Read</a>
                            <a href="{{route('users.edit',$user->id)}}">Update</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

