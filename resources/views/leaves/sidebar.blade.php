@section('sidebar_menu')
	<li><a href="{{ url('home') }}"><i class='fa fa-list'></i> <span>Attendance Table</span></a></li>
	<li class="active"><a href="{{ url('leaves') }}"><i class='fa fa-plane'></i> <span>My Leave Notices</span></a></li>
	@if (Auth::user()->isAdmin())
		<li><a href="{{ url('admin') }}"><i class='fa fa-briefcase'></i> <span>Administration</span></a></li>
	@endif
@endsection