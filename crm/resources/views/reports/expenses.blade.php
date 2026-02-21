@extends('adminlte::page')

@section('title', 'Expenses Reports')

@section('content_header')
    <h1>Expenses Reports</h1>
@stop

@section('content')
    <div class="card px-3 py-2">
        <!--<div class="my-3">
			<div class="float-right ml-2">
			<form method="post" action="{{ route('enquiries.date_range') }}">
			@csrf
			<input type="submit" class="btn btn-success text-uppercase float-right ml-2" name="Filter"  />
			<input type="text" class=" float-right" name="daterange" Placeholder="Date Range Filter" />
			</div>
			<div class="float-right ml-2"> <label>Date Range</label>
			</form>
			</div>
           
        </div>
        <br>
-->
        <div class="table-responsive">
            <table class="table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-uppercase" scope="col">#</th>
                        <th class="text-uppercase" scope="col">Payee</th>
                        <th class="text-uppercase" scope="col">Created By</th>
                        <th class="text-uppercase" scope="col">Amount</th>
                        <th class="text-uppercase" scope="col">Date of Payment </th>
                        <th class="text-uppercase" scope="col">Bill no</th>
                        <th class="text-uppercase" scope="col">Status Updated By</th>
                        <th class="text-uppercase" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				
				 $i= 0;?>
				@foreach($data as $d)
				<?php 
				 $i++;?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$d['payee']}}</td>
                        <td>{{$d['generated_by']}}</td>
                        <td>{{$d['amount']}}</td>
                        <td>{{$d['date_of_payment']}}</td>
                        <td>{{$d['bill_no']}}</td>
                        <td>@if($d['status'] == 'Paid' || $d['status'] == 'Rejected' ){{$d['cleared_by']}} @endif</td>
                        <td>{{$d['status']}}</td>
                    </tr>
                        
              @endforeach

                </tbody>
            </table>
          
        </div>

        {{-- Pagination links --}}
        <div class="mt-4">
          
        </div>

    </div>
@stop

@section('js')
    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/enquiry_lost.js') }}"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
	<script>
	
	jQuery(function($){
		$('input[name="daterange"]').daterangepicker(
		{
			locale: {
			  format: 'YYYY-MM-DD'
			},
			startDate: '2024-05-01',
			endDate: '2024-05-31'
		}
		);
		
		 
   
	});
	new DataTable('#example', {
    layout: {
        topStart: {
            buttons: [ 'csv', 'excel', 'pdf', 'print']
        }
    }
});
</script>
<style>
.dt-search{
	display:none;
}
.dt-layout-row {
    text-align: right;
}
.dt-layout-row button {
    background-color: #000;
    color: #fff;
    padding: 5px 10px;
    margin-bottom: 10px;
}
</style>


@stop
