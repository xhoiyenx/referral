@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">
  <div class="filter clearfix">
    <div class="float-r">
      <input type="text" id="search" class="input-filter" value="" placeholder="Search" />
      <button type="button" id="search-button" class="btn btn-primary">Search</button>
    </div>
  </div>
  <table class="table data-table">
    <thead>
      <tr>
        <th>Fullname</th>
        <th>Email</th>
        <th>Total Leads</th>  
        <th>Total Referral Fee</th>
        <th>Closed Deals</th>
        <th>Last Login</th>      
        <th class="no-sort action">&nbsp;</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@section("header_before_style")
{{ html()->style('public/global/sweet-alert/sweet-alert.css') }}
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
<script type="text/javascript">
$(document).ready(function() {

  var route         = '{{ route('admin.member') }}';
  var route_create  = '';
  var route_update  = '{{ route('admin.member.update') }}';

  var settings = {
    ajax: {
      url: route,
      type: "POST"
    }
  }

  @include('layout.table_js')

  $('#search-button').click(function(event) {
    dataTable.search( $('#search').val() ).draw();
  });

  
});
</script>
@endsection