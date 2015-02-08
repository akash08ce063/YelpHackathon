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
	return View::make('testview1');
});


Route::get('/test',function(){



	$t = new Test();
	 //echo $t->akash();
	//return  View::make('testview');

	// $oauth = new OAuthToken("akash" , "patel");
	 
	 	ini_set('memory_limit', '-1');
		//$contents = File::get(public_path()."/json/sample.json");
		//print_r($contents);
		//echo sizeof($contents);
		
		  //$json = str_replace('&quot;', '"', $contents);
		 //$json = json_decode(stripslashes($json));
		 //$deocded = json_decode($json);
		 //echo json_last_error();
		 //echo $json;
/*
		 $handle = fopen(public_path()."/json/yelp_academic_dataset_business.json", "r");
	   if ($handle) {
	     while (($line = fgets($handle)) !== false) {
	        // process the line read.
	    	   $jsoon = 	(json_decode($line ,true));
	    	   print_r( $jsoon["categories"]);
	    	  exit(0);
	    }

	    //45.495518
	    //-73.581662

    fclose($handle);
} else {
    // error opening the file.
} 
*/


	   //$ut = new Utility();
       //echo  $ut->finddistance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
       //echo  $ut->finddistance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";

	echo "string";


	 $yelp_api = new YelpAPI();
	 $yelp_api->query_api("pizza","Montreal","45.495518,-73.581662");
	// $y = new YelpAPI();

});

Route::controller("main",'MainController');
Route::controller("event",'EventController');
Route::controller("result",'ResultController');
Route::controller("login",'LoginController');
Route::controller("pending",'PendingController');
Route::get("view",function(){

	//echo Auth::user()->username;
	if (Auth::attempt(array('username' => "akashkpatel1991@gmail.com", 'password' => "akash")))
{
    return "s";
}else
	return "f";
	 

	//return View::make('main.mainpage');
});


Route::controller("/testing" , 'TestingController');