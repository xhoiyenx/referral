@extends('layout.master')
@section('content')
<?php
$contents = [
  'tnc' => 'Terms & Conditions'
];
?>
<div class="container-default">
{{ form()->model( $data, ['route' => 'admin.configuration.save', 'class' => 'form-horizontal'] ) }}

	<div class="page-action with-tab">
	  <div class="action-button">
	    <button type="submit" class="btn btn-primary">SAVE</button>
	  </div>
	  @include('layout.settings_tab')
	</div>

	@include('layout.notices')

  <div class="panel-group" id="accordion" role="tablist">
    @foreach ( $contents as $key => $title )
    <div class="panel panel-default panel-collapse">
      <div class="panel-heading" role="tab">
        <h4 class="panel-title">
          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{ $key }}">
            {{ $title }}
          </a>
        </h4>
      </div>
      <div style="height: 0px;" id="{{ $key }}" class="panel-collapse collapse" role="tabpanel">
        <div class="panel-body">
          {{ form()->textarea('config['.$key.']', null, ['class' => 'form-control redactor', 'id' => 'desc']) }}
        </div>
      </div>
    </div>
    @endforeach
  </div>

{{ form()->close() }}
</div>
@endsection

@section("header_before_style")
{{ html()->style('public/global/redactor/redactor.css') }}
@endsection

@section('footer')
{{ html()->script('public/global/redactor/redactor.min.js') }}
{{ html()->script('public/global/redactor/plugins/fullscreen/fullscreen.js') }}
{{ html()->script('public/global/redactor/plugins/imagemanager/imagemanager.js') }}
<script type="text/javascript">
$(document).ready(function() {
  $('.redactor').redactor({
    plugins: ['fullscreen', 'imagemanager'],
    imageUpload: '/redactor/image/upload',
    minHeight: 200,
    maxHeight: 400,
  });    
});
</script>
@stop