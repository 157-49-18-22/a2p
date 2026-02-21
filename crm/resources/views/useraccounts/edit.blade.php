@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <div class="row"><div class="col-sm-10"><h1>Edit User</h1></div>
	@can('user_create')
        <div class="col-sm-2">
            <a class="btn btn-success text-right ml-2 assigned_to"  data-toggle="modal" data-target="#advance_search_filter" id="assign_to" >
                <span class="big-btn-text">Update Password</span>
            </a>
        </div>
        @endcan
	</div>
@stop

@section('content')

    <form method="post" action="{{ route('useraccounts.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
        @include('useraccounts.form')
    </form>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/s2.js') }}"></script>
@stop
<div class="modal fade" id="advance_search_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form method="post" action="{{ route('useraccounts.update_password', ['id' => $user->id]) }}">
	  @csrf
      <div class="modal-body">
        <div class="form-group row">
		 <div class="form-group col-sm-12">
            <label class="text-capitalize" for="assigned_to">New Password</label>
             <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="">
        </div>
		<div class="form-group col-sm-12">
            <label class="text-capitalize" for="assigned_to">Confirm Password</label>
             <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password" value="">
        </div>
	 	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Update">
      </div>
	  </form>
    </div>
  </div>
</div>
</div>
