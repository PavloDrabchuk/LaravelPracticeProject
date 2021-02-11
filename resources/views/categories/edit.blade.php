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

    <h1>Edit category</h1>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Edit category</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [ua]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameUA" placeholder="Name [ua]"
                                   value="{{$category->getTranslation('name', 'ua')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [en]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameEN" placeholder="Name [en]"
                                   value="{{$category->getTranslation('name', 'en')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name [ru]</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nameRU" placeholder="Name [ru]"
                                   value="{{$category->getTranslation('name', 'ru')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Edit category
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </form>
            </div>
        </div>
    </div>

    <a href="{{route('categories.index')}}">Go back</a>
@endsection
