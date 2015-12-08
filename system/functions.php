<?php
function get_countries()
{
	return db()->table('countries')->lists('name', 'code');
}

function get_country_name( $code )
{
  $query = db()->table('countries')->select('name')->where('code', $code)->first();
  if ($query) {
    return $query->name;
  }
}

function currency_format( $float )
{
	return number_format( $float, 2, '.', ',' );
}

function lead_status( $status )
{
  switch ( $status ) {
    case '1':
      return 'Cold Lead';
      break;
    
    case '2':
      return 'Deal Closed';
      break;
    
    case '3':
      return 'Hot Lead';
      break;
    
    case '4':
      return 'Payment Received';
      break;
    
    case '5':
      return 'Warm Lead';
      break;
  }
}