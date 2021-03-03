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

            <h3 class="title-5 m-b-35">Categories</h3>

            <div class="table-data__tool">

                <div class="table-data__tool-right">
                    <a class="au-btn au-btn-icon au-btn--green au-btn--small" href="{{route('categories.create')}}">
                        <i class="zmdi zmdi-plus"></i>Create category
                    </a>

                </div>
            </div>
            @if (count($categories) > 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name [ua]</th>
                            <th>Name [en]</th>
                            <th>Name [ru]</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{($loop->index)+1}}</td>
                                <td>{{$category->getTranslation('name', 'ua')}}</td>
                                <td>{{$category->getTranslation('name', 'en')}}</td>
                                <td>{{$category->getTranslation('name', 'ru')}}</td>

                                <td>
                                    <div class="table-data-feature">
                                        <a class="item" data-toggle="tooltip" data-placement="top" title="Read"
                                           href="{{route('categories.show', $category->id)}}">
                                            <i class="zmdi zmdi-account-box"></i>
                                        </a>

                                        <a class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                           href="{{route('categories.edit', $category->id)}}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <form action="{{route('categories.destroy', $category->id)}}" method="POST">
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
                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    There are no categories yet.
                </div>
            @endif
        </div>
    </div>

@endsection
