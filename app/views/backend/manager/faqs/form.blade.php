@if ( isset($data) )
{{ form()->model( $data, ['route' => ['admin.faqs.update', $data->id], 'class' => 'form-ajax', 'files' => true] ) }}
@else
{{ form()->open( ['route' => 'admin.faqs.create', 'class' => 'form-ajax', 'files' => true] ) }}
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
        {{ form()->label('sort_order', 'Index', ['class' => 'form-label']) }}
        {{ form()->text('sort_order', null, ['class' => 'form-control', 'id' => 'sort_order']) }}
      </div>
    </div>  
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('title', 'Title', ['class' => 'form-label']) }} *
        {{ form()->text('title', null, ['class' => 'form-control', 'id' => 'title']) }}
      </div>
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