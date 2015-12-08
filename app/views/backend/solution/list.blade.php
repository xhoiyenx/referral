@extends("layout.master")
@section("content")
@include('layout.notices')
<div class="container-default">

  @if ( count($solutions) > 0 )
  <div class="row">

    @foreach ( $solutions as $solution )
    <div class="col-md-4">

      <div class="panel panel-default blog-post">
        <div class="panel-title">
          {{ $solution->name }}
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-eye"></i></a></li>
            <!--<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>-->
          </ul>
        </div>
        <div class="panel-body">
          <div class="blog-content">
            {{ $solution->description }}
          </div>
          <ul class="list-group">
            <li class="list-group-item"><strong>Price:</strong> S${{ currency_format($solution->price) }}</li>
            <li class="list-group-item"><strong>Referral Fee:</strong> S${{ currency_format($solution->fee) }}</li>
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

});
</script>
@endsection