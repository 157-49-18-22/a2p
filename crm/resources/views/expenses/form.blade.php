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
        <label class="text-capitalize" for="expense_category">Expense Category</label>
		<input type="text" class="form-control text-capitalize" id="expense_category" name="expense_category" placeholder="Expenses Category"
        value="@if(isset($expense)){{ $expense->expense_category }}@else{{ '' }}@endif" required>
    
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="payment_mode">Payment Mode</label>
        <select class="form-control js-example-basic-single" id="payment_mode" name="payment_mode" onchange="otherSelect(event)" required>
            @foreach ($payment_modes as $payment_mode)
                <option value="{{ $payment_mode->id }}" @if(isset($expense)) @if($payment_mode->id == $expense->payment_mode->id) selected @endif @endif>
                    {{ $payment_mode->name }}
                </option>
            @endforeach
        </select>
		<div id="otherBox" style="visibility: hidden;">
		 <input name="cheque_no" type="text" placeholder="Enter Cheque no" class="form-control" /> 
		</div>
    </div>
	
	<!--div class="form-group col-sm-3 cheque_details" -->
       <div id="otherBox" style="visibility: hidden;">
		 <input name="cheque_no" type="text" placeholder="Enter Cheque no" class="form-control" /> 
		</div>
    <!--</div-->
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="payee">Payee</label>
        <input type="text" class="form-control text-capitalize" id="payee" name="payee" placeholder="Payee name"
        value="@if(isset($expense)){{ $expense->payee }}@else{{ old('') }}@endif" required>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="amount_paid">Amount ({{ App\Lancer\Utilities::CURRENCY_SYMBOL }})</label>
        <input type="number" step="0.01" class="form-control text-capitalize" id="amount_paid" name="amount_paid"
        value="@if(isset($expense)){{ $expense->amount_paid }}@else{{ old('amount_paid') }}@endif" required>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="date_of_payment">Date Of Payment</label>
        <input type="date" class="form-control" id="date_of_payment" name="date_of_payment"
        value="@if(isset($expense)){{ $expense->date_of_payment->format('Y-m-d') }}@else{{ date('Y-m-d') }}@endif" required readonly>
    </div>
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="remark">Bill no</label>
        <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill no"
        value="@if(isset($expense)){{ $expense->bill_no }}@else{{ old('bill_no') }}@endif" required>
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="remark">Bill Attachment</label>
        <input type="file" class="form-control" id="bill_attachment" name="bill_attachment" >
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="remark">Office Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Address"
        value="@if(isset($expense)){{ $expense->address }}@else{{ old('address') }}@endif">
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="remark">Status</label>
        <select class="form-control js-example-basic-single" id="status" name="status" @if(auth()->user()->hasRole('Admin') == false) 
			<?php echo 'readonly' ;?>
		 @endif>
		<option value="" 
		@if(!isset($expense->status)) 
					<?php echo "selected";?>
					@endif 
					>Select</option>
                <option value="Pending" @if(isset($expense) && $expense->status == 'Pending') 
					<?php echo "selected";?>
					@endif >Pending</option>
                <option value="Paid" @if(isset($expense) && $expense->status == 'Paid') 
					<?php echo "selected";?>
					@endif>Paid</option>
                <option value="Rejected" @if(isset($expense) && $expense->status == 'Rejected') 
					<?php echo "selected";?>
					@endif>Rejected</option>
	
        </select>
    </div>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success" value="@if(isset($expense)) Update @else Create @endif">
    <a class="btn btn-danger ml-3" href="{{ route('expenses.index') }}">Cancel</a>
</div>
<script>
function otherSelect(event) {
	//alert($( "#payment_mode  option:selected" ).text());
 var other = document.getElementById("otherBox");
 if ($( "#payment_mode  option:selected" ).text().trim() == "Cheque") {
 other.style.visibility = "visible";
 }
 else {
 other.style.visibility = "hidden";
 }
 }
</script>