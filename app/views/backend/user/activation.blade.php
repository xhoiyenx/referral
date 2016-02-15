@extends('layout.login')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="login-form">
			<form>
		    <div class="top">
		      <h1>ITCONCEPT PTE LTD</h1>
		      <h4>{{ $title }}</h4>
		    </div>
		    <div class="form-area">
		    @if ( is_null( $user ) )
		    	<p>
		    		Activation key not found, please check your email. Or resend your activation mail {{ link_to_route('client.resend', 'click here') }}
		    	</p>
		    @else
		    	<p>
		    		Your account has been activated. You can {{ link_to_route('client.login', 'login') }} and simply submit new lead to start earning.
		    	</p>
		    	<p>
		    		Thank you.
		    	</p>
		    	<p>
		    		ITConcept Pte Ltd
		    	</p>
		    @endif
		    </div>
		  </form>
			</div>
		</div>
	</div>
</div>
@stop