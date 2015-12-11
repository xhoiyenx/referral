@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">

  @if ( count($solutions) > 0 )
  <div class="row">

    @foreach ( $solutions as $solution )
    <div class="col-md-6">

      <div class="panel panel-default blog-post">
        <div class="panel-title">
          {{ $solution->name }}
          <ul class="panel-tools">
            <li><a href="{{ route('client.page', ['solution', $solution->id]) }}" class="icon view-modal" title="View More"><i class="fa fa-eye"></i></a></li>
            <!--<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>-->
          </ul>
        </div>
        <div class="panel-body">
          @if ( $solution->image != '' )
          <img src="{{ '/public/uploads/' . $solution->image }}" class="image" style="opacity:1">
          @endif
          <div class="blog-content">
            {{ $solution->description }}
          </div>
          <ul class="list-group">
            <li class="list-group-item font-title"><strong>Price:</strong> S${{ currency_format($solution->price) }}</li>
            <li class="list-group-item font-title"><strong>Referral Fee:</strong> S${{ currency_format($solution->fee) }}</li>
          </ul>          
        </div>
      </div>
      
    </div>
    @endforeach

  </div>
  @endif
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
  $('.view-modal').click(function(event) {
    event.preventDefault();
    $.get($(this).attr('href'), function(data) {
      $('.modal-content').html(data);
      $('.modal').modal('show');
    });
  });
});
</script>
@endsection