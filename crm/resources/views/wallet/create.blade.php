@extends('adminlte::page')

@section('title', 'Add Money')

@section('content_header')
    <h1>Add Money</h1>
@stop

@section('content')
    <form method="post" action="{{ route('wallet.store') }}">
        @include('wallet.form')
    </form>
@stop

@section('css')
 @stop

@section('js')
    <script src="{{ asset('js/s2.js') }}"></script>
@stop
