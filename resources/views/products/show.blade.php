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

    <h2>Show product info</h2>

    <h4>Name [ua]: {{$product->getTranslation('name', 'ua')}}.</h4>
    <p>Name [en]: {{$product->getTranslation('name', 'en')}}.</p>
    <p>Name [ru]: {{$product->getTranslation('name', 'ru')}}.</p>
    <hr/>
    <p>Category: {{$product->category->name}}</p>
    <p>Quantity: {{$product->quantity}}</p>
    <p>Article: {{$product->article}}</p>
    <p>Color: {{$product->color->name}}</p>
    <p>Price: {{$product->price->value}}</p>

    <br/>
    <a href="{{route('products.index')}}">Go back</a>
@endsection
