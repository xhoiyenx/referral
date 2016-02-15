@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">
  <div class="filter clearfix">
    <select id="member">
      <option value="">Filter by member:</option>
      @foreach($members as $member)
      <option value="{{ $member->id }}">{{ $member->fullname }} ({{ $member->usermail }})</option>
      @endforeach
    </select>

    <select id="solution">
      <option value="">Filter by solutions:</option>
      @foreach($solutions as $solution)
      <option value="{{ $solution->id }}">{{ $solution->name }}</option>
      @endforeach
    </select>    

    <select id="status">
      <option value="">Filter by status:</option>
      <option value="1">Cold Lead</option>
      <option value="2">Deal Closed</option>
      <option value="3">Hot Lead</option>
      <option value="4">Payment Received</option>
      <option value="5">Warm Lead</option>
    </select>
    <input type="text" id="created_date" class="input-filter" value="" placeholder="Created Date" />

    <div class="float-r">
      <input type="text" id="search" class="input-filter" value="" placeholder="Search" />
      <button type="button" id="search-button" class="btn btn-primary">Search</button>
    </div>
  </div>
  <table class="table data-table responsive">
    <thead>
      <tr>
        <th>Date</th>
        <th>Company</th>
        <th>Contact Person</th>  
        <th>Solutions</th> 
        <th>Referral Fee</th>
        <th>Member</th>
        <th>Sales Info</th>
        <th>Status</th>
        <th class="no-sort action">&nbsp;</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@section("header_before_style")
{{ html()->style('public/global/sweet-alert/sweet-alert.css') }}
{{ html()->style('public/global/date-range-picker/date-range-picker.css') }}
@endsection

@section("header_after_style")
@endsection

@section("footer")
<div class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
{{ html()->script('public/global/sweet-alert/sweet-alert.min.js') }}
{{ html()->script('public/global/moment/moment.min.js') }}
{{ html()->script('public/global/date-range-picker/date-range-picker.js') }}
<script type="text/javascript">
$(document).ready(function() {

  var route         = '{{ route('sales.lead') }}';
  var route_create  = '';
  var route_update  = '{{ route('admin.lead.update') }}';
  var date_start    = '';
  var date_end      = '';

  $('#created_date').daterangepicker({
    locale: {
      format: 'MM/DD/YYYY'
    }    
  });

  var settings = {
    responsive: true,
    ajax: {
      url: route,
      type: "POST",
      data: function ( d ) {

        d.status = $('#status').val();
        d.member_id = $('#member').val();
        d.solution_id = $('#solution').val();

        if ( $('#created_date').val() != '' ) {
          d.ds = $('#created_date').data('daterangepicker').startDate.format('YYYY-MM-DD');
          d.de = $('#created_date').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

      }
    },
    drawCallback: function ( settings ) {
      $('.dataTables_paginate').append('<a href="#" id="DataTables_View_All" aria-controls="DataTables_Table_0" class="paginate_button">View All</a>');
      //console.log( settings );
    }
  }
  

  @include('layout.table_js')

  $('#status').change(function(event) {
    dataTable.draw();
  });

  $('#member').change(function(event) {
    dataTable.draw();
  });

  $('#solution').change(function(event) {
    dataTable.draw();
  });

  $('#created_date').on('apply.daterangepicker', function(event, picker) {
    dataTable.draw();
  });

  $('#search-button').click(function(event) {
    dataTable.search( $('#search').val() ).draw();
  });

  $('.dataTables_wrapper').on('click', '#DataTables_View_All', function(event) {
    event.preventDefault();
    dataTable.page.len( -1 ).draw();
  });

  
});
</script>
@endsection