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

    <h2>Edit product</h2>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Edit product</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route('products.update',$product->id)}}}}" method="post" enctype="multipart/form-data"
                      class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [ua]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nameUA" name="nameUA" placeholder="Name [ua]"
                                   value="{{$product->getTranslation('name', 'ua')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nameEN" class=" form-control-label">Name [en]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nameEN" name="nameEN" placeholder="Name [en]"
                                   value="{{$product->getTranslation('name', 'en')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nameRU" class=" form-control-label">Name [ru]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nameRU" name="nameRU" placeholder="Name [ru]"
                                   value="{{$product->getTranslation('name', 'ru')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <hr/>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="category" class=" form-control-label">Category</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if ($product->category_id === $category->id)
                                            selected
                                        @endif
                                    >{{$category->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Quantity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" min="0" id="quantity" name="quantity" placeholder="Quantity"
                                   value="{{$product->quantity}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Article</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="article" name="article" placeholder="Article"
                                   value="{{$product->article}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Color</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="color" name="color" placeholder="Color"
                                   value="{{$product->color->name}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Price</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" min="0" step="0.01" id="price" name="price" placeholder="Price"
                                   value="{{$product->prices->first()->value}}"
                                   class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Edit product
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </form>
            </div>
        </div>
    </div>

    <a href="{{route('products.index')}}">Go back</a>
@endsection
