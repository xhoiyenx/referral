<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $pageTitle or $controller->getPageTitle() }}</h4>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      @if ( $data->image != '' )
      <div class="page-image">
        <img src="{{ '/public/uploads/' . $data->image }}" class="image img-responsive">
      </div>
      @endif
      <div class="page-price clearfix">
        <div class="col-md-6">
          <strong>Price:</strong> S${{ currency_format($data->price) }}
        </div>
        <div class="col-md-6">
          <strong>Referral Fee:</strong> S${{ currency_format($data->fee) }}
        </div>
      </div>
      <div class="page-content">
        {{ $data->description }}
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>