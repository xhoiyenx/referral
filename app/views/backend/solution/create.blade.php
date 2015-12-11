@if ( isset($data) )
{{ form()->model( $data, ['route' => ['admin.solution.update', $data->id], 'class' => 'form-ajax', 'files' => true] ) }}
@else
{{ form()->open( ['route' => 'admin.solution.create', 'class' => 'form-ajax', 'files' => true] ) }}
@endif
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $pageTitle or $controller->getPageTitle() }}</h4>
</div>
<div class="modal-body">
  @include('layout.notices')
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('name', 'Name', ['class' => 'form-label']) }} *
        {{ form()->text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('sort_order', 'Sort Order', ['class' => 'form-label']) }} *
        {{ form()->text('sort_order', null, ['class' => 'form-control', 'id' => 'sort_order']) }}
      </div>
    </div>    
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('cost', 'Price', ['class' => 'form-label']) }} *
        <div class="input-group">
          <div class="input-group-addon">S$</div>
          {{ form()->text('price', null, ['class' => 'form-control', 'id' => 'cost']) }}
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('fee', 'Referral Fee', ['class' => 'form-label']) }} *
        <div class="input-group">
          <div class="input-group-addon">S$</div>
          {{ form()->text('fee', null, ['class' => 'form-control', 'id' => 'fee']) }}
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('image', 'Featured Image', ['class' => 'form-label']) }}
        {{ form()->file('image') }}
      </div>
    </div>
    <div class="col-md-6">
    @if ( isset($data) && $data->image != '' )
      <div class="form-group">
        <img class="img-responsive img-thumbnail" src="{{ '/public/uploads/' . $data->image }}">
      </div>
      <div class="checkbox checkbox-primary">
        {{ form()->checkbox('delete_image', 1, null, ['id' => 'delete_image']) }}
        {{ form()->label('delete_image', 'Delete image', ['class' => 'form-label']) }}
      </div>
    @endif
    </div>
    <div class="col-md-12">
      <div class="form-group margin-0">
        {{ form()->label('desc', 'Description', ['class' => 'form-label']) }}
        {{ form()->textarea('description', null, ['class' => 'form-control redactor', 'id' => 'desc']) }}
      </div>
    </div>
  </div>
  
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}