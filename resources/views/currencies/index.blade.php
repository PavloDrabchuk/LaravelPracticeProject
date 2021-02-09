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

    <div class="row">
        <div class="col-md-12">

            <h3 class="title-5 m-b-35">Currencies</h3>

            <div class="table-data__tool">
                {{--<div class="table-data__tool-left">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="js-select2" name="property">
                            <option selected="selected">All Properties</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="rs-select2--light rs-select2--sm">
                        <select class="js-select2" name="time">
                            <option selected="selected">Today</option>
                            <option value="">3 Days</option>
                            <option value="">1 Week</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <button class="au-btn-filter">
                        <i class="zmdi zmdi-filter-list"></i>filters</button>
                </div>--}}
                <div class="table-data__tool-right">
                    <a class="au-btn au-btn-icon au-btn--green au-btn--small" href="{{route('currencies.create')}}">
                        <i class="zmdi zmdi-plus"></i>Add currency
                    </a>
                    {{--<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                        <select class="js-select2" name="type">
                            <option selected="selected">Export</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>--}}
                </div>
            </div>
            @if (count($currencies) > 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Sign</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($currencies as $currency)
                            <tr class="tr-shadow">
                                <td>{{($loop->index)+1}}</td>
                                <td>{{$currency->code}}</td>
                                <td>{{$currency->sign}}</td>


                                    <td>
                                        @if($currency->code!='UAH')
                                        <div class="table-data-feature">
                                            <a class="item" data-toggle="tooltip" data-placement="top" title="Read"
                                               href="{{route('currencies.show', $currency->id)}}">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </a>

                                            <a class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                               href="{{route('currencies.edit', $currency->id)}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <form action="{{route('currencies.destroy', $currency->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="item" data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Delete"
                                                >
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>

                                        </div>
                                        @endif
                                    </td>

                            </tr>
                            <tr class="spacer"></tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    There are no products yet.
                </div>
            @endif

        </div>
    </div>

@endsection
