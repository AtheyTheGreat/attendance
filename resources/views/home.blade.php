@extends('layouts.app')
@section('htmlheader_title', 'Dashboard')
@section('contentheader_title', 'Employee Dashboard')
@section('sidebar_menu')
	<li class="active"><a href="{{ url('home') }}"><i class='fa fa-list'></i> <span>Attendance Table</span></a></li>
	<li><a href="{{ url('leaves') }}"><i class='fa fa-plane'></i> <span>My Leave Notices</span></a></li>
	@if (Auth::user()->isAdmin())
		<li><a href="{{ url('admin') }}"><i class='fa fa-briefcase'></i> <span>Administration</span></a></li>
	@endif
@endsection

@section('main-content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="input-group date pull-left" style="width: 300px">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<form action="{{ url('/home') }}" method="GET">
							<input type="text" name="range" class="form-control daterangepickerr submit-range" placeholder="Choose a date range" value="{{ isset($range) && $range ? : '' }}" />
						</form>
					</div>
					
					@if (Auth::user()->isAdmin())
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default disabled">Export as</button>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/home'.$exportUrl) }}">CSV</a></li>
						</ul>
					</div>
					@endif
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tbody><tr>
							<th>ID</th>
							<th>Employee</th>
							<th>Date</th>
							<th>First Log</th>
							<th>Last Log</th>
							<th>Time In Office</th>
							<th>Punctuality</th>
							<th>In office</th>
						</tr>
						@forelse ($records as $date => $collection)
							<tr class="active">
								<td colspan="8">
									<strong>{{ date('F jS, Y', strtotime($date)) }}</strong>
								</td>
							</tr>
							@forelse ($collection as $record)
							<tr>
								@php
								$lastLog  = ($record->first_log == $record->last_log) ? '' : $record->last_log;

								if (date('w', strtotime($date)) < 6) {
									$lateness = (strtotime($record->first_log) > strtotime('08:00:00')) ? 'Late' : 'Excellent';
									$lateness = (strtotime($record->first_log) > strtotime('09:00:00')) ? 'Very Late' : $lateness;
								} else {
									$lateness = (strtotime($record->first_log) > strtotime('08:00:00')) ? 'Late' : 'Excellent';
									$lateness = (strtotime($record->first_log) > strtotime('09:00:00')) ? 'Very Late' : $lateness;
								}
								$class =  ($lateness == 'Excellent') ? 'success' : (($lateness == 'Late') ? 'warning' : 'danger');
								$time = $times[$record->user_id][$date];
								@endphp
								<td>{{ $record->din }}</td>
								<td>
									<a href="{{ url('/employee/'.$record->user_id.'/attendance') }}">
										{{ ucfirst($record->username) }} 
										{{ $record->lastname ? : '' }}
									</a>
								</td>
								<td>{{ $record->date }}</td>
								<td>{{ $record->first_log }}</td>
								<td>{{ $lastLog }}</td>
								<td>{{ $time }}</td>
								<td><span class="label label-{{ $class }}">{{ $lateness }}</span></td>
								<td>{{ $record->last_dn == 2 ? 'Yes' : 'No' }}</td>
							</tr>
							@empty
							<tr>
								<td align="center" colspan="7">
									No attendenace information found for this period.
								</td>
							</tr>
							@endforelse
						@empty
						<tr>
							<td align="center" colspan="7">
								No attendenace information found for this period.
							</td>
						</tr>
						@endforelse
					</tbody></table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
