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
		$events->listen('member.member_activated', 'App\Events\UserEvents@onMemberActivated', 10);
		$events->listen('member.lead.status_update', 'App\Events\UserEvents@onLeadStatusUpdate', 10);
		$events->listen('lead.assign_sales', 'App\Events\UserEvents@onLeadAssignSales', 10);
		$events->listen('auth.login', 'App\Events\UserEvents@trackLogin', 10);
		$events->listen('auth.logout', 'App\Events\UserEvents@trackLogout', 10);
	}

	public function trackLogin( $user, $remember )
	{
		if ( is_a($user, 'Member') ) {
			$user->logged_at = $user->freshTimestamp();
			$user->online = 1;
			$user->save();
		}
	}

	public function trackLogout( $user )
	{
		if ( is_a($user, 'Member') ) {
			$user->logout_at = $user->freshTimestamp();
			$user->online = 0;
			$user->save();
		}
	}

	/**
	 * Send email contains activation link to user
	 * @param  [mixed] $event [event parameter]
	 * @return [void]
	 */
	public function sendRegistrationConfirmation( $user )
	{
		$mail = app('mailer')->send('email.member-registration', ['user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@referralsg.com', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Welcome to ITConcept Referral Program -> Account Pending for Activation' );
		});
		
		return $mail;
	}

	public function onLeadStatusUpdate( $lead )
	{
		if ( $lead->status == 2 ) {
			$lead->deal_closed_at = $lead->freshTimestamp();
			$lead->save();
		}

		$user = $lead->member;
		$mail = app('mailer')->send('email.lead-status', ['lead' => $lead, 'user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@referralsg.com', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Administrator has changed one of your leads status' );
		});
	}

	public function onLeadAssignSales( $lead, $user )
	{
		# Send email to sales
		$mail = app('mailer')->send('email.lead-sales', ['lead' => $lead, 'user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@referralsg.com', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Administrator has assigned you a Lead' );
		});
	}

	public function onMemberActivated( $user )
	{
		if ( is_null($user) )
			return false;

		$mail = app('mailer')->send('email.member-activated', ['user' => $user], function($message) use ($user)
		{
			$message->from( 'no-reply@referralsg.com', 'ITConcept Pte Ltd' );
		  $message->to( $user->usermail, $user->fullname );
		  $message->subject( 'Welcome to ITConcept Referral Program' );
		});
		
		return $mail;
	}
}