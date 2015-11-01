
@extends('layouts.loginFrame')

@section('content')
   
    {{ Form::open(['route' => 'login', 'method' => 'post', 'class' => 'form-signin']) }}

        <h2 class="form-signin-heading">log in now</h2>
        
        <div class="login-wrap">
            @include('includes.alert')

            {{ Form::text('username', '',['class' => 'form-control', 'placeholder' => 'Enter Username', 'autofocus']) }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '********']) }}
			<div class="checkbox">
              	<label for="remember">
                  	<input type="checkbox" name="remember" id="remember"> Remember me
              	</label>
	        </div>
            {{ Form::submit('Log in', ['class' => 'btn btn-lg btn-login btn-block']) }}
        </div>

    {{ Form::close() }}

@stop