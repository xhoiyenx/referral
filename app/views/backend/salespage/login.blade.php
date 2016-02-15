@extends('layout.login')
@section('content')
<div class="login-form">
  {{ form()->open(['route' => 'sales.login']) }}
    <div class="top">
      <h1>ITCONCEPT</h1>
      <h4>{{ $title }}</h4>
    </div>
    <div class="form-area">
      @include('layout.notices')
      <div class="group">
        @if ( ! isset($is_admin) )
        {{ form()->text("username", null, ["class" => "form-control", "placeholder" => "E-Mail"]) }}
        @else
        {{ form()->text("username", null, ["class" => "form-control", "placeholder" => "Username"]) }}
        @endif
        <i class="fa fa-user"></i>
      </div>
      <div class="group">
        {{ form()->password("password", ["class" => "form-control", "placeholder" => "Password"]) }}
        <i class="fa fa-key"></i>
      </div>
      <button type="submit" class="btn btn-default btn-block">LOGIN</button>
    </div>
  {{ form()->close() }}
</div>
@stop

@section('login_footer')
<script type="text/javascript">
$(document).ready(function() {
  $('input[name=username]').focus();
});
</script>
@endsection