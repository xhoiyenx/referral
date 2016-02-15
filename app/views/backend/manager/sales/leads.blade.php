@extends("layout.master")
@section("content")
@include('layout.notices')
<h3>Leads</h3>
<div class="container-default">
  <table class="table data-table">
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

  var route         = '{{ route('admin.lead.sales', $data->id) }}';
  var route_create  = '';
  var route_update  = '{{ route('admin.lead.update') }}';

  var settings = {
    responsive: true,    
    ajax: {
      url: route,
      type: "POST"
    }
  }

  @include('layout.table_js')

  
});
</script>
@endsection