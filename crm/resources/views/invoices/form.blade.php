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

<h4>Invoice Details</h4>
<div class="row">
    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Bill No/Invoice No</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="bill_no" name="bill_no" placeholder="Enter Bill No"
            value="{{ $invoice->bill_no }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="bill_no" name="bill_no" placeholder="Enter Bill No"
            value="@if(isset($invoice)){{ $invoice->bill_no }}@else{{ old('bill_no') }}@endif" required>
        @endif
    </div>
	
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Bill/Invoice Raised Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="bill_date" name="bill_date" placeholder="Enter Bill date"
            value="{{ $invoice->bill_date }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="bill_date" name="bill_date" placeholder="Enter Bill date"
            value="@if(isset($invoice)){{ $invoice->bill_date }}@else{{ date('Y/m/d') }}@endif" required>
        @endif
    </div>

	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Type of Bill</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="bill_type" name="bill_type" placeholder="Enter Bill Type"
            value="{{ $invoice->bill_type }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="bill_type" name="bill_type" placeholder="Enter Bill No"
            value="@if(isset($invoice)){{ $invoice->bill_type }}@else{{ old('bill_type') }}@endif" required>
        @endif
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="name">Customer Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="customer_name" name="customer_name" placeholder="Enter Customer Name"
            value="{{ $invoice->customer_name }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="customer_name" name="customer_name" placeholder="Enter Customer Name"
            value="@if(isset($invoice)){{ $invoice->customer_name }}@else{{ old('customer_name') }}@endif" required>
        @endif
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Company/Developer</label>
        @if(isset($invoice))
            <textarea class="form-control" id="company_developer" name="company_developer" placeholder="Enter Company/Developer"
            >{{ $invoice->company_developer }}</textarea>
        @else
            <textarea class="form-control" id="subject" name="company_developer" placeholder="Enter Company/Developer"
            >@if(isset($invoice)){{ $invoice->subject }}@else{{ old('company_developer') }}@endif</textarea>
        @endif
    </div>
   
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Address of Company</label>
        @if(isset($invoice))
            <textarea class="form-control" id="company_address" name="company_address" placeholder="Enter Company Address"
            >{{ $invoice->company_address }}</textarea>
        @else
            <textarea class="form-control" id="subject" name="company_address" placeholder="Enter Company Address"
            >@if(isset($invoice)){{ $invoice->company_address }}@else{{ old('company_address') }}@endif</textarea>
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">Property Amount</label>
        @if(isset($invoice))
            <input type="number" class="form-control" id="property_amount" name="property_amount" placeholder="Enter Amount of Property"  pattern="{0-9}" 
            value="{{ $invoice->property_amount }}" required>
        @else
            <input type="tel" class="form-control" id="property_amount" name="property_amount" placeholder="Enter Amount of Property" pattern="{0-9}" 
            value="@if(isset($invoice)){{ $invoice->property_amount }}@else{{ old('property_amount') }}@endif" required>
        @endif
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">GST</label>
        @if(isset($invoice))
            <input type="number" class="form-control" id="gst" name="gst" placeholder="Enter Amount of GST"  pattern="{0-9}" 
            value="{{ $invoice->gst }}" required>
        @else
            <input type="tel" class="form-control" id="gst" name="gst" placeholder="Enter Amount of GST" pattern="{0-9}" 
            value="@if(isset($invoice)){{ $invoice->gst }}@else{{ old('gst') }}@endif" required>
        @endif
    </div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="contact_no">Total Amount Raised to Developer</label>
        @if(isset($invoice))
            <input type="number" class="form-control" id="amount_for_developer" name="amount_for_developer" placeholder="Enter Amount Raised to Developer"  pattern="{0-9}" 
            value="{{ $invoice->amount_for_developer }}" required>
        @else
            <input type="number" class="form-control" id="amount_for_developer" name="amount_for_developer" placeholder="Enter Amount Raised to Developer" pattern="{0-9}" 
            value="@if(isset($invoice)){{ $invoice->amount_for_developer }}@else{{ old('amount_for_developer') }}@endif" required>
        @endif
    </div>
	<div class="form-group col-sm-3">
		<label class="text-capitalize" for="name">GST status</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="gst_status" name="gst_status" placeholder="Enter GST Status"
            value="{{ $invoice->gst_status }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="gst_status" name="gst_status" placeholder="Enter GST Status"
            value="@if(isset($invoice)){{ $invoice->gst_status }}@else{{ old('gst_status') }}@endif" required>
        @endif
	</div>
	<div class="form-group col-sm-3">
		<label class="text-capitalize" for="name">Bill status</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="bill_status" name="bill_status" placeholder="Enter Bill Status"
            value="{{ $invoice->bill_status }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="bill_status" name="bill_status" placeholder="Enter Bill Status"
            value="@if(isset($invoice)){{ $invoice->bill_status }}@else{{ old('bill_status') }}@endif" required>
        @endif
	</div>
	<div class="form-group col-sm-3">
		<label class="text-capitalize" for="name">TDS Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="tds" name="tds" placeholder="Enter TDS amount"
            value="{{ $invoice->tds }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="tds" name="tds" placeholder="Enter TDS Amount"
            value="@if(isset($invoice)){{ $invoice->tds }}@else{{ old('tds') }}@endif" required>
        @endif
	</div>
	<div class="form-group col-sm-3">
		<label class="text-capitalize" for="name">Amount after TDS</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="amount_after_tds" name="amount_after_tds" placeholder="Property Amount after TDS "
            value="{{ $invoice->amount_after_tds	 }}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="amount_after_tds" name="amount_after_tds" placeholder="Property Amount after TDS"
            value="@if(isset($invoice)){{ $invoice->amount_after_tds }}@else{{ old('amount_after_tds') }}@endif" required>
        @endif
	</div>
	
	<div class="form-group col-sm-3">
		<label class="text-capitalize" for="name">After customer Pass on</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="after_customer_passon" name="after_customer_passon" placeholder="Property Amount After customer Pass on"
            value="{{ $invoice->after_customer_passon}}" required>
        @else
            <input type="text" class="form-control text-capitalize"  id="after_customer_passon" name="after_customer_passon" placeholder="Property Amount After customer Pass on"
            value="@if(isset($invoice)){{ $invoice->after_customer_passon }}@else{{ old('after_customer_passon') }}@endif" required>
        @endif
	</div>
	<div class="form-group col-sm-3">
        <label class="text-capitalize" for="subject">Remarks(if any)</label>
        @if(isset($invoice))
            <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter Remraks"
            >{{ $invoice->remarks }}</textarea>
        @else
            <textarea class="form-control" id="subject" name="remarks" placeholder="Enter Remarks"
            >@if(isset($invoice)){{ $invoice->remarks }}@else{{ old('remarks') }}@endif</textarea> 
        @endif
    </div>
</div>
<h4>Commission Details</h4>
<h6>Commission 1</h6>
<hr/>
<div class="row">
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_name" name="commission_1_name" placeholder="Enter Name"
            value="{{ $invoice->commission_1_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_name" name="commission_1_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_1_name }}@else{{ old('commission_1_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_amount" name="commission_1_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_1_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_amount" name="commission_1_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_1_amount }}@else{{ old('commission_1_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_tds" name="commission_1_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_1_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_tds" name="commission_1_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_1_tds }}@else{{ old('commission_1_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_company_amount" name="commission_1_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_1_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_company_amount" name="commission_1_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_1_company_amount }}@else{{ old('commission_1_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_cheque_no" name="commission_1_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_1_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_cheque_no" name="commission_1_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_1_cheque_no }}@else{{ old('commission_1_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_1_date" name="commission_1_date" placeholder="Enter Date"
            value="{{ $invoice->commission_1_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_1_date" name="commission_1_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_1_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<h6>Commission 2</h6>
<hr/>
<div class="row">

    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_name" name="commission_2_name" placeholder="Enter Name"
            value="{{ $invoice->commission_2_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_name" name="commission_2_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_2_name }}@else{{ old('commission_2_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_amount" name="commission_2_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_2_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_amount" name="commission_2_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_2_amount }}@else{{ old('commission_2_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_tds" name="commission_2_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_2_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_tds" name="commission_2_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_2_tds }}@else{{ old('commission_2_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_company_amount" name="commission_2_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_2_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_company_amount" name="commission_2_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_2_company_amount }}@else{{ old('commission_2_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_cheque_no" name="commission_2_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_2_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_cheque_no" name="commission_2_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_2_cheque_no }}@else{{ old('commission_2_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_2_date" name="commission_2_date" placeholder="Enter Date"
            value="{{ $invoice->commission_2_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_2_date" name="commission_2_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_2_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<h6>Commission 3</h6>
<hr/>
<div class="row">



    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_name" name="commission_3_name" placeholder="Enter Name"
            value="{{ $invoice->commission_3_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_name" name="commission_3_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_3_name }}@else{{ old('commission_3_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_amount" name="commission_3_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_3_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_amount" name="commission_3_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_3_amount }}@else{{ old('commission_3_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_tds" name="commission_3_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_3_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_tds" name="commission_3_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_3_tds }}@else{{ old('commission_3_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_company_amount" name="commission_3_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_3_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_company_amount" name="commission_3_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_3_company_amount }}@else{{ old('commission_3_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_cheque_no" name="commission_3_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_3_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_cheque_no" name="commission_3_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_3_cheque_no }}@else{{ old('commission_3_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_3_date" name="commission_3_date" placeholder="Enter Date"
            value="{{ $invoice->commission_3_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_3_date" name="commission_3_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_3_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<h6>Commission 4</h6>
<hr/>
<div class="row">
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_name" name="commission_4_name" placeholder="Enter Name"
            value="{{ $invoice->commission_4_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_name" name="commission_4_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_4_name }}@else{{ old('commission_4_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_amount" name="commission_4_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_4_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_amount" name="commission_4_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_4_amount }}@else{{ old('commission_4_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_tds" name="commission_4_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_4_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_tds" name="commission_4_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_4_tds }}@else{{ old('commission_4_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_company_amount" name="commission_4_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_4_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_company_amount" name="commission_4_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_4_company_amount }}@else{{ old('commission_4_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_cheque_no" name="commission_4_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_4_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_cheque_no" name="commission_4_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_4_cheque_no }}@else{{ old('commission_4_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_4_date" name="commission_4_date" placeholder="Enter Date"
            value="{{ $invoice->commission_4_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_4_date" name="commission_4_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_4_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<h6>Commission 5</h6>
<hr/>
<div class="row">
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_name" name="commission_5_name" placeholder="Enter Name"
            value="{{ $invoice->commission_5_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_name" name="commission_5_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_5_name }}@else{{ old('commission_5_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_amount" name="commission_5_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_5_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_amount" name="commission_5_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_5_amount }}@else{{ old('commission_5_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_tds" name="commission_5_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_5_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_tds" name="commission_5_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_5_tds }}@else{{ old('commission_5_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_company_amount" name="commission_5_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_5_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_company_amount" name="commission_5_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_5_company_amount }}@else{{ old('commission_5_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_cheque_no" name="commission_5_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_5_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_cheque_no" name="commission_5_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_5_cheque_no }}@else{{ old('commission_5_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_5_date" name="commission_5_date" placeholder="Enter Date"
            value="{{ $invoice->commission_5_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_5_date" name="commission_5_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_5_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<h6>Commission 6</h6>
<hr/>
<div class="row">
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_name" name="commission_6_name" placeholder="Enter Name"
            value="{{ $invoice->commission_6_name }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_name" name="commission_6_name" placeholder="Enter Name"
            value="@if(isset($invoice)){{ $invoice->commission_6_name }}@else{{ old('commission_6_name') }}@endif" >
        @endif
    </div>
	
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_amount" name="commission_6_amount" placeholder="Enter Amount"
            value="{{ $invoice->commission_6_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_amount" name="commission_6_amount" placeholder="Enter Amount"
            value="@if(isset($invoice)){{ $invoice->commission_6_amount }}@else{{ old('commission_6_amount') }}@endif" >
        @endif
    </div>

	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">TDS Deducted by Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_tds" name="commission_6_tds" placeholder="Enter TDS Deducted by company"
            value="{{ $invoice->commission_6_tds }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_tds" name="commission_6_tds" placeholder="Enter TDS Deducted by company"
            value="@if(isset($invoice)){{ $invoice->commission_6_tds }}@else{{ old('commission_6_tds') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Amount Paid Company</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_company_amount" name="commission_6_company_amount" placeholder="Enter Amount Paid to company"
            value="{{ $invoice->commission_6_company_amount }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_company_amount" name="commission_6_company_amount" placeholder="Enter Amount Paid to company"
            value="@if(isset($invoice)){{ $invoice->commission_6_company_amount }}@else{{ old('commission_6_company_amount') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Cheque no</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_cheque_no" name="commission_6_cheque_no" placeholder="Enter Cheque No"
            value="{{ $invoice->commission_6_cheque_no }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_cheque_no" name="commission_6_cheque_no" placeholder="Enter Cheque No"
            value="@if(isset($invoice)){{ $invoice->commission_6_cheque_no }}@else{{ old('commission_6_cheque_no') }}@endif" >
        @endif
    </div>
	<div class="form-group col-sm-4">
        <label class="text-capitalize" for="subject">Date</label>
        @if(isset($invoice))
            <input type="text" class="form-control text-capitalize" id="commission_6_date" name="commission_6_date" placeholder="Enter Date"
            value="{{ $invoice->commission_6_date }}" >
        @else
            <input type="text" class="form-control text-capitalize"  id="commission_6_date" name="commission_6_date" placeholder="Enter Date"
            value="@if(isset($invoice)){{ $invoice->commission_6_date }}@else{{ date('d/M/Y') }}@endif" >
        @endif
    </div>  
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        @if(isset($invoice))
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
$(document).ready(function(){
  $("#property_amount").keyup(function(){
    var gst = $(this).val() * 0.18;
    var tds = $(this).val() * 0.05;
	var amount_for_developer = parseFloat($(this).val()) + parseFloat(gst) ;
	var amount_after_tds = parseFloat($(this).val()) - parseFloat(tds) ;
	$('#gst').val(gst);
	$('#amount_for_developer').val(amount_for_developer);
	$('#tds').val(tds);
	$('#amount_after_tds').val(amount_after_tds);
	//$('#after_customer_passon').val(amount_after_tds);
  });
});
</script>