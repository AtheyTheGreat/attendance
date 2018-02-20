@extends('layouts.app')
@section('htmlheader_title', 'Edit Profile')
@section('contentheader_title', 'Edit your profile')
@section('sidebar_menu')
	<li><a href="{{ url('home') }}"><i class='fa fa-list'></i> <span>Attendance Table</span></a></li>
	<li><a href="{{ url('leaves') }}"><i class='fa fa-plane'></i> <span>My Leave Notices</span></a></li>
	@if (Auth::user()->isAdmin())
		<li><a href="{{ url('admin') }}"><i class='fa fa-briefcase'></i> <span>Administration</span></a></li>
	@endif
@endsection
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		@if (count($errors) > 0)
	        <div class="alert alert-danger">
	            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
	            <ul>
	                @foreach ($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	            </ul>
	        </div>
	    @endif

		<!-- general form elements -->
		<div class="box box-primary">
			<!-- form start -->
			@php
				$hasS = isset($fromAdmin) ? 's' : '';
				$postUrl = (isset($fromAdmin) ? '/admin' : '').'/employee'.$hasS.'/'.(isset($fromAdmin) ? $user->id.'?redirect=admin/employees' : 'update');
			@endphp
			<form method="POST" action="{{ url($postUrl) }}" enctype="multipart/form-data" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="firstname">First name</label>
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Your first name" value="{{ $user->firstname }}" />
					</div>
					<div class="form-group">
						<label for="lastname">Last name</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Your last name" value="{{ $user->lastname }}" />
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Your email address" value="{{ $user->email }}" />
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Choose a new password" />
					</div>

					@if (Auth::user()->isAdmin())
						<div class="form-group">
							<label for="maximum_leaves">Maximum Leaves</label>
							<select name="maximum_leaves" id="maximum_leaves" class="form-control">
								@for ($i = 1; $i < 100; $i++)
									<option value="{{ $i }}" {{ $user->maximum_leaves == $i ? "selected=\"selected\""  : '' }}>{{ $i }}</option>
								@endfor

							</select>
						</div>
					@endif

					<hr>

					<div class="form-group">
						<label for="avatar">
							Profile Image 
							@if ($user->avatar)
								(<a href="{{ url('employee/clear_avatar') }}" data-method="delete" data-token="{{ csrf_token() }}">Remove Image</a>)
							@endif
						</label>
						<input type="file" class="form-control pull-right" id="avatar" name="avatar" />
					</div>
					<div class="form-group">
						<label for="department">Department</label>
						<select id="department" name="department" class="form-control">
							<option disabled{{ $user->department == '' ? ' selected' : '' }}>Pick a department</option>
							<option value="publish"{{ $user->department == 'publish' ? ' selected' : '' }}>Publish</option>
							<option value="hr"{{ $user->department == 'hr' ? ' selected' : '' }}>HR</option>
							<option value="it"{{ $user->department == 'it' ? ' selected' : '' }}>IT</option>
							<option value="accounts"{{ $user->department == 'accounts' ? ' selected' : '' }}>Accounts</option>
							<option value="construction"{{ $user->department == 'construction' ? ' selected' : '' }}>Construction</option>
							<option value="design"{{ $user->department == 'design' ? ' selected' : '' }}>Design</option>
							<option value="iqm"{{ $user->department == 'iqm' ? ' selected' : '' }}>IQM</option>
							<option value="legal"{{ $user->department == 'legal' ? ' selected' : '' }}>Legal</option>
						</select>
					</div>
					<div class="form-group">
						<label for="position">Position</label>
						<input type="text" class="form-control" id="position" name="position" placeholder="Your job position" />
					</div>
					<div class="form-group">
						<label for="birthdate">Birthdate</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input 
								type="text" 
								name="birthdate" 
								class="form-control pull-right datepicker" 
								value="{{ $user->birthdate }}" 
								data-date-format="yyyy-mm-dd"
								placeholder="When were you born?"
							/>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					{{ csrf_field() }}
					<input name="_method" type="hidden" value="PATCH">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ url('/home') }}" class="btn btn-default">Cancel</a>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
</div>
@endsection