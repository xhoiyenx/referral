<?php
# Installation and Upgrade
Route::get('system/install', function(){

	try {
		$mail = app('mailer')->send('email.template', [], function($message) {
			$message->from( 'jonathan@referralsg.com', 'ITConcept Pte Ltd' );
			$message->to('hoiyen@itconcept.sg', 'John Smith')->subject('Welcome!');
		});
	}
	catch (Exception $e) {
		dump($e->getMessage());
	}

});

Route::get('system/upgrade', function(){
	/**
	 * VERSION 0.1.8
	 * Add password on sales data
	 */
	Schema::table('sales', function($table) {
		$table->char('password', 60)->after('usermail');
		$table->string('remember_token', 100)->nullable()->after('password');
	});

	/**
	 * VERSION 0.1.7
	 * Add custom fee on each assigned solution
	
	Schema::table('lead_solutions', function($table) {
		$table->decimal('custom_fee', 10, 2)->nullable()->after('solution_id');
	});

	// Add lead status history
	Schema::create('lead_history', function($table) {
		$table->mediumInteger('id', true, true)->unsigned();
		$table->mediumInteger('lead_id')->unsigned();
		$table->mediumInteger('admin_id')->unsigned()->nullable();
		$table->mediumInteger('sales_id')->unsigned()->nullable();
		$table->mediumInteger('member_id')->unsigned()->nullable();
		$table->char('old_status', 1)->nullable();
		$table->char('new_status', 1)->nullable();
		$table->mediumInteger('old_sales_id')->unsigned()->nullable();
		$table->mediumInteger('new_sales_id')->unsigned()->nullable();
		$table->text('notes');
		$table->timestamps();
	});
	*/
	

	/**
	 * VERSION 0.1.6
	 * Add sort on page
	
	Schema::table('page', function($table) {
		$table->mediumInteger('sort_order')->default(0)->after('status');
	});
	*/


	/**
	 * VERSION 0.1.5
	 * Add configuration
	
	Schema::create('configuration', function($table) {
		$table->string('name', 100)->unique();
		$table->text('value');
		$table->timestamps();
	});
	 */

	/**
	 * VERSION 0.1.4
	 * Add Image Column on solution and testimonial
 	
	Schema::table('solutions', function($table) {
		$table->string('image', 100)->nullable()->after('name');
	});

	Schema::table('page', function($table) {
		$table->string('image', 100)->nullable()->after('admin_id');
	});
	*/


	/**
	 * VERSION 0.1.3
	 * Add Email Column on Leads
	
	Schema::table('leads', function($table) {
		$table->string('usermail', 100)->nullable()->after('fullname');
	});
 	*/

	/**
	 * VERSION 0.1.2
	 * Add Solution Indexing
	
	Schema::table('solutions', function($table) {
		$table->mediumInteger('sort_order')->default(0);
	});
 	*/

	/**
	 * VERSION 0.1.1
	 * Record closed_deal status timestamps on LEADS	
	Schema::table('leads', function($table){
		$table->timestamp('deal_closed_at')->after('sales_id');
	});	
 	*/
 
	/**
	 * VERSION 0.1.0
	# CONTENTS MODULE
	Schema::create('page', function($table)
	{
	  $table->mediumInteger('id', true, true);
	  $table->mediumInteger('admin_id')->unsigned();
	  $table->string('type', 50);
	  $table->mediumText('title');
	  $table->text('description');
	  $table->string('slug', 100);	  
	  $table->string('status', 20);
	  $table->timestamps();
	});

	# SALES MODULE
	Schema::create('sales', function($table)
	{
	  $table->mediumInteger('id', true, true);
	  $table->string('fullname');	  
	  $table->string('usermail');
	  $table->string('mobile', 30);
	  $table->timestamps();
	});
	*/

});