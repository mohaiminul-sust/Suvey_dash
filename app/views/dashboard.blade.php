@extends('layouts.default')

@section('content')
	@include('includes.alert')
	<h4>Hi, {{ Auth::user()->email }}!</h4>
@stop