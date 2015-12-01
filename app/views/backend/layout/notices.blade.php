@if ( $errors->count() > 0 )
<div class="kode-alert alert6">
  @foreach ($errors->all() as $error)
    {{ $error }}<br>        
  @endforeach
</div>
@endif
@if(session()->has('message'))
<div class="kode-alert alert3">
  {{session()->get('message')}}
</div>
@endif