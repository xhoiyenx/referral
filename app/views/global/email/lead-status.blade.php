<p>
	Dear {{ $user->fullname }},
</p>
<p>
	Administrator has changed one of your leads, details as follow:
</p>
<p>
	<strong>Lead Company</strong>: {{ $lead->company }}<br>
	Status changed to {{ lead_status( $lead->status ) }}
</p>