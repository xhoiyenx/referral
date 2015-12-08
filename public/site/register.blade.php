@extends('layouts.master')
@section('content')
    <div class="container-fluid topBanner">
      <section class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bannerRegister">
            <h1 class="text-uppercase pull-right">Register <span class="red">Now</span></h1>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid contentSection">
      <section class="container">
      
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-2 text-center">
            @if ( isset($registration_success) )
            <h2 class="text-uppercase">Registration Success</h2>
            <p>
              Thank you for your registration on our referral program. Your account is pending activation. Please check your email for activation link. (please check your spam if you don’t receive activation email in 15 minutes).
            </p>
            <p>
              You might want to add our system email jonathan@referralsg.com to your friend contact to make sure any email from us in future will not go to spam.              
            </p>
            <p>
              If you don’t receive activation email in 1 hour, please email to jonathan@referralsg.com or call +65 6850 5001 ; ext: 888# for assistance.
            </p>
            <p>
              Thank you.
            </p>
            <p>
              <strong>ITConcept Pte Ltd</strong>
            </p>            
            @else
            <h2 class="text-uppercase">Please fill in the form below</h2>
            <div class="form-container text-left">
              {{ form()->open(['url' => 'register', 'class' => 'form-horizontal']) }}
                @if ( $errors->count() > 0 )
                <div class="errors">
                  @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                  @endforeach
                </div>
                @endif
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="" class="col-sm-4">E-mail Address <span class="pull-right">:</span></label>
                    <div class="col-sm-8">
                      {{ form()->text('usermail', null, ['class' => 'form-control']) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="" class="col-sm-4">Re-type E-mail Address <span class="pull-right">:</span></label>
                    <div class="col-sm-8">
                      {{ form()->text('usermail_confirmation', null, ['class' => 'form-control']) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="" class="col-sm-4">Password<span class="pull-right">:</span></label>
                    <div class="col-sm-8">
                      {{ form()->password('password', ['class' => 'form-control']) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="" class="col-sm-4">Confirm Password<span class="pull-right">:</span></label>
                    <div class="col-sm-8">
                      {{ form()->password('password_confirmation', ['class' => 'form-control']) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="" class="col-sm-4">Captcha <span class="pull-right">:</span></label>
                    <div class="col-sm-8">
                      <div class="captcha pull-left">
                        <a href="#" class="refresh-captcha">Refresh</a><br>
                        {{ html()->image(Captcha::img(), 'Captcha image', ['id' => 'captcha']) }}
                      </div>
                      <div class="captcha pull-left">
                        <span>Retype here :</span><br>
                        {{ form()->text('captcha', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn text-center text-uppercase">REGISTER NOW</button>
                  </div>
                </div>
              {{ form()->close() }}
            </div>
            @endif
          </div>
        </div>
      
      </section>
    </div>
@stop

@section('footer')
<script type="text/javascript">
$(document).ready(function() {
  $('.refresh-captcha').click(function(event) {
    event.preventDefault();
    $('#captcha').attr('src', '{{ Captcha::img() }}' + new Date().getTime());
  });
});
</script>
@endsection