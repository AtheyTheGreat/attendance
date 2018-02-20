@extends('layouts.app')

@section('contentheader_title', 'Leave Requests Management')
@section('htmlheader_title', 'Leave Requests Management')

@section('sidebar_menu')
	@include('admin.sidebar')
@endsection

@section('main-content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-xs-12">

			{{-- PENDING TABLE --}}
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><strong>{{ ucfirst($type) }}</strong> Leave Requests</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tbody><tr>
							<th>#</th>
							<th>Requested by</th>
							<th>Type</th>
							<th>Reason</th>
							<th>Starting from</th>
							<th>Until</th>
							<th>Status</th>
							@if ($type == 'pending')<th>Manage</th>@endif
						</tr>
						@php $i = 1 @endphp
						@foreach ($leaves as $leave)
						<tr>
							<td>{{ $i++ }}</td>
							<td>
								{{ ucfirst($leave->user->username) }} 
								@if ($leave->user->lastname) {{ ucfirst($leave->user->lastname) }} @endif
							</td>
							<td>{{ $leave->type }}</td>
							<td>
								<div id="leave-{{ $leave->id }}" class="modal fade" tabindex="-1" role="dialog">
								    <div class="modal-dialog" role="document">
								        <div class="modal-content">
								        	<div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										        	<span aria-hidden="true">&times;</span>
										        </button>
										        <h5 class="modal-title">Leave Reason</h5>
										      </div>
								            <div class="modal-body">
								                <p>{{ $leave->reason }}</p>
								            </div>
								        </div>
								    </div>
								</div>
								<span style="cursor:pointer" data-toggle="modal" data-target="#leave-{{ $leave->id }}">
									{{ substr($leave->reason, 0, 30).((strlen($leave->reason) > 30) ? '...' : '') }}
								</span>
							</td>
							<td>{{ date('F jS Y', strtotime($leave->starting)) }}</td>
							<td>{{ date('F jS Y', strtotime($leave->until)) }}</td>
							<td>
								@php
									$class = '';
									switch ($leave->status) {
										case 'approved': $class = 'success'; break;
										case 'pending': $class = 'warning'; break;
										case 'declined': $class = 'danger'; break;
									}
								@endphp
								<span class="label label-{{ $class }}">{{ ucfirst($leave->status) }}</span>
							</td>
							@if ($type == 'pending')
							<td>
								<div class="btn-group">
			                    	<a href="{{ url('/admin/leaves/'.$leave->id.'/approve') }}" class="btn btn-success btn-sm">
			                    		<i class="fa fa-check" aria-hidden="true"></i>
			                    	</a>
			                    	<a href="{{ url('/admin/leaves/'.$leave->id.'/decline') }}" class="btn btn-danger btn-sm">
			                    		<i class="fa fa-times" aria-hidden="true"></i>
			                    	</a>
			                    </div>
							</td>
							@endif
						</tr>
						@endforeach
					</tbody></table>
					
					<div style="text-align:center">
						{{ $leaves->links() }}
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
