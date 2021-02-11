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

    <div class="col-lg-4">
        <div class="top-campaign">
            <h3 class="title-5 m-b-15">User information</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$user->phone}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="{{route('users.index')}}">Go back</a>
@endsection
