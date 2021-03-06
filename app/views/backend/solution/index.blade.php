@extends("layout.master")
@section("content")
<div class="page-action">
  <div>
    <a href="#" class="btn btn-primary add-new">ADD NEW</a>
  </div>
</div>
@include('layout.notices')
<div class="container-default">
  <table class="table data-table">
    <thead>
      <tr>
        <th>Index</th>
        <th>Name</th>
        <th>Price</th>
        <th>Fee</th>        
        <th class="no-sort action">&nbsp;</th>
      </tr>
    </thead>
  </table>
</div>
@endsection

@section("header_before_style")
{{ html()->style('public/global/sweet-alert/sweet-alert.css') }}
{{ html()->style('public/global/redactor/redactor.css') }}
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
{{ html()->script('public/global/redactor/redactor.min.js') }}
{{ html()->script('public/global/redactor/plugins/fullscreen/fullscreen.js') }}
{{ html()->script('public/global/redactor/plugins/imagemanager/imagemanager.js') }}
<script type="text/javascript">
$(document).ready(function() {

  var route_create  = '{{ route('admin.solution.create') }}';
  var route_update  = '{{ route('admin.solution.update') }}';
  var route         = '{{ route('admin.solution') }}';

  var settings = {
    responsive: true,    
    ajax: {
      url: route,
      type: "POST"
    },
    aaSorting : [[0, 'asc']]
  }

  @include('layout.table_js')

  $( document ).ajaxComplete(function() {
    $('.redactor').redactor({
      plugins: ['fullscreen', 'imagemanager'],
      imageUpload: '/redactor/image/upload',
      minHeight: 200
    });    
  });

});
</script>
@endsection