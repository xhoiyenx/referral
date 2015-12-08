@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">
  <div class="filter clearfix">
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-light member-status" data-status="1">Active <span class="badge">{{ $total_active }}</span></button>
      <button type="button" class="btn btn-light member-status" data-status="0">Pending <span class="badge">{{ $total_pending }}</span></button>
      <button type="button" class="btn btn-light member-status" data-status="2">Suspended <span class="badge">{{ $total_suspend }}</span></button>
      <button type="button" class="btn btn-light member-status" data-status="3">Active Without Profile <span class="badge">{{ $total_active_profile }}</span></button>
    </div>  
    <div class="float-r">
      <input type="text" id="search" class="input-filter" value="" placeholder="Search" />
      <button type="button" id="search-button" class="btn btn-primary">Search</button>
    </div>
  </div>
  <table class="table data-table">
    <thead>
      <tr>
        <th>Register Date</th>
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

@section('page-header')
<div class="right">
  <ul class="widget-inline-list clearfix">
    <li class="col-3"></li>
    <li class="col-3"></li>
    <li class="col-3"><span>{{ $total_members }}</span>Total Members</li>
    <li class="col-3 color-up"><span>{{ $total_online }}</span>Members Online</li>
  </ul>
</div>
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
      type: "POST",
      data: function ( d ) {
        d.status = $('.member-status.selected').data('status');
      }
    },
    drawCallback: function ( settings ) {
      $('.dataTables_paginate').append('<a href="#" id="DataTables_View_All" aria-controls="DataTables_Table_0" class="paginate_button">View All</a>');
      //console.log( settings );
    }
  }

  @include('layout.table_js')

  $('.member-status').click(function(event) {
    $('.member-status').removeClass('selected');
    $(this).addClass('selected');
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