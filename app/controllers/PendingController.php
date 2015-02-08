<?php

class PendingController extends BaseController{

	public function getIndex(){
        $event_id = Input::get('event_id');
		$all_user = ActiveEvent::where('event_id' , "=" ,$event_id)->get(); 
		$not_submitted_user = array();
		foreach ($all_user as $key => $value) {
			echo $value->is_submitted;
			if($value->is_submitted != "true"){
				$user = User::find($value->user_id);
				array_push($not_submitted_user, $user->name);
			}
		}
		return View::make('main.pendingpage')->with(array('not_submitted_user' => $not_submitted_user));
	}
}