@extends('adminlte::page')

@section('title', 'Edit Roles')

@section('content_header')
    <h1>Edit Roles</h1>
@stop

@section('content')
   
        @if ($errors->any())
    <div class="border border-danger text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="post" action="{{ route('roles.edit', ['id' => $roles->id]) }}">  
@csrf

			<div class="row">
				<div class="form-group col-sm-8">
					<label class="text-capitalize" for="name">Name</label>
					<input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Role Name"
					value="{{$roles->name}}" required>
				</div>
				<div class="form-group col-sm-12">
					<label class="text-capitalize" for="details">Permissions</label>
					@foreach($permissions as $p)
						
							<div class="form-check" >
							  <input class="form-check-input" type="checkbox" name='permissions[]' value="{{$p->id}}" id="flexCheckDefault"  @if($p->id == $p->permission_id ) {{ 'checked'}} @endif
							 >
							  <label class="form-check-label" for="flexCheckDefault">
							 {{ $p->name }}
							  </label>
							</div>
							
					@endforeach
					
				</div>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Update">
				<a class="btn btn-danger ml-3" href="{{ route('roles.index') }}">Cancel</a>
			</div>
          
        </div>
</form>
        {{-- Pagination links --}}
       

    </div>
	
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/user_lost.js') }}"></script>
@stop
