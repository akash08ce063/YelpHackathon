@extends('layout.master')
@section('scripts')
	
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  $(function() {
    var items = [ 'Cafes',
'Asian Fusion',
'Buffets',
'Chinese',
'Canadian (New)',
'Pizza',
'French',
'Sushi Bars',
'Italian',
'Breakfast & Brunch',
'Food',
'Donuts',
'Coffee & Tea',
'Sandwiches',
'Vegetarian',
'Japanese',
'Vietnamese',
'Tex-Mex',
'Poutineries',
'Comfort Food',
'Portuguese',
'Caterers',
'Event Planning & Services',
'Fast Food',
'Greek',
'Mediterranean',
'Delis',
'Bars',
'Nightlife',
'Cheese Shops',
'Specialty Food',
'Burgers',
'Hot Dogs',
'Caribbean',
'Vegan',
'Mexican',
'Hookah Bars',
'Modern European',
'Fondue',
'Indian',
'Thai',
'Tapas Bars',
'Venues & Event Spaces',
'Latin American',
'Colombian',
'Basque',
'Spanish',
'Middle Eastern',
'American (Traditional)',
'Diners',
'Salvadoran',
'Shopping',
'Sporting Goods',
'Bikes',
'Hotels & Travel',
'Travel Services',
'Bagels',
'Persian/Iranian',
'Belgian',
'Seafood',
'Bakeries',
'Tapas/Small Plates',
'Polish',
'Soup',
'Barbeque',
'Meat Shops',
'Creperies',
'Pubs',
'Grocery',
'Lebanese',
'Brasseries',
'Dim Sum',
'Colleges & Universities',
'Education',
'Hotels',
'Do-It-Yourself Food',
'Salad',
'Wine Bars',
'Bistros',
'Furniture Stores',
'Home & Garden',
'Afghan',
'Korean',
'Ethnic Food',
'Moroccan',
'Pakistani',
'Delicatessen',
'Gluten-Free',
'Steakhouses',
'Himalayan/Nepalese',
'African',
'Peruvian',
'Food Trucks',
'Ice Cream & Frozen Yogurt',
'Desserts',
'Cajun/Creole',
'Haitian',
'Ethiopian',
'American (New)',
'Irish',
'Russian',
'Breweries',
'Beer, Wine & Spirits',
'Food Delivery Services',
'Fish & Chips',
'Brazilian',
'German',
'Austrian',
'Argentine',];
        
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#search_food" )
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          response( $.ui.autocomplete.filter(
            items, extractLast( request.term ) ) );
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( "," );
          return false;
        }
      });
  });
  </script>
  
	
@stop

@section('body')

        
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="text-align:center">
          <img src="<?php echo '/img/logo.png' ?>" style="height:170px;width:170px" />
         </div>
      </div>
</div>
<div class="container">
	<div class="content" style="margin-top: 180px;">


      <div class="row-fluid">
        <div class="span4">
          <form method="post">
          		<input type="hidden" name="event_id" value=<?php echo $event_id ; ?> />

          		<div class="form-group">
				    <center><label for="exampleInputEmail1" style="font-size:22px;margin-bottom:22px;" > What would you like to eat?</label></center>
				    <input type="text" class="form-control" name="search_food" id="search_food" placeholder="Enter Food type you want to eat" style="margin-bottom:55px;">
				</div>
				<div class="form-group">
				    <center><label  style="font-size:22px;margin-bottom:22px;" > Tell us about your location?</label></center>
				    <input type="text" class="form-control" id="search_location" onchange="getLatLong();" placeholder="location" style="margin-bottom:55px;">
					<input type="hidden" name="search_location_hidden" id="search_location_hidden" />	
				</div>
          	
		         <div class="row">
		           	<div class="col-md-5">
		             	 <h3> Select the parameter for sorting</h3>
				        	<table class="table">
		  						<tr><td>	<label>Rating</label> </td><td>  <label> <input type="checkbox"  name="check_list[]" class="cat_checkbox" value="Rating"> </label>
 
		         				</td></tr>
		  						<tr><td><label>Distance</label></td><td> <label> <input type="checkbox"  name="check_list[]" class="cat_checkbox" value="Distance"> <br/>
		          				</td></tr>
		  						<tr><td><label>Promotion</label></td><td><label> <input type="checkbox"  name="check_list[]" class="cat_checkbox" value="Promotion"> 
		         				</td></tr>
		  						<tr><td><label>Price</label></td><td>	<label> <input type="checkbox"  name="check_list[]" class="cat_checkbox" value="Price"> 	</td></tr>
		            		</table>

		            		<center> <button type="submit" class="btn btn-primary btn-lg" > Submit My Choice !</button> </center>
							
          	          </form>
				      
					</div>
					
						<div class="col-md-3">

						</div>
					
					<div class="col-md-4">
						<h3> List of the user in Conversation</h3>
		           		<ul class="list-group">
		           			<?php  

		           				foreach ($all_event_users as $key=>$value ) {
		           				   echo "<li class='list-group-item' style='background-color: BLACK; color: WHITE;'>" . $value[0] . "</li>";
		           				}

		           			?>


						  
						</ul>
					</div>



				</div>


          
        </div>
        <div class="span4">
          </div>
        <div class="span4">
           </div>
      </div>
    </div>
      <hr>
      <div class="footer">
        <p>© Bud Joint 2015</p>
      </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU"></script>
        <script>
            var autocomplete = new google.maps.places.Autocomplete($("#search_location")[0], {});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place.address_components);
            });
        </script>

<script type="text/javascript">
	function getLatLong(){
		var address = $("#search_location").val();
		$.ajax({
			  url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
			  type: "POST",
			  success:function(res){
			     console.log(res.results[0].geometry.location.lat);
			     console.log(res.results[0].geometry.location.lng);
			     $("#search_location_hidden").val(res.results[0].geometry.location.lat + "," + res.results[0].geometry.location.lng);
			  }
			});

    }
</script>        
@stop
@section('scripts')
 <script type="text/javascript">
 $(document).ready(function(){
    $(".slider").slider();
 });
 </script>

 
@stop