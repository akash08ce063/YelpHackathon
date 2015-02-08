<html>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

var address = "H3H2J7";

$.ajax({
  url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
  type: "POST",
  success:function(res){
     console.log(res.results[0].geometry.location.lat);
     console.log(res.results[0].geometry.location.lng);
  }
});


</script>
<body>



</body>


</html>