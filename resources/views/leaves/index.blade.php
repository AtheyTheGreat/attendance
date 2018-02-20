@extends('layouts.app')
@section('htmlheader_title', 'Leaves Management')
@section('contentheader_title', 'Leaves Management')
@include('leaves.sidebar')

@section('main-content')

<div class="container spark-screen">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">My Leave Requests</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tbody><tr>
							<th>#</th>
							<th>Type</th>
							<th>Reason</th>
							<th>Starting from</th>
							<th>Until</th>
							<th>Status</th>
							<th>Manage</th>
						</tr>
						@php $i = 1 @endphp
						@forelse ($leaves as $leave)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $leave->type }}</td>
							<td>{{ substr($leave->reason, 0, 30).((strlen($leave->reason) > 30) ? '...' : '') }}</td>
							<td>{{ date('F jS, Y', strtotime($leave->starting)) }}</td>
							<td>{{ date('F jS, Y', strtotime($leave->until)) }}</td>
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
							<td>
								<div class="btn-group">
			                    	<a href="{{ url('/leaves/'.$leave->id.'/edit') }}" class="btn btn-default btn-sm">
			                    		<i class="fa fa-pencil" aria-hidden="true"></i>
			                    	</a>
			                    	<a
			                    		href="{!! route('leaves.delete', ['leave' => $leave]) !!}"
			                    		data-method="delete"
			                    		data-confirm="Are you sure?"
			                    		data-token="{{ csrf_token() }}"
			                    		class="btn btn-default btn-sm"
			                    	>
			                    		<i class="fa fa-eraser" aria-hidden="true"></i>
			                    	</a>
			                    </div>
							</td>
						</tr>
						@empty
						<tr>
							<td align="center" colspan="7">You haven't submitted any leave request yet.</td>
						</tr>
						@endforelse
					</tbody></table>

					<div style="text-align:center">
						{{ $leaves->links() }}
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

			<a href="{{ url('/leaves/create') }}" class="btn btn-success pull-right">
				Submit Leave Request
			</a>
		</div>
	</div>
</div>
@endsection