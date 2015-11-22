@if ( isset( $data ) )
{{ form()->model( $data->toArray(), ['route' => ['client.lead.update', $data->id], 'class' => 'form-ajax'] ) }}
@else
{{ form()->open( ['route' => 'client.lead.create', 'class' => 'form-ajax'] ) }}
{{ form()->hidden('meta[status]', '3') }}
@endif
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $pageTitle or $controller->getPageTitle() }}</h4>
</div>
<div class="modal-body">
  @include('layout.notices')
  {{ form()->hidden('role_id', 3) }}
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('company', 'Company Name', ['class' => 'form-label']) }} *
        {{ form()->text('meta[company]', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('fullname', 'Contact Person Name', ['class' => 'form-label']) }} *
        {{ form()->text('fullname', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('designation', 'Designation', ['class' => 'form-label']) }}
        {{ form()->text('meta[designation]', null, ['class' => 'form-control', 'id' => 'designation']) }}
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('solutions', 'Solutions Interested', ['class' => 'form-label']) }}
        {{ $solutions }}
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
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}