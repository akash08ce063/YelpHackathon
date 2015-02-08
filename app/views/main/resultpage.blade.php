@extends('layout.master')

@section('body')

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="text-align:center">
          <img src="<?php echo '/img/logo.png' ?>" style="height:170px;width:170px" />
         </div>
      </div>
</div>
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-md-3">

			</div>
			<div class="col-md-8">

				<div class="page-header">
				  <h1>  Resturants </h1>
				</div>

				<hr>

				@foreach($all_business as $key=>$value)
				<div class="media">
			      <div class="media-left">
			        <a href="#">
			          <img class="media-object" data-src="holder.js/64x64" alt="64x64" src=<?php echo $value['image_url']; ?> data-holder-rendered="true" style="width: 64px; height: 64px;">
			        </a>
			      </div>
			      <div class="media-body">
			        <h4 class="media-heading"><?php echo $value['name']; ?></h4>
			      	<?php echo $value['snippet_text'] ?>
			      </br>
			      	 Phone - <?php echo $value['display_phone'] ;?> , Address : <?php echo $value['location']['display_address'][0]?>
			      	 <br>	
			      	<img src=<?php echo $value['rating_img_url']?> />
			      </div>
			    </div>
			    @endforeach

			</div>


		</div>
        <div class="row">
        	<div class="col-md-3">

			</div>
			<div class="col-md-8">
					<div id="googleMap" style="width:500px;height:380px;"></div>
					
			</div>



        </div>
        
    </div>
</div>
     

      <hr>
      <div class="footer">
        <p>© Bud Joint 2015</p>
      </div>

<script
src="http://maps.googleapis.com/maps/api/js">
</script>
<script>
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);

  var participants = [
     @foreach($all_participants as $participant)
       <?php echo "['',".$participant['latlng']."]" ?>
     @endforeach
  ];

  for (i = 0; i < participants.length; i++) {  
  	  console.log("latlng: "+participants[i][1]+" ,"+participants[i][2]);
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(participants[i][1], participants[i][2]),
        map: map,
        icon: "/img/boy.png"
      });
  }

  var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];
 for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: "/img/fork.png"
      });
  }


}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

@stop