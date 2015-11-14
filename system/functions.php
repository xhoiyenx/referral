<?php
function get_countries()
{
	return db()->table('countries')->lists('name', 'code');
}