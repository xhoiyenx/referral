<?php
# Installation and Upgrade
Route::get('system/install', function(){

});

Route::get('system/upgrade', function(){

	/**
	 * VERSION 0.1.4
	 * Add Image Column on solution and testimonial
 	*/
	Schema::table('solutions', function($table) {
		$table->string('image', 100)->nullable()->after('name');
	});

	Schema::table('page', function($table) {
		$table->string('image', 100)->nullable()->after('admin_id');
	});


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