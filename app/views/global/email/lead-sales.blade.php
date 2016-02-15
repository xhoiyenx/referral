<p>
	Dear {{ $sales->fullname }},
</p>
<p>
	Administrator has assigned a Lead to be processed, details as follow:
</p>
<p>
	<strong>Lead Company</strong>: {{ $lead->company }}<br>
</p>
@if ( $notes != '' )
<p>
	<strong>Note:</strong><br>
	{{ nnl2br($notes) }}
</p>
@endif
<p>
	Thank you.
</p>
<p>
	ITConcept Pte Ltd
</p>