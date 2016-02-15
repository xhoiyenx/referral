@extends('layout.master')
@section('content')

<div class="container-default">
	{{ form()->model( $data->toArray(), ['route' => 'client.account', 'class' => 'form-horizontal'] ) }}
	<div class="page-action with-tab">
	  <div class="action-button">
	    <button type="submit" class="btn btn-primary">SAVE</button>
	  </div>
	</div>

	@include('layout.notices')

	<h3>Account Information</h3>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Full Name:</label>
    <div class="col-sm-9">
      {{ form()->text('fullname', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Email address:</label>
    <div class="col-sm-9">
      {{ form()->text('usermail', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      <span class="help-block">Please directly contact us to change your fullname or email address</span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Old Password:</label>
    <div class="col-sm-9">
      {{ form()->password('old_password', ['class' => 'form-control']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">New Password:</label>
    <div class="col-sm-9">
      {{ form()->password('new_password', ['class' => 'form-control']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">New Password Confirmation:</label>
    <div class="col-sm-9">
      {{ form()->password('new_password_confirmation', ['class' => 'form-control']) }}
      <span class="help-block">Leave blank if you don't want to change your password.</span>
    </div>
  </div>

  <h3>Personal Information</h3>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Mobile:</label>
    <div class="col-sm-9">
      {{ form()->text('mobile', null, ['class' => 'form-control numeric']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Address:</label>
    <div class="col-sm-9">
      {{ form()->textarea('address', null, ['class' => 'form-control', 'rows' => '4']) }}
    </div>
  </div>  

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Post Code:</label>
    <div class="col-sm-9">
      {{ form()->text('zipcode', null, ['class' => 'form-control']) }}
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label form-label">Country:</label>
    <div class="col-sm-9">
    	{{ form()->select('country', get_countries(), null, ['class' => 'form-control']) }}
    </div>
  </div>  

	{{ form()->close() }}

</div>
@endsection