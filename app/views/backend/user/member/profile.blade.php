@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-title">
        Member Information
      </div>
      <div class="panel-body">

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Fullname</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ $data->fullname }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Email</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ $data->usermail }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Mobile</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ $data->mobile }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Address</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ nl2br($data->address) }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Postcode</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ $data->zipcode }}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="form-control-static f-bold text-r">Country</p>
          </div>
          <div class="col-xs-8">
            <p class="form-control-static">{{ get_country_name($data->country)->name }}</p>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-6">
    
  </div>
</div>
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

  var route         = '{{ route('admin.lead', $data->id) }}';
  var route_create  = '';
  var route_update  = '{{ route('admin.lead.update') }}';

  var settings = {
    ajax: {
      url: route,
      type: "POST"
    }
  }

  @include('layout.table_js')

  
});
</script>
@endsection