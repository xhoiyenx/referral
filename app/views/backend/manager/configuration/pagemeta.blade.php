@extends('layout.master')
@section('content')
<?php
$contents = [
  'homepage' => 'Front Page',
  'howitworks' => 'How it works',
  'whyus' => 'Why Us',
  'register' => 'Register',
  'contact' => 'Contact'
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

				  <div class="form-group">
				    <label class="col-sm-3 control-label form-label">Title:</label>
				    <div class="col-sm-9">
				      {{ form()->text('config['. $key .'_title]', null, ['class' => 'form-control']) }}
				    </div>
				  </div>

				  <div class="form-group">
				    <label class="col-sm-3 control-label form-label">Description:</label>
				    <div class="col-sm-9">
				      {{ form()->text('config['. $key .'_description]', null, ['class' => 'form-control']) }}
				    </div>
				  </div>

				  <div class="form-group">
				    <label class="col-sm-3 control-label form-label">Keywords:</label>
				    <div class="col-sm-9">
				      {{ form()->text('config['. $key .'_keywords]', null, ['class' => 'form-control']) }}
				    </div>
				  </div>				  

        </div>
      </div>
    </div>
    @endforeach
  </div>	

{{ form()->close() }}
</div>
@endsection