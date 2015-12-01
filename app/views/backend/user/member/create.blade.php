@if ( isset( $data ) )
{{ form()->model( $data->toArray(), ['route' => ['admin.member.update', $data->id], 'class' => 'form-ajax'] ) }}
@else
{{ form()->open( ['route' => 'admin.member.create', 'class' => 'form-ajax'] ) }}
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
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('fullname', 'Fullname', ['class' => 'form-label']) }}
        {{ form()->text('fullname', null, ['class' => 'form-control', 'readonly' => 'readonly']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('usermail', 'E-Mail', ['class' => 'form-label']) }}
        {{ form()->text('usermail', null, ['class' => 'form-control', 'readonly' => 'readonly']) }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('mobile', 'Mobile', ['class' => 'form-label']) }} *
        {{ form()->text('meta[mobile]', null, ['class' => 'form-control', 'readonly' => 'readonly']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('status', 'Status', ['class' => 'form-label']) }}
        {{ form()->select('status', ['Not Active', 'Active', 'Suspend'], null, ['class' => 'form-control']) }}
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('address', 'Address', ['class' => 'form-label']) }}
        {{ form()->textarea('meta[address]', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 2, 'readonly' => 'readonly']) }}
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}