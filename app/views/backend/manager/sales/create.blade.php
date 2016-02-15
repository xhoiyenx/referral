@if ( isset($data) )
{{ form()->model( $data, ['route' => ['admin.sales.update', $data->id], 'class' => 'form-ajax'] ) }}
@else
{{ form()->open( ['route' => 'admin.sales.create', 'class' => 'form-ajax'] ) }}
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
        {{ form()->label('fullname', 'Full Name', ['class' => 'form-label']) }} *
        {{ form()->text('fullname', null, ['class' => 'form-control', 'id' => 'fullname']) }}
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('usermail', 'Email Address', ['class' => 'form-label']) }} *
        {{ form()->text('usermail', null, ['class' => 'form-control', 'id' => 'usermail']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('password', 'Password', ['class' => 'form-label']) }}
        {{ form()->password('password', ['class' => 'form-control', 'id' => 'password']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('password_confirmation', 'Password Confirmation', ['class' => 'form-label']) }}
        {{ form()->password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) }}
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('mobile', 'Mobile', ['class' => 'form-label']) }} *
        {{ form()->text('mobile', null, ['class' => 'form-control numeric', 'id' => 'mobile']) }}
        <span class="help-block">Please insert only numeric data</span>
      </div>
    </div>
  </div>
  
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}