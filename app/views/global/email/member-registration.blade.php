Dear {{$user->fullname}}

Please follow the link below to activate your account.
{{ link_to('clientzone/activate?key=' . $user->activation_code, 'Click Here') }}

For assistance, please call +65 6850 5001 ; ext: 888.