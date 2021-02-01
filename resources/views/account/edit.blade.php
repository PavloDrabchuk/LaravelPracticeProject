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



    <div class="card">
        <div class="card-header">Edit account</div>
        <div class="card-body card-block">
            <form action="{{route('admins.update',Auth::user()->id)}}" method="post" class="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{Auth::user()->name}}" placeholder="Name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="tel" id="email" name="email" value="{{Auth::user()->email}}" placeholder="Email" class="form-control">
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
                    <button type="submit" class="btn btn-success btn-sm">Save account</button>
                </div>
            </form>
        </div>
    </div>




@endsection
