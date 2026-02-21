@extends('adminlte::page')

@section('title', 'All Users')

@section('content_header')
    <h1>All Roles</h1>
@stop

@section('content')
    <div class="card px-3 py-2">
        @can('user_create')
        <div class="my-3">
            <a class="btn btn-success text-uppercase float-right" href="{{ route('roles.create') }}">
                <i class="fas fa-plus fa-fw"></i>
                <span class="big-btn-text">Add New Role</span>
            </a>
        </div>
        @endcan
        <input type="text" id="searchBox" placeholder="🔍 Search the table below">
        <br>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-uppercase" scope="col">#</th>
                        <th class="text-uppercase" scope="col">Name</th>
                     
                        <th class="text-uppercase" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                       
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                    ACTIONS
                                </a>
                                <div id="" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item text-primary"
                                        href="">View</a>
                                   
                                    <a class="dropdown-item text-primary"
                                        href="{{ route('roles.edit', ['id' => $role->id]) }}">Edit</a>
                                    <div class="dropdown-divider"></div>
                                   
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    {{-- Required for mark delete action --}}
                  
                </tbody>
            </table>
            @if (count($roles) < 1)
                <div class="px-4 py-5 mx-auto text-secondary">
                    No results found!
                </div>
            @endif
        </div>

        {{-- Pagination links --}}
       

    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/user_lost.js') }}"></script>
@stop
