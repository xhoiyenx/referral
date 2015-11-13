@if ( $errors->has() )
<div class="kode-alert alert6">
  @foreach ($errors->all() as $error)
    {{ $error }}<br>        
  @endforeach
</div>
@endif
@if(session()->get('message'))
<div class="kode-alert alert3">
  {{session()->get('message')}}
</div>
@endif