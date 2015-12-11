		<div class="row tab-buttons">
			@foreach ( $tabs as $tab )
			<div class="col-md-3 col-lg-2">
				<a href="{{ route('admin.configuration', $tab) }}" class="btn btn-light btn-block @if($tab == $mode) current @endif">{{ strtoupper($tab) }}</a>
			</div>
			@endforeach
		</div>