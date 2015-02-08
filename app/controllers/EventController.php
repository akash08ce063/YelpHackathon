<?php

class EventController extends BaseController {

	public function getIndex(){

		$event_id = Input::get('event_id');
			
				$all_event_users = array();
				$all_other_users = ActiveEvent::where('event_id',"=",$event_id)->get();
				foreach ($all_other_users as $key => $value) {
					# code...
					if(count($all_other_users) > 0 ){
						
					if(!array_key_exists($value->user_id , $all_event_users)){
							$all_event_users[$value->user_id ] = array();
						}

						$user = User::find($value->user_id);
						array_push($all_event_users[$value->user_id ], $user->name);
						
						
					}
				}
				

				//print_r($all_event_users);

		return View::make('main.startPage')->with(array('all_event_users' => $all_event_users , 'event_id' => $event_id));
	}

	public function postIndex(){
		 $event_id = Input::get('event_id');
		 $latlng = Input::get('search_location_hidden');
		   $food_type =  Input::get("search_food");
		$param = "";
		if(!empty($_POST['check_list'])){
		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected){
				//echo $selected."</br>";
				if($param != "")
					$param = $param . "," . $selected;
				else
					$param = $selected;
			}
		}


		$typeFood = new EventType;
		$typeFood->event_id = $event_id;
		$typeFood->user_id = Auth::user()->id;
		$typeFood->latlng = $latlng;
		$typeFood->type = $food_type;
		$typeFood->parameters = $param;
		$typeFood->save();

		$userdata = ActiveEvent::whereRaw("event_id = ? and user_id = ?",array($event_id , Auth::user()->id))->first();



		$userdata->is_submitted = "true";
		$userdata->save();

		return Redirect::to('/result?event_id='.$event_id);


	}



}