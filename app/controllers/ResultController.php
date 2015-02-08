<?php

class ResultController extends BaseController {

	public function getIndex(){
		$event_id = Input::get('event_id');
		$bypass = Input::get('bypass');
		$all_user = ActiveEvent::where('event_id' , "=" ,$event_id)->get(); 
		$not_submitted_user = array();
		$submitted_user = array();
		foreach ($all_user as $key => $value) {
			echo $value->is_submitted;
			if($value->is_submitted != "true"){
				$not_submitted_user[$value->user_id] = array();
				$user = User::find($value->user_id);
				array_push($not_submitted_user[$value->user_id] , $user->name);
			}else{
				array_push($submitted_user, $value->user_id);
			}
		}

		



		if(empty($not_submitted_user) || $bypass == 'true'){


			

			$all_participants = EventType::where('event_id' , "=" ,$event_id)->get();
			// TODO: Show map with results
			$yelp_api = new YelpAPI();
	    	//$yelp_data = $yelp_api->query_api("pizza","Montreal","45.495518,-73.581662");
	    	$temp_user_store = array();
	    	$compare_data = array();

	    	echo count($submitted_user);

	    	foreach ($submitted_user as $key ) {
	    		$event_type_user =	EventType::whereRaw("event_id = ? and user_id = ?" , array($event_id , $key))->first();
	    		


	    		$type_food =  explode(",", $event_type_user->type);


	    		$yelp_data = $yelp_api->query_api($type_food[0],"Montreal",$event_type_user->latlng,"1","16093");
	    		$all_business = $yelp_data['businesses'];
	    		array_push($temp_user_store, $event_type_user);
	    		foreach ($all_business as $key=>$data) {
	    			// print_r($data['image_url']);

	    			if(!array_key_exists($data['image_url'], $compare_data)){
	    				$compare_data[$data['image_url']] = $data;
	    			}
	    		}

	    	}

	    	// print_r(count($compare_data));

	    	

	    	

	    	$distance = array();

	    	foreach ($compare_data as $key => $value) {
	    		$lat_res = $value['location']['coordinate']['latitude'];
	    		$lng_res = $value['location']['coordinate']['longitude'];

	    		foreach ($temp_user_store as $usr) {
	    			$latlng = $usr->latlng;
	    			$latlng_array = explode(",", $latlng);
	    		
	    			$utility = new Utility();
	    			$dis_km = $utility->finddistance($latlng_array[0],$latlng_array[1],$lat_res,$lng_res,"K");

	    			$dis_km = intval($dis_km);


	    			if(!array_key_exists($dis_km, $distance)){
	    			 	$distance[$dis_km] = array();
	    			}

	    			array_push($distance[$dis_km], $key); 


	    		}

	    	}

	    	ksort($distance);

	    	$all_business =array();
	    	$checking_array = array();

	    	foreach ($distance as $key => $value) {

	    		//print_r($value);
	    		print_r("</br>");
	    			//print_r("</br>");
	    			print_r("</br>");
	    			print_r("</br>");
	    			print_r("</br>");

	    		
	    		foreach ($value as $data) {

	    			
	    			if(!array_key_exists($data, $checking_array)){
	    				array_push($all_business, $compare_data[$data]);
	    				$checking_array[$data] = true;
	    			}

	    		}

	    		
	    	}

	    	foreach($all_business as $key){
	    		//  print_r($key['rating_img_url']);
	    		 // print_r("</br>");
	    		 //  print_r("</br>");
	    		  //  print_r("</br>");
	    		   //  print_r("</br>");

	    	}


			return View::make('main.resultpage')->with(array('all_business' => $all_business, 'all_participants' => $all_participants));
		}else{
			return Redirect::to('/pending?event_id='.$event_id);
		}
		
	}

}

