@extends('layouts.app')
@section('htmlheader_title', $user->username)
@section('contentheader_title', ucfirst($user->username)."'s Attendance Information")
@section('sidebar_menu')
	<li class="active">
		<a href="{{ url('home') }}">
			<i class='fa fa-list'></i> 
			<span>Attendance Information</strong></span>
		</a>
	</li>
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
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tbody>
							<tr>
								<th>#</th>
								<th>Log Time</th>
								<th>Collect Time</th>
								<th>In/Out</th>
							</tr>
							@foreach ($records as $date => $collection)
								@php $i = 1; @endphp
								<tr class="active">
									<td colspan="4">
										<strong>{{ date('F jS, Y', strtotime($date)) }}</strong>
									</td>
								</tr>

								@foreach ($collection->reverse() as $record)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ date('H:i:s', strtotime($record->created_at)) }}</td>
									<td>{{ date('H:i:s', strtotime($record->collect_time)) }}</td>
									<td>
										@php
											$io = $record->dn == 2 ? 'In' : 'Out';
											$class = ($io == 'In') ? 'success' : 'danger';
										@endphp

										<span class="label label-{{ $class }}">{{ $io }}</span>
									</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection