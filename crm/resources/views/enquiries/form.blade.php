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
        <label class="text-capitalize" for="name">Date</label>
        <input type="text" class="form-control text-capitalize" id="name" name="date" placeholder="Full Name"
        value="<?php if(isset($enquiry)){$originalDate = $enquiry->created_at;
			echo $newDate = date("d-M-Y", strtotime($originalDate));} else{echo Date('d-M-Y');}?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Name<span class="red">*</span></label>
        <input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Full Name"
        value="@if(isset($enquiry)){{ $enquiry->name }}@else{{ old('name') }}@endif" @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif required>
    </div>
   
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com"
        value="@if(isset($enquiry)){{ $enquiry->email }}@else{{ old('email') }}@endif" @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">Contact Number<span class="red">*</span></label>
        <input type="tel" class="form-control" id="contact_no" name="contact_no" placeholder="+910123456789" maxlength="10" pattern="{0-9}" 
        value="@if(isset($enquiry)){{ $enquiry->contact_no }}@else{{ old('contact_no') }}@endif" required @if(auth()->user()->hasRole('Admin') == false)
			<?php echo 'readonly' ;?>
		 @endif>
    </div> 
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">Alternate Contact Number</label>
        <input type="tel" class="form-control" id="contact_no" name="a_contact_no" placeholder="+910123456789" maxlength="10" pattern="{0-9}" 
        value="@if(isset($enquiry)){{ $enquiry->a_contact_no }}@else{{ old('a_contact_no') }}@endif"  @if(auth()->user()->hasRole('Admin') == false)
			<?php echo 'readonly' ;?>
		 @endif>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="project">Project</label>
        <select class="form-control js-example-basic-single" id="project" name="project" @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif>
		<option value="" 
		@if(!isset($enquiry->project->id)) 
					<?php echo "selected";?>
					@endif 
					>Select</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @if(isset($enquiry->project->id)) @if($project->id == $enquiry->project->id) selected @endif @endif>{{ $project->name }}</option>
            @endforeach
	
        </select>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="configuration">Configuration</label>
        <select class="form-control js-example-basic-single" onchange="otherSelect(event)" id="configuration" name="configuration" @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif >
		<option value="" 
		@if(!isset($enquiry->configuration->id)) 
					<?php echo "selected";?>
					@endif 
					>Select</option>
            @foreach ($configurations as $configuration)
                <option value="{{ $configuration->id }}" @if(isset($enquiry->configuration->id)) @if($configuration->id == $enquiry->configuration->id) selected @endif @endif>{{ $configuration->name }}</option>
            @endforeach
        </select>
		<div id="otherBox" style="visibility: hidden;">
		 <input name="other_config" type="text" class="form-control" /> 
		</div>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="budget_range">Budget Range</label>
        <input type="tel" class="form-control" id="budget_range" name="budget_range" placeholder="Enter Budget" 
        value="@if(isset($enquiry)){{ $enquiry->budget_range }}@else{{ old('budget_range') }}@endif" required @if(auth()->user()->hasRole('Admin') == false)
			<?php echo 'readonly' ;?>
		 @endif>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="enquiry_status">Status<span class="red">*</span></label>
        <select class="form-control js-example-basic-single" id="enquiry_status" name="enquiry_status" required @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif>
            @foreach ($enquiry_statuses as $status)
                <option value="{{ $status->id }}" @if(isset($enquiry)) @if($status->id == $enquiry->enquiry_status->id) selected @endif @endif>{{ $status->status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
   <div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Address</label>
        <textarea class="form-control" id="subject" name="address" placeholder="Enter Address"
         @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif>@if(isset($enquiry)){{ $enquiry->address }}@else{{ old('address') }}@endif</textarea>
    </div>

    @if(auth()->user()->hasRole('Admin'))
        <div class="form-group col-sm-3">
            <label class="text-capitalize" for="assigned_to">Assign To</label>
            <select class="form-control js-example-basic-single" id="assigned_to" name="assigned_to" >
				<option value="" @if(isset($enquiry->assignedTo) == '') 
					<?php echo "selected";?>
					@endif >Select</option>
			
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if(isset($enquiry->assignedTo) && $user->id == $enquiry->assignedTo->id) 
					<?php echo "selected";?> 
					@endif >{{ $user->name }} - {{ $user->no_of_enquiries_assigned }}</option>
                @endforeach
				
            </select>
        </div>
  
    @endif
	
	 <div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Remark</label>
        <textarea class="form-control" id="subject" name="subject" placeholder="Remark"
        >@if(isset($enquiry)){{ $enquiry->subject }}@else{{ old('subject') }}@endif</textarea>
    </div>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success" value="@if(isset($enquiry)) Update @else Create @endif">
    <a class="btn btn-danger ml-3" href="{{ Url('/').'/enquiries/index' }}">Cancel</a>
</div>
@if(auth()->user()->hasRole('Admin') == false)
	<style>
select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;

    .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }
	
}

</style>
@endif
<style>
.red{
		color:#ff0000;
	}
</style>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
		
jQuery(function(){
  jQuery("input[name='contact_no']").on('input', function (e) {
    jQuery(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
});
function otherSelect(event) {
	
 var other = document.getElementById("otherBox");
 if ($( "#configuration  option:selected" ).text() == "Other") {
 other.style.visibility = "visible";
 }
 else {
 other.style.visibility = "hidden";
 }
 }
</script>