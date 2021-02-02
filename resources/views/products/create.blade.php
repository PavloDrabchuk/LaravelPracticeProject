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

    <h2>Create category</h2>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Create category</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [ua]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameUA" placeholder="Name [ua]"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [en]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameEN" placeholder="Name [en]"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [ru]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameRU" placeholder="Name [ru]"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Static</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">Username</p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Text Input</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control">
                            <small class="form-text text-muted">This is a help text</small>
                        </div>
                    </div>




                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Select</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="select" id="select" class="form-control">
                                @foreach($categories->all() as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                                {{--<option value="0">Please select</option>
                                <option value="1">Option #1</option>
                                <option value="2">Option #2</option>
                                <option value="3">Option #3</option>--}}
                            </select>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
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
