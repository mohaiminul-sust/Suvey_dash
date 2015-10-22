@extends('layouts.default')

@section('content')
	@include('includes.alert')
	<h4>Hi, {{ Auth::user()->username }}!</h4>
@stop