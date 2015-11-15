@extends('layout.login')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="login-form">
			<form>
		    <div class="top">
		      <h1>ITConcept Pte Ltd</h1>
		      <h4>{{ $title }}</h4>
		    </div>
		    <div class="form-area">
		    	<p>
		    		Dear {{ $user->fullname }},
		    	</p>
		    	<p>
		    		Your account is activated. You can {{ link_to_route('client.login', 'login') }} and simply submit new lead to earn extra.
		    	</p>
		    	<p>
		    		Thank you.
		    	</p>
		    	<p>
		    		ITConcept Pte Ltd
		    	</p>
		    </div>
		  </form>
			</div>
		</div>
	</div>
</div>
@stop