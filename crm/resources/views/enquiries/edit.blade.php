@extends('adminlte::page')

@section('title', 'Edit Lead')

@section('content_header')
    <h1>Edit Lead</h1>
@stop

@section('content')

    <form method="post" action="{{ route('enquiries.update', ['id' => $enquiry->id]) }}">
        @include('enquiries.form')
    </form>


<div class="remarks">
<h3>Remarks History</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Remark</th>
      <th scope="col">Added By</th>
      <th scope="col">Added at</th>
    </tr>
  </thead>
  <tbody>
  @if($remarks)
	  <?php $i= 1;?>
	  @foreach($remarks as $r)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$r->remarks}}</td>
      <td>{{$r->name}}</td>
      <td>{{$r->created_by}}</td>
    </tr>
	<?php $i++;?>
	@endforeach
	@else
		<tr>
	</tr>
	@endif
   </tbody>
</table>
</div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/s2.js') }}"></script>
@stop
