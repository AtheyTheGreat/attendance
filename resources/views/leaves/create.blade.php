@extends('layouts.app')
@section('htmlheader_title', 'Apply for Leave')
@section('contentheader_title', 'Apply for Leave')
@include('leaves.sidebar')
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
				$action = '/leaves'.((isset($leave) && $leave['id']) ? '/'.$leave['id'] : '')
			@endphp

			<form method="POST" action="{{ url($action) }}" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="type">Type</label>
						<select id="type" name="type" class="form-control">
							<option{{ isset($leave) && $leave->type == 'Annual leave' ? ' selected' : '' }}>Annual leave</option>
							<option{{ isset($leave) && $leave->type == 'Medical leave' ? ' selected' : '' }}>Medical leave</option>
							<option{{ isset($leave) && $leave->type == 'Other' ? ' selected' : '' }}>Other</option>
						</select>
					</div>
					<div class="form-group">
						<label for="reason">Reason</label>
						<textarea class="form-control" id="reason" name="reason" placeholder="Why do you want to leave...?">{{ isset($leave) ? $leave->reason : '' }}</textarea>
					</div>
					<div class="form-group">
						<label>Starting from</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input 
								type="text" 
								name="starting" 
								class="form-control pull-right datepicker" 
								value="{{ isset($leave) ? $leave->starting : '' }}"
								data-date-format="yyyy-mm-dd"
							/>
						</div>
					</div>
					<div class="form-group">
						<label>Until</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input 
								type="text" 
								name="until" 
								class="form-control pull-right datepicker" 
								value="{{ isset($leave) ? $leave->until : '' }}" 
								data-date-format="yyyy-mm-dd"
							/>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary">Apply</button>
					<a href="{{ url('/leaves') }}" class="btn btn-default">Cancel</a>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
</div>
@endsection