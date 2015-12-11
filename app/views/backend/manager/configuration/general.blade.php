@extends('layout.master')
@section('content')
<div class="container-default">
{{ form()->model( $data, ['route' => 'admin.configuration.save', 'class' => 'form-horizontal'] ) }}

	<div class="page-action with-tab">
	  <div class="action-button">
	    <button type="submit" class="btn btn-primary">SAVE</button>
	  </div>
	  @include('layout.settings_tab')
	</div>

	@include('layout.notices')

	<h3>Site Information</h3>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Site Name:</label>
    <div class="col-sm-9">
      {{ form()->text('config[site_name]', null, ['class' => 'form-control']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Footer Text:</label>
    <div class="col-sm-9">
      {{ form()->text('config[footer]', null, ['class' => 'form-control']) }}
    </div>
  </div>  

{{ form()->close() }}
</div>
@endsection