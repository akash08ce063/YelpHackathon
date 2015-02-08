@extends('layout.master')

<link href="/css/signin.css" rel="stylesheet">

@section('body')


<div class="container" style="width:400px;height:400px;">
	<form method="post">
			<h2 class="form-signin-heading">Sign in</h2>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" name="login-email" class="form-control" placeholder="Email address" required autofocus><br/>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="login-password" class="form-control" placeholder="Password" required><br/>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Get me in!</button>
	</form>
</div>