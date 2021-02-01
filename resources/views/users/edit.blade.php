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

    <h1>Edit user</h1>

    <div class="card">
        <div class="card-header">Edit user</div>
        <div class="card-body card-block">
            <form action="{{route('users.update',$user->id)}}" method="post" class="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="tel" id="phone" name="phone" value="{{$user->phone}}" placeholder="Phone" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-asterisk"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-asterisk"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password confirm" class="form-control">
                    </div>
                </div>
                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Edit user</button>
                </div>
            </form>
        </div>
    </div>

    <a href="{{route('users.index')}}">Go back</a>

@endsection
