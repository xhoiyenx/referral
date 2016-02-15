{{ form()->model( $data->toArray(), ['route' => ['admin.lead.update', $data->id], 'class' => 'form-ajax'] ) }}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $pageTitle or $controller->getPageTitle() }}</h4>
</div>
<div class="modal-body">
  @include('layout.notices')
  <!--
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('status', 'Status', ['class' => 'form-label f-bold']) }}
        {{ form()->select('status', $status, null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('sales_id', 'Sales Person', ['class' => 'form-label f-bold']) }}
        {{ form()->select('sales_id', $sales, null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
  -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('company', 'Company Name', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ $data->company }}</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('fullname', 'Contact Person Name', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ $data->fullname }}</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('designation', 'Designation', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ $data->designation }}</p>
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('solutions', 'Solutions Interested', ['class' => 'form-label f-bold']) }}
        {{ $solutions }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('phone', 'Phone Number', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ $data->phone }}</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('usermail', 'E-Mail', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ $data->usermail }}</p>
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {{ form()->label('introduce', 'How you introduce us', ['class' => 'form-label f-bold']) }}
        <p class="form-control-static">{{ nl2br($data->introduce) }}</p>
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
</div>
{{ form()->close() }}
<script type="text/javascript">
  $('.form-ajax input[type=checkbox]').attr('disabled', 'disabled');  
</script>