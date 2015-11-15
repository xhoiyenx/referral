<?php
namespace App\Events;
class UserEvents
{
	/**
	 * member.registration, $user
	 * 
	 */
	
	/**
	 * [subscribe description]
	 * @param  [type] $events [description]
	 * @return [type]         [description]
	 */
	public function subscribe( $events )
	{
		$events->listen('member.registration', 'App\Events\UserEvents@onRegistration');
	}

	/**
	 * Send email contains activation link to user
	 * @param  [mixed] $event [event parameter]
	 * @return [void]
	 */
	public function onRegistration( $event )
	{
		$user = $event;
		app('mailer')->send('email.member-registration', ['user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@itc2.clientsdemo.net', 'IT Concept Pte Ltd' );
		  $message->to( $user->usermail, $user->first_name . ' ' . $user->last_name );
		  $message->subject( 'Welcome to ITConcept Referral Program' );
		});

	}
}