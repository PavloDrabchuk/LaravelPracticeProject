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

    <h1>Create</h1>




        <div class="card">
            <div class="card-header">Create user</div>
            <div class="card-body card-block">
                <form action="{{route('users.store')}}" method="post" class="">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" id="name" name="name" placeholder="Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <input type="tel" id="phone" name="phone" placeholder="Phone" class="form-control">
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
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Create user</button>
                    </div>
                </form>
            </div>
        </div>


    {{--<form action="{{route('users.store')}}" method="POST">
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


    </form>--}}

    <a href="{{route('users.index')}}">Go back</a>

@endsection
