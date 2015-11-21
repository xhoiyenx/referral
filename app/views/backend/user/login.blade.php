@extends('layout.login')
@section('content')
<div class="login-form">
@if ( ! isset($is_admin) )
  {{ form()->open(['route' => 'client.login']) }}
@else
  {{ form()->open(['route' => 'admin.login']) }}
@endif
    <div class="top">
      <h1>ITCONCEPT</h1>
      <h4>{{ $title }}</h4>
    </div>
    <div class="form-area">
      @include('layout.notices')
      <div class="group">
        {{ form()->text("username", null, ["class" => "form-control", "placeholder" => "Username / E-Mail"]) }}
        <i class="fa fa-user"></i>
      </div>
      <div class="group">
        {{ form()->password("password", ["class" => "form-control", "placeholder" => "Password"]) }}
        <i class="fa fa-key"></i>
      </div>
      <!--
      <div class="checkbox checkbox-primary">
        {{ form()->checkbox('remember', '1', null, array('id' => 'remember')) }}
        {{ form()->label('remember', 'Remember Me') }}
      </div>
      -->
      <button type="submit" class="btn btn-default btn-block">LOGIN</button>
    </div>
  {{ form()->close() }}
  @if ( ! isset($is_admin) )
  <div class="footer-links row">
    <div class="col-xs-6"><a href="{{ route('client.registration') }}"><i class="fa fa-external-link"></i> Register Now</a></div>
    <div class="col-xs-6 text-right"><a href="{{ route('client.reminder') }}"><i class="fa fa-lock"></i> Forgot password</a></div>
  </div>
  @endif
</div>
@stop