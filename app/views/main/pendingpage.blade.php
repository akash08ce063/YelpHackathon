@extends('layout.master')


@section('body')
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="text-align:center">
          <img src="<?php echo '/img/logo.png' ?>" style="height:170px;width:170px" />
         </div>
      </div>
</div>
<div class="container" style="text-align:center;margin-top: 180px;">
    <h3>Some of your buds have not yet accepted to join the event</h3>
    @foreach($not_submitted_user as $user)
        <h4><strong><?php echo $user; ?></strong><input class="btn" type="button" style="margin-left:10px;" value="Curse Ye!" onclick="curse(<?php echo "'".$user."'"?>)"/></h4>
    @endforeach
    <input type="button" class="btn" value="Ignore them!" onclick="ignore();"/>
</div>

<script>

function curse(name){
    var curseName = prompt('What do you want to curse '+name);
    console.log(curseName);
}
    
function ignore(){
   location.href = '/result?bypass=true&event_id='+getParameterByName('event_id');
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
</script>

@stop