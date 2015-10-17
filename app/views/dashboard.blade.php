@extends('layouts.default')

@section('content')
	@include('includes.alert')
	Hi, {{ Auth::user()->email }}!
@stop