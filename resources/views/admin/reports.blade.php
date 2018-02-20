@extends('layouts.app')
@section('contentheader_title', 'Administration Dashboard')
@section('htmlheader_title', 'Administration Dashboard')
@section('sidebar_menu')
@include('admin.sidebar')
@endsection
@section('main-content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="ion ion-clock"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Leaves</span>
					<span class="info-box-number">{{ $pendingLeaves }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa ion-android-checkmark-circle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Approved Leaves</span>
					<span class="info-box-number">{{ $approvedLeaves }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<!-- fix for small devices only -->
		<div class="clearfix visible-sm-block"></div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="ion ion-close"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Declined Leaves</span>
				<span class="info-box-number">{{ $declinedLeaves }}</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Monthly Recap Report</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">
								<strong>Punctuality: January {{ date('Y') }} - December {{ date('Y') }}</strong>
							</p>
							<div class="chart">
								<canvas id="salesChart" style="height: 180px;"></canvas>
							</div>
							<!-- /.chart-responsive -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- ./box-body -->
				{{-- <div class="box-footer">
					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
								<h5 class="description-header">$35,210.43</h5>
								<span class="description-text">TOTAL REVENUE</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
								<h5 class="description-header">$10,390.90</h5>
								<span class="description-text">TOTAL COST</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
								<h5 class="description-header">$24,813.53</h5>
								<span class="description-text">TOTAL PROFIT</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 col-xs-6">
							<div class="description-block">
								<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
								<h5 class="description-header">1200</h5>
								<span class="description-text">GOAL COMPLETIONS</span>
							</div>
							<!-- /.description-block -->
						</div>
					</div>
					<!-- /.row -->
				</div> --}}
				<!-- /.box-footer -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
@endsection

@section('specific_js')
<script>
	var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
	var salesChart = new Chart(salesChartCanvas);

	var salesChartData = {
	    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
	    datasets: [{
	        label: "In time",
	        fillColor: "rgba(52,200,69,1)",
	        strokeColor: "rgba(52,200,69,1)",
	        pointColor: "rgb(52,200,69)",
	        pointStrokeColor: "rgb(52,200,69,1)",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(52,200,69,1)",
	        data: [{{ implode(', ', $inTimeFinal) }}]
	    }, {
	        label: "Late",
	        fillColor: "rgba(243,190,48,0.5)",
	        strokeColor: "rgba(243,190,48,0.5)",
	        pointColor: "rgb(243,190,48)",
	        pointStrokeColor: "rgba(243,190,48,0.5)",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(243,190,48,0.5)",
	        data: [{{ implode(', ', $lateFinal) }}]
	    }, {
	        label: "Very Late",
	        fillColor: "rgba(233,44,44,0.5)",
	        strokeColor: "rgba(233,44,44,0.5)",
	        pointColor: "rgb(233,44,44)",
	        pointStrokeColor: "rgba(233,44,44,0.5)",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(233,44,44,0.5)",
	        data: [{{ implode(', ', $veryLateFinal) }}]
	    }]
	};

	var salesChartOptions = {
	    //Boolean - If we should show the scale at all
	    showScale: true,
	    //Boolean - Whether grid lines are shown across the chart
	    scaleShowGridLines: false,
	    //String - Colour of the grid lines
	    scaleGridLineColor: "rgba(0,0,0,.05)",
	    //Number - Width of the grid lines
	    scaleGridLineWidth: 1,
	    //Boolean - Whether to show horizontal lines (except X axis)
	    scaleShowHorizontalLines: true,
	    //Boolean - Whether to show vertical lines (except Y axis)
	    scaleShowVerticalLines: true,
	    //Boolean - Whether the line is curved between points
	    bezierCurve: true,
	    //Number - Tension of the bezier curve between points
	    bezierCurveTension: 0.3,
	    //Boolean - Whether to show a dot for each point
	    pointDot: false,
	    //Number - Radius of each point dot in pixels
	    pointDotRadius: 4,
	    //Number - Pixel width of point dot stroke
	    pointDotStrokeWidth: 1,
	    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
	    pointHitDetectionRadius: 20,
	    //Boolean - Whether to show a stroke for datasets
	    datasetStroke: true,
	    //Number - Pixel width of dataset stroke
	    datasetStrokeWidth: 2,
	    //Boolean - Whether to fill the dataset with a color
	    datasetFill: true,
	    //String - A legend template
	    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
	    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
	    maintainAspectRatio: true,
	    //Boolean - whether to make the chart responsive to window resizing
	    responsive: true
	};

	//Create the line chart
	salesChart.Line(salesChartData, salesChartOptions);
</script>
@endsection