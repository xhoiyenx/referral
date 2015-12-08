@extends('layout.login')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="registration-form">
			  {{ form()->open(['route' => 'client.member.forced_profile']) }}
			    <div class="top">
			      <h1>ITConcept Pte Ltd</h1>
			      <h4>{{ $title }}</h4>
			    </div>
			    <div class="form-area">
			      @include('layout.notices')
			      <div class="row">
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Full name *']) }}
					        <span class="help-block">Must same with NRIC as this will be used for cheque payee name.</span>
					        <i class="fa fa-user"></i>					      
					      </div>
				      </div>
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('mobile', null, ['class' => 'form-control mobile', 'placeholder' => 'Mobile *']) }}
					        <span class="help-block">Please insert only numeric data</span>
					        <i class="fa fa-user"></i>
					      </div>
				      </div>
			      </div>
			      <div class="row">
			      	<div class="col-md-12">
			      		<div class="group">
			      			{{ form()->textarea('address', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Your address *']) }}
			      			<span class="help-block">Please make sure the address is filled correctly. Cheque will be mailed to this address.</span>
			      		</div>
			      	</div>
			      </div>			      
			      <div class="row">
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->text('zipcode', null, ['class' => 'form-control', 'placeholder' => 'Postal']) }}
					        <i class="fa fa-map-pin"></i>
					      </div>
				      </div>
				      <div class="col-md-6">
					      <div class="group">
					        {{ form()->select('country', get_countries(), 'SG', ['class' => 'form-control']) }}
					        <i class="fa fa-map"></i>
					      </div>
				      </div>
			      </div>			      
			      <div class="row">
				      <div class="col-md-5">
					      <div class="group" style="text-align:center">
					      	{{ html()->image(Captcha::img(), 'Captcha image', ['id' => 'captcha']) }}
					      	<a href="#" class="refresh-captcha" title="refresh"><i style="position:inherit; color:#000;" class="fa fa-refresh"></i></a>
					      </div>
				      </div>
				      <div class="col-md-7">
					      <div class="group">
					        {{ form()->text('captcha', null, ['class' => 'form-control', 'placeholder' => 'Captcha *']) }}
					        <i class="fa fa-lock"></i>
					      </div>
				      </div>
			      </div>			      
			      <button type="submit" class="btn btn-default btn-block">SAVE INFORMATION</button>
			    </div>
			  {{ form()->close() }}
			</div>
		</div>
	</div>
</div>
@stop
@section('login_footer')
<script type="text/javascript">
$(document).ready(function() {
	$('.refresh-captcha').click(function(event) {
		event.preventDefault();
		$('#captcha').attr('src', '{{ Captcha::img() }}' + new Date().getTime());
	});

	$('.mobile').keyup(function(event) {
		var text = $(this).val();
		text = text.replace(/\D/g, '');
		$(this).val(text);
	});
});
</script>
@endsection