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

<h4>Personal Details</h4>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($enquiry))
            <input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Full Name"
            value="{{ $enquiry->name }}" required>
        @else
            <input type="text" class="form-control text-capitalize" id="name" name="name" placeholder="Full Name"
            value="@if(isset($client)){{ $client->name }}@else{{ old('name') }}@endif" required>
        @endif
    </div>

   

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="email">Email</label>
        @if(isset($enquiry))
            <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com"
            value="{{ $enquiry->email }}">
        @else
            <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com"
            value="@if(isset($client)){{ $client->email }}@else{{ old('email') }}@endif">
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">Contact Number</label>
        @if(isset($enquiry))
            <input type="tel" class="form-control" id="contact_no" name="contact_no" placeholder="+910123456789" maxlength="10" pattern="{0-9}" 
            value="{{ $enquiry->contact_no }}" required>
        @else
            <input type="tel" class="form-control" id="contact_no" name="contact_no" placeholder="+910123456789" maxlength="10" pattern="{0-9}" 
            value="@if(isset($client)){{ $client->contact_no }}@else{{ old('contact_no') }}@endif" required>
        @endif
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Subject</label>
        @if(isset($enquiry))
            <textarea class="form-control" id="subject" name="subject" placeholder="Subject"
            >{{ $enquiry->subject }}</textarea>
        @else
            <textarea class="form-control" id="subject" name="subject" placeholder="Subject"
            >@if(isset($client)){{ $client->subject }}@else{{ old('subject') }}@endif</textarea>
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="rating">Rating</label>
        <select class="form-control" id="rating" name="rating" required>
            <option value="1">&starf;</option>
            <option value="2">&starf;&starf;</option>
            <option value="3">&starf;&starf;&starf;</option>
            <option value="4">&starf;&starf;&starf;&starf;</option>
            <option value="5">&starf;&starf;&starf;&starf;&starf;</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group form-check ml-3">
        @if(isset($enquiry))
            <input type='checkbox' class="form-check-input" name='is_active' checked disabled />
        @else
            @if(isset($client))
                <input type='checkbox' class="form-check-input" name='is_active' @if(isset($client->is_active))@if($client->is_active)checked @else @endif @endif />
            @else
                <input type='checkbox' class="form-check-input" name='is_active' checked />
            @endif
        @endif
        <label class="form-check-label" for="is_active">Is Active?</label>
    </div>
</div>
<br><br>

<h4>Booking Details</h4>
<div class="row">
	<div class="form-group col-sm-3">
	 <label class="text-capitalize" for="carpet_area">Booking Date</label>
			<input type="text" class="form-control" id="carpet_area" name="booking_date" placeholder="Booking_date"
			@if(isset($client))value="<?php $originalDate = $client->created_at;
			echo $newDate = date("d-m-Y", strtotime($originalDate));?>"@endif >
	</div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="project">Project</label>
        <select class="form-control js-example-basic-single" id="project" name="project" required>
            @if(isset($enquiry))
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" @if(isset($enquiry->project->id))@if($project->id == $enquiry->project->id) selected @endif @endif>{{ $project->name }}</option>
                @endforeach
            @else
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" @if(isset($client->project->id)) @if($project->id == $client->project->id) selected @endif @endif>{{ $project->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="configuration">Configuration</label>
        <select class="form-control js-example-basic-single" id="configuration" name="configuration" required>
            @if(isset($enquiry))
                @foreach ($configurations as $configuration)
                    <option value="{{ $configuration->id }}" @if(isset($enquiry->configuration->id))@if($configuration->id == $enquiry->configuration->id) selected @endif @endif>{{ $configuration->name }}</option>
                @endforeach
            @else
                @foreach ($configurations as $configuration)
                    <option value="{{ $configuration->id }}" @if(isset($client->configuration->id)) @if($configuration->id == $client->configuration->id) selected @endif @endif>{{ $configuration->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="carpet_area">Carpet Area (Sq. Ft.)/Super Area</label>
        <input type="number" step="0.01" class="form-control" id="carpet_area" name="carpet_area" placeholder="Carpet area"
        @if(isset($client))value="{{ $client->carpet_area }}"@endif >
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="booking_amount">Booking Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
        <input type="number" step="0.01" class="form-control" id="booking_amount" name="booking_amount" placeholder="Booking amount"
        @if(isset($client))value="{{ $client->booking_amount }}"@endif required>
    </div>
</div>
<div class="row">
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Unit No</label>
        <input type="number" class="form-control" id="unit_no" name="unit_no" placeholder="Unit Number"
        @if(isset($client))value="{{ $client->unit_no }}"@endif >
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Floor No</label>
        <input type="number" class="form-control" id="floor_no" name="floor_no" placeholder="Floor Number"
        @if(isset($client))value="{{ $client->floor_no }}"@endif >
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Tower No</label>
        <input type="number" class="form-control" id="tower_no" name="tower_no" placeholder="Tower Number"
        @if(isset($client))value="{{ $client->tower_no }}"@endif >
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Actual Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
        <input type="number" step="0.01" class="form-control" id="actual_amount" name="actual_amount" placeholder="Actual Amount"
        @if(isset($client))value="{{ $client->actual_amount }}"@endif required>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Agreement Value ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
        <input type="number" step="0.01" class="form-control" id="agreement_value" name="agreement_value" placeholder="Agreement value"
        @if(isset($client))value="{{ $client->agreement_value }}"@endif required>
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="agreement_value">Payment Plan </label>
        <input type="text"  class="form-control" id="payment_plan" name="payment_plan" placeholder="Payment Plan"
        @if(isset($client))value="{{ $client->payment_plan }}"@endif required>
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="payment_mode">Payment Mode</label>
        <select class="form-control js-example-basic-single" id="payment_mode" onchange="otherSelect(event)"  name="payment_mode" required>
            @foreach ($payment_modes as $payment_mode)
            <option @if(isset($client))@if($client->payment_mode->id === $payment_mode->id) selected @endif @endif
                value="{{ $payment_mode->id }}">{{ $payment_mode->name }}</option>
            @endforeach
        </select>
		<div id="otherBox" style="visibility: hidden;">
		 <input name="cheque_no" type="text" placeholder="Enter Cheque no" class="form-control" /> 
		</div>
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="attachment">Payment Proof</label>
        <input type="file" class="form-control" id="attachment" name="attachment">
    </div>
</div>

@if( auth()->user()->hasRole('Admin') == true)
<br><br>

<h4>Company Incentive Details</h4>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="brokerage_percent">Incentive (%)</label>
        <input type="number" step="0.01" class="form-control" id="brokerage_percent" name="incentive_percent"
        placeholder="Incentive percent" value="@if(isset($incentive->incentive_percentage)){{$incentive->incentive_percentage}}@endif">
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="brokerage_amount">Incentive Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
        <input type="number" step="0.01" class="form-control" id="brokerage_amount" name="incentive_amount"
        placeholder="Incentive Amount" value="@if(isset($incentive->incentive_amount)){{$incentive->incentive_amount}}@endif" >
    </div>
	
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="brokerage_remark">Remark</label>
        <input type="text" class="form-control" id="brokerage_remark" name="incentive_remark" placeholder="Remarks" value="@if(isset($incentive->remarks)){{$incentive->remarks}}@endif">
    </div>
</div>

<h4>Employee Incentive Details</h4>
<div class="row">
		<div class=" mt-3" data-x-wrapper="emp_incentive">
		@if(isset($emp_incentive))
		@foreach($emp_incentive as $inc)
			<div class="d-flex my-2" data-x-group>
					<div class="form-group col-sm-3">
							<label class="text-capitalize" for="project">Incentive For</label>
							<select class="form-control " id="project" name="user_id" >
									@foreach ($users as $user)
										<option value="{{ $user->id }}" @if($user->id == $inc->user_id) {{ 'selected'}} @endif>{{ $user->name }}</option>
									@endforeach
							   
							</select>
						</div>
						<div class="form-group col-sm-3">
					<label class="text-capitalize" for="incentive_employee_percent">Incentive (%)</label>
					<input type="number" step="0.01" class="form-control" id="incentive_employee_percent" name="incentive_employee_percent"
					placeholder="Incentive percent" value="{{$inc->incentive_percentage}}">
				</div>
				 <div class="form-group col-sm-3">
				<label class="text-capitalize" for="incentive_employee_amount">Incentive Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
				<input type="number" step="0.01" class="form-control" id="incentive_employee_amount" name="incentive_employee_amount"
				placeholder="Incentive Amount" value="{{$inc->incentive_amount}}">
				</div>

				<div class="ml-2">
					<button type="button" class="btn btn-danger remove_dup" data-remove-btn>-</button>
					<button type="button" class="btn btn-primary add_dup" data-add-btn>+</button>
				</div>
			</div>
			@endforeach
			@else
				<div class="d-flex my-2" data-x-group>
					<div class="form-group col-sm-3">
							<label class="text-capitalize" for="project">Incentive For</label>
							<select class="form-control " id="project" name="user_id" >
									@foreach ($users as $user)
										<option value="{{ $user->id }}" >{{ $user->name }}</option>
									@endforeach
							   
							</select>
						</div>
						<div class="form-group col-sm-3">
					<label class="text-capitalize" for="brokerage_percent">Incentive (%)</label>
					<input type="number" step="0.01" class="form-control" id="incentive_employee_percent" name="incentive_employee_percent"
					placeholder="Incentive percent" value="">
				</div>
				 <div class="form-group col-sm-3">
				<label class="text-capitalize" for="brokerage_amount">Incentive Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
				<input type="number" step="0.01" class="form-control" id="incentive_employee_amount" name="incentive_employee_amount"
				placeholder="Incentive Amount" value="">
				</div>

				<div class="ml-2"><br>
					<button type="button" class="btn btn-danger remove_dup" data-remove-btn>-</button>
					<button type="button" class="btn btn-primary add_dup" data-add-btn>+</button>
				</div>
			</div>
			@endif
		</div>
	
</div>
@endif

<div class="form-group">
<input type="hidden" name="lead_id" value="@if(isset($enquiry->id)){{$enquiry->id}}@endif">
    <button type="submit" class="btn btn-success">
        @if(isset($enquiry))
            Save
        @else
            @if(isset($client))
                Update
            @else
                Create
            @endif
        @endif
    </button>
    <a class="btn btn-danger ml-3" href="{{ route('clients.index') }}">Cancel</a>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="{{url('/').'/js/jquery.replicate.js'}}"></script>

<script>
		
		jQuery(function(){
  jQuery("input[name='contact_no']").on('input', function (e) {
    jQuery(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
});
function otherSelect(event) {
	
 var other = document.getElementById("otherBox");
 if ($( "#payment_mode  option:selected" ).text() == "Cheque") {
 other.style.visibility = "visible";
 }
 else {
 other.style.visibility = "hidden";
 }
 }

 
 const selector = '[data-x-wrapper]';
        let options = {
            disableNaming: '[data-disable-naming]',
            wrapper: selector,
            group: '[data-x-group]',
            addBtn: '[data-add-btn]',
            removeBtn: '[data-remove-btn]'
        };
 
        $(selector).replicate(options);

</script>