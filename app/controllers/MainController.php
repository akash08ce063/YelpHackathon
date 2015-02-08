<?php

class MainController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{


		//return Auth::user()->id;
		$events_involve = ActiveEvent::where('user_id' , "=" , Auth::user()->id)->get();

		$all_event_involve = array();
		$status = array();


		foreach ($events_involve as $key => $value) {
			
					
				$all_other_users = ActiveEvent::where('event_id',"=",$value->event_id)->get();

				if(count($all_other_users) > 0 ){
						
					if(!array_key_exists($value->event_id , $all_event_involve)){
						$all_event_involve[$value->event_id ] = array();
					}
					array_push($all_event_involve[$value->event_id ], $all_other_users);
					
					foreach ($all_other_users as $all_user_event_key => $all_user_event_value) {
						echo $all_user_event_value->user_id;
						if(!array_key_exists($all_user_event_value->user_id , $status)){
								
						}

								
					}

				}


				
		}

		
		 return View::make('main.mainpage')->with(array('all_event_involve' => $all_event_involve , 'status' => $status));
	}


	public function postIndex(){
	    $event_name =  Input::get("event_name");
		$participants_string =  Input::get("participants");
		$participants = explode(",", $participants_string);

		$event = new EventCreate ;
		$event->name = $event_name;
		$event->user_id = Auth::user()->id;
		$event->save();

		for($i=0 ; $i< count($participants) ; $i++){
			$active_event = new ActiveEvent;
			$active_event->event_id = $event->id;
			$active_event->user_id = (int)$participants[$i];
			$active_event->is_submitted = "false";
			$active_event->save();
		}	

		    $active_event_current_user = new ActiveEvent;
			$active_event_current_user->event_id = $event->id;
			$active_event_current_user->user_id = Auth::user()->id;
			$active_event_current_user->is_submitted = "false";
			$active_event_current_user->save();

			return Redirect::to('/event?event_id='.$event_id);
	}



}
