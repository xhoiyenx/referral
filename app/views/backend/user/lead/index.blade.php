@extends("layout.master")
@section("content")
<div class="page-action">
  <div>
    <a href="#" class="btn btn-primary add-new">ADD NEW</a>
  </div>
</div>
@include('layout.notices')
<div class="container-default">
  <div class="filter clearfix">
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

  var route         = '{{ route('client.lead') }}';
  var route_create  = '{{ route('client.lead.create') }}';
  var route_update  = '{{ route('client.lead.update') }}';
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

        if ( $('#created_date').val() != '' ) {
          d.ds = $('#created_date').data('daterangepicker').startDate.format('YYYY-MM-DD');
          d.de = $('#created_date').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

      }
    }
  }
  

  @include('layout.table_js')

  $('#status').change(function(event) {
    dataTable.draw();
  });

  $('#created_date').on('apply.daterangepicker', function(event, picker) {
    dataTable.draw();
  });

  $('#search-button').click(function(event) {
    dataTable.search( $('#search').val() ).draw();
  });
  
});
</script>
@endsection