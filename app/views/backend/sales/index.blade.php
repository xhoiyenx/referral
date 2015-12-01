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
    <div class="float-r">
      <input type="text" id="search" class="input-filter" value="" placeholder="Search" />
      <button type="button" id="search-button" class="btn btn-primary">Search</button>
    </div>
  </div>
  <table class="table data-table responsive">
    <thead>
      <tr>
        <th>Fullname</th>
        <th>E-Mail</th>
        <th>Mobile</th>  
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

  var route         = '{{ route('admin.sales') }}';
  var route_create  = '{{ route('admin.sales.create') }}';
  var route_update  = '{{ route('admin.sales.update') }}';
  var date_start    = '';
  var date_end      = '';

  var settings = {
    responsive: true,
    ajax: {
      url: route,
      type: "POST",
      data: function ( d ) {
      }
    }
  }

  @include('layout.table_js')

  $('#search-button').click(function(event) {
    dataTable.search( $('#search').val() ).draw();
  });

  
});
</script>
@endsection