@if ( isset( $data ) )
{{ form()->model( $data->toArray(), ['route' => ['client.lead.update', $data->id], 'class' => 'form-ajax'] ) }}
@else
{{ form()->open( ['route' => 'client.lead.create', 'class' => 'form-ajax'] ) }}
{{ form()->hidden('status', '3') }}
@endif
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $pageTitle or $controller->getPageTitle() }}</h4>
</div>
<div class="modal-body">
  @include('layout.notices')
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('company', 'Company Name', ['class' => 'form-label']) }} *
        {{ form()->text('company', null, ['class' => 'form-control']) }}
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
        {{ form()->text('designation', null, ['class' => 'form-control', 'id' => 'designation']) }}
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('solutions', 'Solutions Interested', ['class' => 'form-label']) }}
        @if ( ! empty( $solutions ) )
          @foreach ( $solutions as $id => $name )
          <div class="checkbox">
          {{ form()->checkbox('solutions[]', $id, null, ['id' => 'cb_' . $id]); }}
          {{ form()->label('cb_' . $id, $name) }}
          </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('phone', 'Contact Number', ['class' => 'form-label']) }} *
        {{ form()->text('phone', null, ['class' => 'form-control numeric', 'id' => 'phone']) }}
        <span class="help-block">Please insert only numeric data</span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('usermail', 'E-Mail', ['class' => 'form-label']) }}
        {{ form()->text('usermail', null, ['class' => 'form-control', 'id' => 'usermail']) }}
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('introduce', 'How you introduce us *', ['class' => 'form-label']) }}
        {{ form()->textarea('introduce', null, ['class' => 'form-control', 'id' => 'introduce', 'rows' => 3]) }}
        <span class="help-block">
          Explain how you introduce us. For example you tell your contact that you take product from us before, or your friend, etc.
        </span>
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <div class="row">
    <div class="col-md-6">
      @if ( ! isset( $data ) )
      <div class="checkbox text-left">
        {{ form()->checkbox('tnc', 1, null, ['id' => 'tnc']) }}
        <label for="tnc"><a href="{{ route('client.page', 'tnc') }}" target="_blank">I agree on terms & conditions</a></label>
      </div>
      @endif
    </div>
    <div class="col-md-6">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
{{ form()->close() }}