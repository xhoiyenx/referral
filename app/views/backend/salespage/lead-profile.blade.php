@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">
  <div class="row">
    <div class="col-md-8">

      <div class="panel panel-default">
        <div class="panel-title">Lead information</div>
        <div class="panel-body">
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {{ form()->label('company', 'Company Name', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ $data->company }}</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {{ form()->label('fullname', 'Contact Person Name', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ $data->fullname }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {{ form()->label('designation', 'Designation', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ $data->designation }}</p>
                </div>
              </div>    
            </div>

            <div class="row" style="margin-bottom:18px">
              {{ form()->label('solutions', 'Solutions Interested', ['class' => 'form-label col-md-12']) }}
              @if ( ! empty( $solutions ) )
                @foreach ( $solutions as $solution )
                <div class="col-md-6">
                  <div class="checkbox">
                  {{ form()->checkbox('solutions[]', $solution->id, null, ['id' => 'cb_' . $solution->id, 'disabled' => 'disabled']); }}
                  {{ form()->label('cb_' . $solution->id, $solution->name) }}
                  </div>
                </div>
                <div class="clearfix visible-md-block visible-lg-block"></div>
                @endforeach
              @endif
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {{ form()->label('phone', 'Phone Number', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ $data->phone }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {{ form()->label('usermail', 'E-Mail', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ $data->usermail }}</p>
                </div>
              </div>
            </div>  

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {{ form()->label('introduce', 'How you introduce us', ['class' => 'form-label']) }}
                  <p class="form-control-static">{{ nl2br($data->introduce) }}</p>
                </div>
              </div>
            </div>
          
        </div>
        <div class="panel-footer">
            <strong>Date added:</strong> {{ $data->created_at->toFormattedDateString() }}<br>
            <strong>Added by:</strong> <a href="{{ route('admin.member.profile', $data->member->id) }}">{{ $data->member->fullname }}</a>
        </div>
      </div>

    </div>
    <div class="col-md-4">
      
      {{ form()->model( $data->toArray(), ['route' => ['sales.lead.save_status', $data->id]] ) }}
      <div class="panel panel-default">
        <div class="panel-title">Lead Status Update</div>
        <div class="panel-body status lead-status">
        @if ( $data->history()->count() > 0 )
          @foreach( $data->history()->orderBy('id', 'desc')->get() as $history )
          <div class="who clearfix">
            <span class="name">
            @if ( ! is_null( $history->admin_id ) )
              <strong>Admin</strong>
            @endif

            @if ( ! is_null( $history->sales_id ) )
              <strong>{{ $history->sales->fullname }}</strong>
            @endif

            @if ( ! is_null( $history->new_status ) )
              set lead status to <strong>{{ lead_status( $history->new_status ) }}</strong>
            @endif

            @if ( ! is_null( $history->new_status ) && ! is_null( $history->new_sales_id ) )
              set lead status to <strong>{{ lead_status( $history->new_status ) }}</strong> and assign <strong>{{ $data->sales->fullname }}</strong>
            @elseif ( ! is_null( $history->new_sales_id ) )
              assign <strong>{{ $data->sales->fullname }}</strong> as sales
            @endif
            </span>

            @if ( $history->created_at->diffInHours() > 12 )
              <span class="from">{{ $history->created_at->toTimeString() }} at {{ $history->created_at->toFormattedDateString() }}</span>
            @else
              <span class="from">{{ $history->created_at->diffForHumans() }}</span>
            @endif
          
            @if ( ! empty( $history->notes ) )
            <p class="remarks">
              {{ nl2br($history->notes) }}
            </p>
            @endif
          </div>
          @endforeach
        @endif
          <div class="who clearfix">
            <span class="name"><a href="{{ route('admin.member.profile', $data->member->id) }}">{{ $data->member->fullname }}</a> added this lead</span>
            <span class="from">{{ $data->created_at->toTimeString() }} at {{ $data->created_at->toFormattedDateString() }}</span>
          </div>
        </div>
        <div class="panel-footer">
          @if ( isset($is_admin) )
          {{ form()->hidden('is_admin', $is_admin) }}
          <div class="form-group">
            {{ form()->label('sales_id', 'Sales Person', ['class' => 'form-label f-bold']) }}
            {{ form()->select('sales_id', $sales, null, ['class' => 'form-control']) }}
          </div>
          @endif

          <div class="form-group">
            {{ form()->label('status', 'Status', ['class' => 'form-label f-bold']) }}
            {{ form()->select('status', $statuses, null, ['class' => 'form-control']) }}
          </div>
          <div class="form-group">
            {{ form()->label('notes', 'Notes', ['class' => 'form-label f-bold']) }}
            {{ form()->textarea('notes', null, ['class' => 'form-control', 'rows' => 4]) }}
          </div>
          <div class="text-r">
            <button class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      {{ form()->hidden('is_sales', auth()->sales()->user()->id) }}
      {{ form()->close() }}

    </div>
  </div>
</div>
@endsection

@section("header_before_style")
@endsection

@section("header_after_style")
<style type="text/css">
.col-md-6 .checkbox {
  margin-top: 8px;
  margin-bottom: 12px;
}

.input-group-addon .checkbox {
  margin:0 -16px -4px 0;
  padding: 0 0 0 10px;
}

.lead-status {
  max-height: 493px;
  overflow-x: hidden;
}
</style>
@endsection

@section("footer")
<div class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  
  //$('.form-ajax input').attr('readonly', 'readonly');
  //$('.form-ajax input[type=checkbox]').attr('disabled', 'disabled');
  
  $('.edit-fee input[type=checkbox]').change(function(event) {
    var textbox = $(this).parent().parent().next();
    if ( $(this).prop('checked') ) {
      textbox.removeAttr('disabled').focus();
    }
    else {
      textbox.val('').attr('disabled', 'disabled');
    }
  });

  if ( $('.edit-fee input[type=checkbox]').prop('checked') ) {
    $('.edit-fee input[type=checkbox]').parent().parent().next().removeAttr('disabled');
  }

});
</script>
@endsection