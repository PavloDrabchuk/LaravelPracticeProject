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

    <h1>Show categories name</h1>

    <h4>Name [ua]: {{$category->getTranslation('name', 'ua')}}.</h4>
    <h4>Name [en]: {{$category->getTranslation('name', 'en')}}.</h4>
    <h4>Name [ru]: {{$category->getTranslation('name', 'ru')}}.</h4>

    <br/>
    <a href="{{route('categories.index')}}">Go back</a>
@endsection
