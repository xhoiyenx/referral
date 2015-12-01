<?php
# SETUP UPLOAD FOR REDACTOR IMAGES
Route::post('redactor/image/upload', function(){

  $image = Input::file('file');
  if ( $image->isValid() )
  {
    $valid_ext = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
    $ext = $image->getClientOriginalExtension();

    if ( in_array($ext, $valid_ext) ) {
      $image->move( public_path() . '/uploads', $image->getClientOriginalName() );

      $link = [
        'filelink' => '/public/uploads/' . $image->getClientOriginalName() 
      ];

      return stripslashes(json_encode($link));
    }
  }

});

Route::get('/', function()
{
  
  #seed_member();
  #
  #seed_lead();

});

function seed_lead()
{
  if ( ! class_exists('Faker\Factory') ) {
    return false;
  }

  $faker = Faker\Factory::create();
  $members = App\Models\Member::all();
  
  foreach ( $members as $member )
  {
    for ($i = 0; $i < $faker->numberBetween(2, 6); $i++)
    {
      $lead = new App\Models\Lead;
      $lead->member_id    = $member->id;
      $lead->company      = $faker->company;
      $lead->fullname     = $faker->name;
      $lead->mobile       = $faker->phoneNumber;
      $lead->phone        = $faker->phoneNumber;
      $lead->designation  = $faker->streetName;
      $lead->introduce    = $faker->realText(200, 2);
      $lead->status       = $faker->numberBetween(1, 5);
      $lead->sales_id     = null;
      
      $arr = [1, 2, 3];
      $solutions = $faker->randomElements($arr, $faker->numberBetween(1, 3));
      if ( $lead->save() ) {
        $lead->solutions()->sync( $solutions );
      }
    }
  }
}

function seed_member()
{
  if ( ! class_exists('Faker\Factory') ) {
    return false;
  }

  $faker = Faker\Factory::create();

  for ($i = 0; $i < 100; $i++)
  {
    $user = new App\Models\Member;
    $user->fullname   = $faker->name;
    $user->usermail   = $faker->freeEmail;
    $user->password   = app('hash')->make($faker->password);
    $user->mobile     = $faker->phoneNumber;
    $user->address    = $faker->address;
    $user->zipcode    = $faker->postcode;
    $user->country    = 'SG';
    $user->online     = 0;
    $user->status     = $faker->numberBetween(0, 2);
    $user->activation_code = app('hash')->make($user->usermail);
    $user->save();
  }
}