@extends('layouts.dashboard_app')

@section('content')

    {{--<a href="{{route('users.create')}}">Create</a>

    @if($message=\Illuminate\Support\Facades\Session::get('ok'))
        <h2 style="color: #1e9e3c">{{$message}}</h2>
    @endif--}}

    {{--<table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>CRUD</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                        <a href="{{route('users.show', $user->id)}}">Read</a>
                        <a href="{{route('users.edit', $user->id)}}">Update</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <hr/>--}}
    <div class="row">
        <div class="col-md-12">

            <h3 class="title-5 m-b-35">Users</h3>

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
                    <a class="au-btn au-btn-icon au-btn--green au-btn--small" href="{{route('users.create')}}">
                        <i class="zmdi zmdi-plus"></i>Create user
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


            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($users as $user)
                        <tr class="tr-shadow">
                            <td>{{($loop->index)+1}}</td>

                            <td>{{$user->name}}</td>

                            <td>
                                <span class="block-email">{{$user->phone}}</span>
                            </td>


                            <td>
                                <div class="table-data-feature">
                                    <a class="item" data-toggle="tooltip" data-placement="top" title="Read"
                                       href="{{route('users.show', $user->id)}}">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </a>

                                    <a class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                       href="{{route('users.edit', $user->id)}}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>


                                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete"
                                        >
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

