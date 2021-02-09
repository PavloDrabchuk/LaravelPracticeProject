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

    <h2>Edit currency</h2>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Edit currency</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route('currencies.update',$currency->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    {{--<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Currency code</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="code" placeholder="Currency code"
                                   class="form-control">
                            <small class="form-text text-muted">
                                Only in capital letters. For example: USD, EUR.
                            </small>
                        </div>
                    </div>--}}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="code" class=" form-control-label">Currency code</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="code" id="code" class="form-control">
                                @foreach($currencyCodes as $code)
{{--                                    <option value="{{$code}}">{{$code}}</option>--}}
                                    <option value="{{$code}}"
                                            @if ($code === $currency->code)
                                            selected
                                        @endif
                                    >{{$code}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Currency sign</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="sign" placeholder="Currency sign"
                                   value="{{$currency->sign}}"
                                   class="form-control">
                            <small class="form-text text-muted">
                                Tip:
                                <a target="_blank" href="https://justforex.com/education/currencies">World Currency Symbols</a>
                            </small>
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

    <a href="{{route('currencies.index')}}">Go back</a>
@endsection
