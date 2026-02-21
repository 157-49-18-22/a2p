@extends('adminlte::page')

@section('title', 'All Leads')

@section('content_header')
    <h1>All Leads</h1>
@stop

@section('content')
    <div class="card px-3 py-2">
        <div class="my-3">
			<a class="btn btn-success text-uppercase float-right ml-2 assigned_to"  data-toggle="modal" data-target="#assign_leads_modal" id="assign_to" >
                    <i class="fas fa-chevron-plus"></i>
                    <span class="big-btn-text">Assign Leads</span>
                </a>
			@if(auth()->user()->hasRole('Admin')|| auth()->user()->export == 1)
				<a class="btn btn-success text-uppercase float-right ml-2" data-toggle="modal" data-target="#export_leads_modal">
                    <i class="fas fa-chevron-up"></i>
                    <span class="big-btn-text">Export Leads</span>
                </a>
			@endif
			
			@can('client_create')
				<a class="btn btn-success text-uppercase float-right ml-2"  href="{{ route('enquiries.import') }}">
                    <i class="fas fa-chevron-up"></i>
                    <span class="big-btn-text">Import Leads</span>
                </a>
			@endcan
			@can('enquiry_create')
				 <a class="btn btn-success text-uppercase float-right ml-2" href="{{ route('enquiries.create') }}">
                    <i class="fas fa-plus fa-fw"></i>
                    <span class="big-btn-text">Add New Lead</span>
                </a>
            @endcan
			<a class="btn btn-success text-uppercase float-right ml-2 assigned_to"  data-toggle="modal" data-target="#advance_search_filter" id="assign_to" >
                    <i class="fas fa-chevron-plus"></i>
                    <span class="big-btn-text">Advance Search Filter</span>
                </a>
			<div class="float-right ml-2">
			<form method="post" action="{{ route('enquiries.date_range') }}">
			@csrf
			<input type="submit" class="btn btn-success text-uppercase float-right ml-2" name="Filter"  />
			<input type="text" class=" float-right" name="daterange" Placeholder="Date Range Filter" />
			</div>
			<div class="float-right ml-2"> <label>Date Range</label>
			</form>
			</div>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset($filter)){{ $filter === 'all' ? 'All' : ($filter === 'active' ? 'Active' : 'Lost') }} @endif
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('enquiries.filter', ['filter' => 'all']) }}">All</a>
                    <a class="dropdown-item" href="{{ route('enquiries.filter', ['filter' => 'active']) }}">Active</a>
                    <a class="dropdown-item" href="{{ route('enquiries.filter', ['filter' => 'lost']) }}">Lost</a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="escalation">
                <thead class="thead-dark">
                    <tr>
					@can('client_create')
                        <th class="text-uppercase" scope="col"><input type="checkbox" class="check" id="checkAll"> 
						</label></th>
						@endcan
                        <th class="text-uppercase" scope="col">#</th>
                        <th class="text-uppercase" scope="col">Name</th>
                        <th class="text-uppercase" scope="col">Contact No.</th>
                        <th class="text-uppercase" scope="col">Date</th>
                        <th class="text-uppercase" scope="col">Assigned To</th>
                        <th class="text-uppercase" scope="col">Status</th>
                        <th class="text-uppercase" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enquiries as $enquiry)
                    <tr>@can('client_create')
                        <td><input type="checkbox" class="selected_enquiries check" name="selected_enquiries[]" value="{{ $enquiry->id }}"></td>
						@endcan
                        <td>{{ $enquiry->id }}</td>
                        <td>{{ $enquiry->name }}</td>
                        <td>
                            {{ $enquiry->contact_no }}
                            <?php
                                $whatsapp_no = $enquiry->contact_no;
                                if(str_starts_with($whatsapp_no, '+')) {
                                    $whatsapp_no = substr($whatsapp_no, 1);
                                }
                            ?>
                            <a href="https://wa.me/{{ $whatsapp_no }}"
                               class="btn btn-success btn-sm mx-2 d-xs-block d-sm-block d-md-none">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="tel:{{ $enquiry->contact_no }}"
                               class="btn btn-primary btn-sm mx-2 d-xs-block d-sm-block d-md-none">
                                <i class="fas fa-phone"></i>
                            </a>
                        </td>
                        <td>{{ $enquiry->created_at->format('d-M-Y') }}</td>
                        <td>@if($enquiry->assignedTo) {{ $enquiry->assignedTo->displayName() }} @endif</td>
                        <td>
						 @if($enquiry->enquiry_status)
                            <span class="{{ App\Lancer\Utilities::getEnquiryStatusStyle($enquiry->enquiry_status->id) }}">
                               {{ $enquiry->enquiry_status->status }} 
                            </span>
							@endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                    ACTIONS
                                </a>
                                <div id="{{ $enquiry->id }}" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @can('enquiry_show')
                                    <a class="dropdown-item text-primary"
                                        href="{{ route('enquiries.show', ['id' => $enquiry->id]) }}">View</a>
                                    @endcan
                                    @can('enquiry_edit')
                                    <a class="dropdown-item text-primary"
                                        href="{{ route('enquiries.edit', ['id' => $enquiry->id]) }}">Edit</a>
                                    @endcan
                                   
                                    @if($enquiry->enquiry_status && !$enquiry->is_lost && $enquiry->enquiry_status->id < 4)
                                    <a class="dropdown-item text-success"
                                        href="{{ route('enquiries.close', ['id' => $enquiry->id]) }}">Close Deal</a>
                                    
                                    @endcan
                                    @can('enquiry_delete')
                                    <div class="dropdown-divider"></div>
                                    <a role="button" class="enquiry-lost-btn dropdown-item text-danger" style="">
                                        Mark As Lost
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    <input type="hidden" id="deleteUrl{{ $enquiry->id }}" value="{{ route('enquiries.destroy', ['id' => $enquiry->id]) }}">
                    @endforeach
                    {{-- Required for mark delete action --}}
                    <input type="hidden" id="deletedBtnText" value="Yes, mark it!">
                    <input type="hidden" id="deletedTitle" value="Marked as lost!">
                    <input type="hidden" id="deletedMsg" value="The selected enquiry has been successfully marked as lost.">

                </tbody>
            </table>
            @if (count($enquiries) < 1)
                <div class="px-4 py-5 mx-auto text-secondary">
                    No results found!
                </div>
            @endif
        </div>
		<div class="modal fade" id="assign_leads_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Leads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form method="post" action="{{ Url('/').'/enquiries' }}">
	  @csrf
      <div class="modal-body">
	 
	   @if(auth()->user()->hasRole('Admin'))
        <div class="form-group col-sm-12">
            <label class="text-capitalize" for="assigned_to">Assign To</label>
            <select class="form-control js-example-basic-single" id="assigned_to" name="assigned_to" >
				<option value="" >Select</option>
			
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" >{{ $user->name }} </option>
                @endforeach
				
            </select>
        </div>
		<input type="hidden" class="selected_leads" name="selected_leads" value="">
  
    @endif
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Assign">
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="export_leads_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Leads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form method="get" action="{{ Url('/').'/enquiries/export' }}">
	  @csrf
      <div class="modal-body">
	 
        <div class="form-group col-sm-12">
            <label class="text-capitalize" for="assigned_to">Select Export Format</label><br>
            <input type="submit" class="btn btn-success" name="file_type" value="CSV">
			<input type="submit" class="btn btn-success" name="file_type" value="Excel">
			<input type="submit" class="btn btn-success" name="file_type" value="Pdf">
        </div>
  
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="advance_search_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advance Search Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form method="post" action="{{ route('enquiries.advance_search') }}">
	  @csrf
      <div class="modal-body">
        <div class="form-group row">
		 <div class="form-group col-sm-4">
        <label class="text-capitalize" for="name">Name</label>
        <input type="text" class="form-control text-capitalize" id="name" name="advance[name]" placeholder="Full Name" value="">
    </div>
	
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="advance[email]" placeholder="user@example.com"
        value="">
    </div>
    <div class="form-group col-sm-4">
        <label class="text-capitalize" for="contact_no">Contact Number</label>
        <input type="tel" class="form-control" id="contact_no" name="advance[contact_no]" placeholder="+910123456789"
        value="">
    </div>
	 <div class="form-group col-sm-4">
        <label class="text-capitalize" for="configuration">Configuration</label>
        <select class="form-control js-example-basic-single" id="configuration" name="advance[configuration]" >
		<option value="" >Select</option>
            @foreach ($configurations as $configuration)
                <option value="{{ $configuration->id }}" >{{ $configuration->name }}</option>
            @endforeach
        </select>
    </div>
	 <div class="form-group col-sm-4">
            <label class="text-capitalize" for="assigned_to">Assign To</label>
            <select class="form-control js-example-basic-single" id="assigned_to" name="advance[assigned_to]" >
				<option value="" >Select</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" >{{ $user->name }} </option>
                @endforeach
				
            </select>
        </div>
		<div class="form-group col-sm-4">
        <label class="text-capitalize" for="project">Project</label>
        <select class="form-control js-example-basic-single" id="project" name="advance[project]" >
		<option value="" >Select</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" >{{ $project->name }}</option>
            @endforeach
	
        </select>
    </div>
   
    
	</div>
		
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Search">
      </div>
	  </form>
    </div>
  </div>
</div>
        {{-- Pagination links --}}
        <div class="mt-4">
            {{ $enquiries->links() }}
        </div>

    </div>
@stop
<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

@section('js')

    <script src="{{ asset('js/table_utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/enquiry_lost.js') }}"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
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
		
		 var data = [];
		 $('#assign_to').click(function(event) {  
		 			

			$('.selected_enquiries:checked').each(function() {
				data.push(this.value);
				   //data[] = this.value; 
			});
			$('.selected_leads').val(data);
         });
		 
    $('#export').click(requestContent);
		function requestContent(){
			var xhr;
			$.ajax({
				url: 'https://famepixel.com/projects/a2prealtech/public/enquiries/export'
				, method: 'post'
				, xhr: function(){
					xhr = jQuery.ajaxSettings.xhr.apply(this, arguments);
					return xhr;
				}
				, xhrFields: {
					responseType: 'blob'
				},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

			}).then(function(){
				var blobUrl = URL.createObjectURL(xhr.response);
				var a = document.createElement('a');
				$(a).attr({
					href: blobUrl
					, download: 'download-demo.html'
				}).text('Click here to download.');

				document.body.appendChild(a);
				a.click();
			});
		}
	});
	$('#assign_to').hide();
		$('.selected_enquiries').click(function(event) {  
			$('#assign_to').show();
         });
	jQuery("#checkAll").click(function () {
		$('#assign_to').show();
    jQuery(".check").prop('checked', jQuery(this).prop('checked'));
});
</script>


@stop
