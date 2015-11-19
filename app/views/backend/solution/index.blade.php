@extends("layout.master")
@section("content")
<div class="page-action">
  <div>
    <a href="{{ route('admin.solution.create') }}" class="btn btn-primary">ADD NEW</a>
  </div>
</div>
@include('layout.notices')
<div class="container-default">
  <table class="table data-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Company</th>
        <th>Contact Person</th>        
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
{{ html()->script('public/global/sweet-alert/sweet-alert.min.js') }}
<script type="text/javascript">
$(document).ready(function() {

  /*
  var dataTable = $('.data-table').DataTable({
    serverSide: true,
    bAutoWidth: false,
    pageLength: 15,
    dom: 'tp',
    ajax: {
      url: "/{{ app('config')->get('app.route_prefix.administrator') }}/solution",
      type: "POST"
    }
  });


  dataTableDelete( dataTable, '/manager/user', {
    warning: '{{ trans('ui.user.warning_delete') }} ',
    delete: '{{ trans('ui.delete') }} ?',
    btn_delete: '{{ trans('ui.form.yes_delete') }}',
    btn_cancel: '{{ trans('ui.form.no_cancel') }}'
  });
  */

});
</script>
@endsection