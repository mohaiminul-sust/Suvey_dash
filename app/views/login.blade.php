
@extends('layouts.loginFrame')

@section('content')
   
    {{ Form::open(array('route' => 'login', 'method' => 'post', 'class' => 'form-signin')) }}

        <h2 class="form-signin-heading">log in now</h2>

        <div class="login-wrap">
            @include('includes.alert')

            {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}

            <label class="checkbox">
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                </span>
            </label>
            {{ Form::submit('Log in', array('class' => 'btn btn-lg btn-login btn-block')) }}
        </div>

    {{ Form::close() }}

    <!--  Modal -->

    {{ Form::open(array('action' => 'RemindersController@postRemind', 'method' => 'post', 'class' => 'form-signin')) }}

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Forgot Password ?</h4>
                 </div>
                 <div class="modal-body">
                     <p>Enter your e-mail address below to reset your password.</p>
                     <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                 </div>
                 <div class="modal-footer">
                     <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                     {{ Form::submit('Reset', array('class' => 'btn btn-success')) }}
                    <!--  <button class="btn btn-success" type="button">Submit</button> -->
                 </div>
             </div>
         </div>
        </div>

    {{ Form::close() }}

@stop