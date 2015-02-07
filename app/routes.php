<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/test',function(){
	$t = new Test();
	 //echo $t->akash();
	//return  View::make('testview');

	// $oauth = new OAuthToken("akash" , "patel");
	 $yelp_api = new YelpAPI();
	 $yelp_api->query_api("bars","San Francisco, CA");
	// $y = new YelpAPI();

});


Route::controller("/testing" , 'TestingController');