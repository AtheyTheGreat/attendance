<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('/js/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/http-requests.js') }}"></script>
<script src="{{ asset('/js/sweetalert.js') }}"></script>
<script src="{{ asset('/js/chart.js') }}"></script>

@include('sweet::alert')

<script>
	$(function() {
		$('.datepicker').datepicker({ autoclose: true });
	    $('.daterangepickerr').daterangepicker({ autoApply: true });
	    $('[data-toggle="tooltip"]').tooltip();
	    $('[data-toggle="popover"]').popover();

	    $('.submit-range').on('apply.daterangepicker', function(ev, picker) {
			$(ev.currentTarget).closest('form').submit();
		});
	});
</script>

@yield('specific_js')