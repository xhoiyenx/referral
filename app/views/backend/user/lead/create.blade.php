@extends("layout.master")
@section("content")
@if ( isset( $user ) )
{{ form()->model( $user, ['route' => ['lead.create', ['id' => $user->id]]] ) }}
@else
{{ form()->open( ['adm_route' => 'lead.create'] ) }}
@endif
<div class="page-action">
  <div>
    <button type="submit" class="btn btn-primary">SAVE</button>
    <a href="{{ route('client.lead') }}" class="btn btn-light">CANCEL</a>
  </div>
</div>
@include('layout.notices')
<div class="container-default">
  {{ form()->hidden('role_id', 3) }}
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('company', 'Company', ['class' => 'form-label']) }} *
        {{ form()->text('meta[company]', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('fullname', 'Contact Person Name', ['class' => 'form-label']) }} *
        {{ form()->text('fullname', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('designation', 'Designation', ['class' => 'form-label']) }}
        {{ form()->text('meta[designation]', null, ['class' => 'form-control', 'id' => 'designation']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('solutions', 'Solutions Interested', ['class' => 'form-label']) }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('phone', 'Phone Number', ['class' => 'form-label']) }} *
        {{ form()->text('meta[phone]', null, ['class' => 'form-control', 'id' => 'phone']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('mobile', 'Mobile Number', ['class' => 'form-label']) }} *
        {{ form()->text('meta[mobile]', null, ['class' => 'form-control', 'id' => 'mobile']) }}
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('introduce', 'How you introduce us', ['class' => 'form-label']) }}
        {{ form()->textarea('meta[introduce]', null, ['class' => 'form-control', 'id' => 'introduce', 'rows' => 3]) }}
        <p class="note">
          Explain how you introduce us. For example you tell your contact that you take product from us before, or your friend, etc.
        </p>
      </div>
    </div>
  </div>
</div>
{{ form()->close() }}
@endsection

@section("header_before_style")
@endsection

@section("header_after_style")
@endsection

@section("footer")
@endsection