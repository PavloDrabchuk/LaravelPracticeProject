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
            <h3 class="title-5 m-b-15">Product information</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                    <tr>
                        <td>Name [ua]</td>
                        <td>{{$product->getTranslation('name', 'ua')}}</td>
                    </tr>
                    <tr>
                        <td>Name [en]</td>
                        <td>{{$product->getTranslation('name', 'en')}}</td>
                    </tr>
                    <tr>
                        <td>Name [ru]</td>
                        <td>{{$product->getTranslation('name', 'ru')}}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{$product->category->name}}</td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{$product->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Article</td>
                        <td>{{$product->article}}</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>{{$product->color->name}}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{$product->price->value}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br/>
    <a href="{{route('products.index')}}">Go back</a>
@endsection
