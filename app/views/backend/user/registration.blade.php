@extends('layout.login')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="registration-form">
			  {{ form()->open(['route' => 'client.registration']) }}
			    <div class="top">
			      <h1>ITConcept Pte Ltd</h1>
			      <h4>{{ $title }}</h4>
			    </div>
			    <div class="form-area">
			    @if ( isset( $success ) )
			    	<p>
			    		Thank you for your registration on our referral program. Your account is pending activation. Please check your email for activation link. (please check your spam don’t receive activation email in 15 minutes).
			    	</p>
			    	<p>
			    		You might want to add our system email in your friend contact to make sure any email from us will not go to spam.
			    	</p>
			    	<p>
			    		If you don’t receive activation email in 1 hour, please call +65 6850 5001 ; ext: 888 for assistance.
			    	</p>
			    	<p>
			    		Thank you.
			    	</p>
			    	<p>
			    		ITConcept Pte Ltd
			    	</p>
			    @else
			      @include('layout.notices')
			      <div class="row">
				      <div class="col-md-12">
					      <div class="group">
					        {{ form()->text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Full name * same as NRIC']) }}
					        <i class="fa fa-user"></i>
					      </div>
				      </div>
			      </div>
			      <div class="row">
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('username', null, ['class' => 'form-control', 'placeholder' => 'Username *']) }}
					        <i class="fa fa-user"></i>
					      </div>
				      </div>
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('usermail', null, ['class' => 'form-control', 'placeholder' => 'Email *']) }}
					        <i class="fa fa-envelope-o"></i>
					      </div>
				      </div>
			      </div>
			      <div class="row">
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->password('password', ['class' => 'form-control', 'placeholder' => 'Password *']) }}
					        <i class="fa fa-key"></i>
					      </div>
				      </div>
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password *']) }}
					        <i class="fa fa-key"></i>
					      </div>
				      </div>
			      </div>
			      <div class="row">
			      	<div class="col-md-12">
			      		<div class="group">
			      			{{ form()->textarea('meta[address]', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Your address']) }}
			      		</div>
			      	</div>
			      </div>
			      <div class="row">
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('meta[zipcode]', null, ['class' => 'form-control', 'placeholder' => 'Postal']) }}
					        <i class="fa fa-map-pin"></i>
					      </div>
				      </div>
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->select('meta[country]', get_countries(), 'SG', ['class' => 'form-control', 'placeholder' => 'Email']) }}
					        <i class="fa fa-map"></i>
					      </div>
				      </div>
			      </div>
			      <div class="row">
				      <div class="col-md-3">
					      <div class="group" style="text-align:center">
					      	{{ html()->image(Captcha::img(), 'Captcha image') }}
					      </div>
				      </div>
				      <div class="col-md-9">
					      <div class="group">
					        {{ form()->text('captcha', null, ['class' => 'form-control', 'placeholder' => 'Captcha *']) }}
					        <i class="fa fa-lock"></i>
					      </div>
				      </div>
			      </div>			      
			      <button type="submit" class="btn btn-default btn-block">REGISTER NOW</button>
			     @endif
			    </div>
			  {{ form()->close() }}
			</div>
		</div>
	</div>
</div>
@stop