<?php

class ResultController extends BaseController {

	public function getIndex(){
		$event_id = Input::get('event_id');
		$all_user = ActiveEvent::where('event_id' , "=" ,$event_id)->get(); 
		$not_submitted_user = array();
		foreach ($all_user as $key => $value) {
			echo $value->is_submitted;
			if($value->is_submitted != "true"){
				$not_submitted_user[$value->user_id] = array();
				$user = User::find($value->user_id);
				array_push($not_submitted_user[$value->user_id] , $user->name);
			}
		}

		#if(empty($not_submitted_user)){
			$all_participants = EventType::where('event_id' , "=" ,$event_id)->get();
			// TODO: Show map with results
			$yelp_api = new YelpAPI();
	    	$yelp_data = $yelp_api->query_api("pizza","Montreal","45.495518,-73.581662");

	    	$all_business = $yelp_data['businesses'];
	    	
			$bussiness = $all_business[0];

			return View::make('main.resultpage')->with(array("bussiness" => $bussiness , 'all_business' => $all_business, 'all_participants' => $all_participants));
		#}else{
			#return Redirect::to('/pending?event_id='.$event_id);
		#}
		
	}

}

