<p>
	Dear {{ $user->fullname }},
</p>
<p>
	Your account has been activated. You can now start submitting new lead to our system.
</p>
<p>
	<strong>LOGIN INFORMATION</strong><br>
	Url: {{ route('client.dashboard') }}<br>
	Username: {{ $user->usermail }}<br>
	Password: ********
</p>
<p>
	For assistance, please email to jonathan@referralsg.com or call +65 6850 5001 ; ext: 888#
</p>
<p>
	Thank you.
</p>
<p>
	ITConcept Pte Ltd
</p>