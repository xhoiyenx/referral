@extends('layout.login')
@section('content')
<div class="login-form">
  {{ form()->open(['route' => 'client.resend']) }}
    <div class="top">
      <h1>ITCONCEPT</h1>
      <h4>{{ $title }}</h4>
    </div>
    <div class="form-area">
      @include('layout.notices')
      <div class="group">
        {{ form()->text("usermail", null, ["class" => "form-control", "placeholder" => "E-Mail Address"]) }}
        <i class="fa fa-user"></i>
      </div>
      <button type="submit" class="btn btn-default btn-block">RESEND ACTIVATION EMAIL</button>
    </div>
  {{ form()->close() }}
</div>
@stop