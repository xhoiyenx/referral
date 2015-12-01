@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="row">
        <div class="col-md-7">

          {{ form()->model( $data->toArray(), ['route' => ['client.lead.update', $data->id], 'class' => 'form-ajax'] ) }}
          <div class="panel panel-default">
            <div class="panel-title">Lead information</div>
            <div class="panel-body">
              
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
                      {{ $solutions }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ form()->label('phone', 'Phone Number', ['class' => 'form-label']) }} *
                      {{ form()->text('phone', null, ['class' => 'form-control', 'id' => 'phone']) }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ form()->label('mobile', 'Mobile Number', ['class' => 'form-label']) }} *
                      {{ form()->text('mobile', null, ['class' => 'form-control', 'id' => 'mobile']) }}
                    </div>
                  </div>
                </div>  

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      {{ form()->label('introduce', 'How you introduce us', ['class' => 'form-label']) }}
                      @if ( 1 != 1 )
                      {{ form()->textarea('introduce', null, ['class' => 'form-control', 'id' => 'introduce', 'rows' => 3]) }}
                      <p class="note">
                        Explain how you introduce us. For example you tell your contact that you take product from us before, or your friend, etc.
                      </p>
                      @else
                      <p class="note">
                        {{ nl2br($data->introduce) }}
                      </p>
                      @endif
                    </div>
                  </div>
                </div>
              
            </div>
            <div class="panel-footer">
                <strong>Date added:</strong> {{ $data->created_at->toFormattedDateString() }}<br>
                <strong>Added by:</strong> <a href="{{ route('admin.member.profile', $data->member->id) }}">{{ $data->member->fullname }}</a>
            </div>
          </div>
          {{ form()->close() }}

        </div>
        <div class="col-md-5">
          
          <div class="panel panel-default">
            <div class="panel-title">Lead Status Update</div>
            <div class="panel-body status lead-status">
              <div class="who clearfix">
                <span class="name"><b>Admin</b> update lead status to <b>Cold Lead<b></span>
                <span class="from"><b>59 minutes ago</b> at 24 Nov 2015</span>
                <p class="remarks">
                  Lead only comparing prices.
                </p>
              </div>
              <div class="who clearfix">
                <span class="name"><b>Jeffrey</b></span>
                <span class="from"><b>2 hours ago</b> at 24 Nov 2015</span>
                <p class="remarks">
                  Just met the lead.
                </p>
              </div>
              <div class="who clearfix">
                <span class="name"><b>Member C</b> added this lead</span>
                <span class="from"><b>15:02:56</b> at 23 Nov 2015</span>
              </div>
              <div class="form-status">
                <textarea class="form-control" rows="3" disabled="disabled">For next update, please ignore</textarea>
                <div class="text-r padding-t-10">
                  <button type="button" class="btn btn-primary">Send</button>
                </div>
              </div>
            </div>
          </div>          

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section("header_before_style")
@endsection

@section("header_after_style")
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
  
  $('.form-ajax input').attr('readonly', 'readonly');
  $('.form-ajax input[type=checkbox]').attr('disabled', 'disabled');

});
</script>
@endsection