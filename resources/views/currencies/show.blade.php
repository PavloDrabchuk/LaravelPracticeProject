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
            <h3 class="title-5 m-b-15">Currency info</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                    <tr>
                        <td>Currency code</td>
                        <td>{{$currency->code}}</td>
                    </tr>
                    <tr>
                        <td>Sign</td>
                        <td>{{$currency->sign}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br/>
    <a href="{{route('currencies.index')}}">Go back</a>
@endsection
