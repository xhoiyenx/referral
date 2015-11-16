<?php
namespace App\Events;
class UserEvents
{	
	/**
	 * [subscribe description]
	 * @param  [type] $events [description]
	 * @return [type]         [description]
	 */
	public function subscribe( $events )
	{
		$events->listen('member.registration', 'App\Events\UserEvents@sendRegistrationConfirmation', 10);
		$events->listen('auth.login', 'App\Events\UserEvents@trackLogin', 10);
		$events->listen('auth.logout', 'App\Events\UserEvents@trackLogout', 10);
	}

	public function trackLogin( $user, $remember )
	{
		$user->logged_at = $user->freshTimestamp();
		$user->online = 1;
		$user->save();
	}

	public function trackLogout( $user )
	{
		$user->logout_at = $user->freshTimestamp();
		$user->online = 0;
		$user->save();
	}

	/**
	 * Send email contains activation link to user
	 * @param  [mixed] $event [event parameter]
	 * @return [void]
	 */
	public function sendRegistrationConfirmation( $user )
	{
		app('mailer')->send('email.member-registration', ['user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@itc2.clientsdemo.net', 'IT Concept Pte Ltd' );
		  $message->to( $user->usermail, $user->first_name . ' ' . $user->last_name );
		  $message->subject( 'Welcome to ITConcept Referral Program' );
		});
	}
}