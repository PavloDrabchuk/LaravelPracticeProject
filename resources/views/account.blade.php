@extends('layouts.dashboard_app')

@section('content')

    @if($message=\Illuminate\Support\Facades\Session::get('ok'))

        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if($message=\Illuminate\Support\Facades\Session::get('error'))

        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Success</span>
            {{message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

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

    <h2>Name: {{ Auth::user()->name }}</h2>
    <h3>E-mail: {{ Auth::user()->email }}</h3>
    <br/>
    <a class="btn btn-primary" href="{{route('account.edit')}}" role="button">Edit account</a>

@endsection
