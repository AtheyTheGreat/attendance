@extends('layouts.app')

@section('contentheader_title', 'Employee Management')
@section('htmlheader_title', 'Employee Management')

@section('sidebar_menu')
	@include('admin.sidebar')
@endsection

@section('main-content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Employee List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tbody><tr>
							<th>#</th>
							<th>Username</th>
							<th>Full name</th>
							<th>Email</th>
							<th>Department</th>
							<th>Position</th>
							<th>Birthdate</th>
							<th>Last visit</th>
							<th>Manage</th>
						</tr>
						@foreach ($users as $user)
						<tr @if ($user->locked)style="opacity:0.3"@endif >
							<td>{{ $user->id }}</td>
							<td>{{ $user->username }}</td>
							<td>
								@if ($user->firstname && $user->lastname) 
									{{ ucfirst($user->firstname) }} {{ ucfirst($user->lastname) }} 
								@endif
							</td>
							<td>{{ $user->email }}</td>
							<td>{{ ucfirst($user->department) }}</td>
							<td>{{ $user->position }}</td>
							<td>{{ $user->birthdate }}</td>
							<td>{{ date('jS F, Y', strtotime($user->last_login)) }}</td>
							<td>
								<a href="{{ url('/admin/employees/'.$user->id.'/edit') }}" class="btn btn-sm btn-default">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody></table>

					<div style="text-align:center">
						{{ $users->links() }}
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
