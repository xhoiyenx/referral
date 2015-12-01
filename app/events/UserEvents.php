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
		$events->listen('member.lead.status_update', 'App\Events\UserEvents@onLeadStatusUpdate', 10);
		#$events->listen('auth.login', 'App\Events\UserEvents@trackLogin', 10);
		#$events->listen('auth.logout', 'App\Events\UserEvents@trackLogout', 10);
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
			$message->from( 'no-reply@itc2.clientsdemo.net', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Welcome to ITConcept Referral Program' );
		});
	}

	public function onLeadStatusUpdate( $lead )
	{
		$user = $lead->member;
		app('mailer')->send('email.lead-status', ['lead' => $lead, 'user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@itc2.clientsdemo.net', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Administrator has changed one of your leads status' );
		});
	}
}