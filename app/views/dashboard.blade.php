@extends('layouts.default')

@section('content')
	@include('includes.alert')
	<h4>Hi, {{ Auth::user()->username }}!</h4>
	<p> Use navigation bar to navigate through survey options . </p>
@stop