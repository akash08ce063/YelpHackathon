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
		<h4><strong><?php echo $user; ?></strong><input class="btn" type="button" style="margin-left:10px;" value="Curse Ye!"/></h4>
	@endforeach
	<input type="button" class="btn" value="Ignore them!"/>
</div>