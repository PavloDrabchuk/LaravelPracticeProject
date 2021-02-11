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
            <h3 class="title-5 m-b-15">Category names</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                    <tr>
                        <td>Name [ua]</td>
                        <td>{{$category->getTranslation('name', 'ua')}}</td>
                    </tr>
                    <tr>
                        <td>Name [en]</td>
                        <td>{{$category->getTranslation('name', 'en')}}</td>
                    </tr>
                    <tr>
                        <td>Name [ru]</td>
                        <td>{{$category->getTranslation('name', 'ru')}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br/>
    <a href="{{route('categories.index')}}">Go back</a>
@endsection
