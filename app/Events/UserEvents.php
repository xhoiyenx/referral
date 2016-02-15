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
		if ( is_a($user, 'App\Models\Member') ) {
			$user->logged_at = $user->freshTimestampString();
			$user->online = 1;
			$user->save();
		}
	}

	public function trackLogout( $user )
	{
		if ( is_a($user, 'App\Models\Member') ) {
			$user->logout_at = $user->freshTimestampString();
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
		try {
			$mail = app('mailer')->send('email.member-registration', ['user' => $user], function($message) use ($user)
			{
				$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			  $message->to( $user->usermail, $user->fullname );
			  $message->subject( 'Welcome to ITConcept Referral Program -> Account Pending for Activation' );
			});
		}
		catch (Exception $e) {
			return $e->getMessage();
		}
		
		//return $mail;
	}

	public function onLeadStatusUpdate( $lead, $notes )
	{
		if ( $lead->status == 2 ) {
			$lead->deal_closed_at = $lead->freshTimestampString();
			$lead->save();
		}

		$user = $lead->member;
		try {
			$mail = app('mailer')->send('email.lead-status', ['lead' => $lead, 'user' => $user, 'notes' => $notes], function($message) use ($user)
			{
				$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			  $message->to( $user->usermail, $user->fullname );
			  $message->subject( 'Administrator has changed one of your leads status' );
			});
		}
		catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function onLeadAssignSales( $lead, $sales, $notes )
	{
		
		$member = $lead->member;
		try {
			
			# Send email to sales
			$mail = app('mailer')->send('email.lead-sales', ['lead' => $lead, 'sales' => $sales, 'notes' => $notes], function($message) use ($sales)
			{
				$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			  $message->to( $sales->usermail, $sales->fullname );
			  $message->subject( 'Administrator has assigned you a Lead' );
			});

			# Send email to member
			$mail = app('mailer')->send('email.lead-member', ['lead' => $lead, 'sales' => $sales, 'member' => $member], function($message) use ($member)
			{
				$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			  $message->to( $member->usermail, $member->fullname );
			  $message->subject( 'A Sales Person has been assigned' );
			});

		}
		catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function onMemberActivated( $user )
	{
		if ( is_null($user) )
			return false;

		try {
			$mail = app('mailer')->send('email.member-activated', ['user' => $user], function($message) use ($user)
			{
				$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			  $message->to( $user->usermail, $user->fullname );
			  $message->subject( 'Welcome to ITConcept Referral Program' );
			});
		}
		catch (Exception $e) {
			return $e->getMessage();
		}
		
		//return $mail;
	}
}