@extends('layout.master')
@section('content')
<div class="container-default">
	<div class="row">
		<!-- CLOSED LEADS CHART 
    <div class="col-md-12 col-lg-6">
      <div class="panel panel-default">
        <div class="panel-title">
          LEADS CLOSED <span class="label label-default">196</span>
          <ul class="panel-tools panel-tools-hover">
            <li><a class="icon"><i class="fa fa-refresh"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>
        <div class="panel-body">

          <ul class="widget-inline-list clearfix">
            <li class="col-3 color10"><span>28.9GB</span>Total Usage</li>
            <li class="col-3"><span>92%</span>Space Left</li>
            <li class="col-3 color7"><span>22%</span>CPU</li>
            <li class="col-3"><span>512MB</span>Total RAM</li>
          </ul>

          <div id="chart-member-leads-closed" class="flotchart-placeholder"></div>

        </div>
      </div>
    </div>

    <div class="col-md-12 col-lg-6">
      <div class="panel panel-default">
        <div class="panel-title">
          LEADS ADDED <span class="label label-default">196</span>
          <ul class="panel-tools panel-tools-hover">
            <li><a class="icon"><i class="fa fa-refresh"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>
        <div class="panel-body">

          <ul class="widget-inline-list clearfix">
            <li class="col-3 color10"><span>28.9GB</span>Total Usage</li>
            <li class="col-3"><span>92%</span>Space Left</li>
            <li class="col-3 color7"><span>22%</span>CPU</li>
            <li class="col-3"><span>512MB</span>Total RAM</li>
          </ul>

          <div id="chart-member-leads-added" class="flotchart-placeholder"></div>

        </div>
      </div>
    </div>
    -->
	</div>
</div>
@stop
@section('footer')
{{ html()->script('public/global/flot-chart/jquery.flot.min.js') }}
{{ html()->script('public/global/flot-chart/jquery.flot.time.min.js') }}
<script type="text/javascript">
$(document).ready(function() {
	/**
	 * Default Loaded Chart
	 */
	var current_time = new Date();
	console.log( current_time.getFullYear() );
	$.plot("#chart-member-leads-added", [d], {
		xaxis: {
			mode: "time",
			minTickSize: [1, "month"],
			min: (new Date(current_time.getFullYear(), 0, 1)).getTime(),
			max: current_time.getTime(),			
		}
	});
});
</script>
@stop