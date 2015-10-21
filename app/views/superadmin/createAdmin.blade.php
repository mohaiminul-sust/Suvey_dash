@extends('layouts.default')

@section('content')
	@include('includes.alert')

	<!-- page start-->
	<section class="panel">
	  <header class="panel-heading col-lg-offset-2">
	  	 Create Admin
	  </header>
	  
	  {{ Form::open(['route' => 'createAdmin', 'method' => 'post', 'class' => 'form-horizontal tasi-form']) }}

	  <div class="form col-lg-offset-2">

	 	 <div class="form-group">
			{{ Form::label('Username', '',['class'=>'col-lg-2 control-label']) }}
			<div class= "col-lg-6">
				{{ Form::text('username', '', ['class'=>'form-control']) }}
			</div>
		 </div>
	
		 <div class="form-group">
			{{ Form::label('New Password', '', ['class'=>'col-lg-2 control-label']) }}
			<div class="col-lg-6">
				{{ Form::password('password', ['class'=>'form-control']) }}
			</div>
		 </div>
	
		 <div class="form-group">
			{{ Form::label('Confirm Password', '', ['class'=>'col-lg-2 control-label']) }}
			<div class="col-lg-6">
				{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
			</div>
		 </div>

		 <div class="form-group">
		 	<div class="col-lg-offset-7 col-lg-1">
		 		{{-- <a href="{{ URL::route('createAdmin') }}" class="btn btn-danger" type="submit">Submit</a> --}}
		 		{{ Form::submit('Submit', ['class' => 'btn btn-danger']) }}
		 	</div>
		 </div>
		
	
	 </div>
	 {{ Form::close() }} 
	</section>
	<!-- page end-->

@stop
