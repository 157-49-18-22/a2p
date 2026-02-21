@if ($errors->any())
    <div class="border border-danger text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf

<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Name<span class="red">*</span></label>
        <input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Full Name"
        value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif" required>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="email">Email<span class="red">*</span></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="username@example.com"
        value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif" required>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg">
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="photo">Current Photo</label>
        @if (isset($user->photo_url))
            <img height="42" width="42" src="{{ url('/storage/galeryImages').'/'. $user->photo_url }}" alt='profile photo'
            class="inline w-9 h-9 pr-1" />
        @else
            <span class="border border-red-500">
                No photo provided.
            </span>
        @endif
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="role">Role<span class="red">*</span></label>
        <select class="form-control js-example-basic-single" id="role" name="role" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" @if(isset($user)) @if($user->roles->first()->id == $role->id) selected @endif @endif>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
	@if (!isset($user))
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="password">Password<span class="red">*</span></label>
        <input type="password" class="form-control" id="password" value="@if (isset($user->password)){{$user->password}}else{{''}}@endif" name="password"
        placeholder="Password" required>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="password_confirmation">Confirm Password<span class="red">*</span></label>
        <input type="password" class="form-control" value="@if (isset($user->password)){{$user->password}}else{{''}}@endif" id="password_confirmation" name="password_confirmation"
        placeholder="Confirm password" required>
    </div>
	@endif
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="phone">Phone<span class="red">*</span></label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone number" maxlength="10" pattern="{0-9}" 
        value="@if(isset($user)){{ $user->phone }}@else{{ '' }}@endif" required> 
    </div>
    <div class="form-group col-sm-6">
        <label class="text-capitalize" for="address">Address</label>
        <textarea name="address" class="form-control">@if(isset($user)){{ $user->address }}@else{{ '' }}@endif</textarea>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="aadhar">Aadhar</label>
        <input type="file" class="form-control" id="aadhar" name="aadhar">
    </div>
    <div class="form-group col-sm-6">
        <label class="text-capitalize" for="aadhar">Aadhar</label>
        @if (isset($user->aadhar)) 
            <img height="42" width="42" src="{{ url('/storage/galeryImages').'/'. $user->aadhar }}" alt='profile photo'
            class="inline w-9 h-9 pr-1" />
        @else
            <span class="border border-red-500">
                No photo provided.
            </span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="pancard">Pan Card</label>
        <input type="file" class="form-control" id="pancard" name="pancard">
    </div>
    <div class="form-group col-sm-6">
        <label class="text-capitalize" for="pancard">Pan Card</label>
        @if (isset($user->pancard))
            <img height="42" width="42" src="{{ url('/storage/galeryImages').'/'. $user->pancard }}" alt='profile photo'
            class="inline w-9 h-9 pr-1" />
        @else
            <span class="border border-red-500">
                No photo provided.
            </span>
        @endif
    </div>
</div>
<div class="row">
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="role">Export Leads<span class="red">*</span></label>
        <select class="form-control js-example-basic-single" id="role" name="export" required>                
                <option value="0" @if(isset($user) && $user->export == 0)
				<?php echo "selected";?> @endif> No</option>
				<option value="1" @if(isset($user) && $user->export == 1)
				<?php echo "selected";?> @endif> Yes</option>
        </select>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="role">Status<span class="red">*</span></label>
        <select class="form-control js-example-basic-single" id="role" name="status" required>                
                <option value="0" @if(isset($user) && $user->status == 0)
				<?php echo "selected";?> @endif> InActive</option>
				<option value="1" @if(isset($user) && $user->status == 1)
				<?php echo "selected";?> @endif> Active</option>
        </select>
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="phone">Location<span class="red">*</span></label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location"  
        value="@if(isset($user->location)){{ $user->location }}@else{{ '' }}@endif" required> 
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="phone">Salary<span class="red">*</span></label>
        <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter Salary of user"  
        value="@if(isset($user->salary)){{ $user->salary }}@else{{ '' }}@endif" required> 
    </div>
   
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="@if(isset($due)) Update @else Create @endif">
    <a class="btn btn-danger ml-3" href="{{ route('useraccounts.index') }}">Cancel</a>
</div>
<style>
.red{
	color:#ff0000;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
		jQuery(function(){
  jQuery("input[name='phone']").on('input', function (e) {
    jQuery(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
});
</script>