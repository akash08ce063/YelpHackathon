@extends('layout.master')

@section('body')
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="text-align:center">
          <img src="<?php echo '/img/logo.png' ?>" style="height:170px;width:170px" />
         </div>
      </div>
</div>
<style>
.hover-effect:hover{
	background-color: grey;
	color: white;
}
</style>
<div class="container">
	<div class="content" style="margin-top: 180px;">



      <div class="row-fluid">
        <div class="span4">
          <form method="post">

          	
		         <div class="row">
		           	<div class="col-md-5">
		           		<h3> Create a New Event! </h3>
		             	<div class="form-group">
		             		<label>Name of the Event</label>
				    		<input type="text" class="form-control" name="event_name" id="event_name" placeholder="Name" >
						</div>
						<div class="form-group">

		             		<label>Enter the participants</label>
				    		<input type="text" class="form-control" name="participants" id="participants" placeholder="Enter Participants" >
						</div>
		            	


		            		<center> <button type="submit" class="btn btn-primary btn-lg"> Create a New Event !</button> </center>
					
				      
					</div>


          
         </form>			

					<div class="col-md-7">
						<h3> List of the user in Conversation</h3>
		           		<ul class="list-group">
		           			<?php
		           				foreach ($all_event_involve as  $key=>$users) {
									$event = EventCreate::find($key);	
								echo " <li class='list-group-item hover-effect' id=".$event->id." onclick='go_event(this.id)' style='cursor:pointer;'> <b>" . $event->name ."</b>" ."</br>" ;

									foreach ($users as $key1 => $all_user_value) {
										echo "<ul>";
										foreach ($all_user_value as $active_event_key => $active_event_value) {
											 $current_user =  User::find($active_event_value->user_id);

											 echo "<li>" . ($current_user->name) ;


											
											  		if($active_event_value->is_submitted == "true"){
											  			echo "			- (Submitted)";
											  		}else{
											  			echo "			-  (Decision Pending)";
											  		}
											  
											  echo  "</li>";
										}
										echo "</ul>";
									}

									echo "</li>" ;
								}


		           			?>
						  
						</ul>
					</div>



				</div>


        </div>
        
      </div>
    </div>
      <hr>
      <div class="footer">
        <p>© Bud Joint 2015</p>
      </div>
</div>

<?php
		$all_users = User::all();
?>

@stop

@section('scripts')
<script type="text/javascript" src="/js/jquery.tokeninput.js"></script>
 <link rel="stylesheet" href="/css/token-input.css" />

<script type="text/javascript">
	$(document).ready(function(){

			var all_USers = [];

			 @foreach($all_users as $key=>$detail)
			 	all_USers.push(<?php echo $detail; ?>);

			 @endforeach

			 $("#participants").tokenInput(all_USers, {
            	
                propertyToSearch: "name",
                resultsFormatter: function(item){ return "<li>" + "<img src= https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png title='" + item.name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.name + "</div><div class='email'>" + item.username + "</div></div></li>" },
                tokenFormatter: function(item) { return "<li><p>" + item.name +"<p></li>" }
            });
	});

	function go_event(id){
		console.log(id);
		window.location.href=" /event?event_id=" + id;
	}
</script>


@stop