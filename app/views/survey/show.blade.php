@extends('layouts.default');

@section('content')
	@include('includes.alert')

	<!-- page start-->
	<section class="panel">
	  <header class="panel-heading">
	      Survey Details
	  </header>

	</section>
	<div class="row">
	  <div class="col-md-8">
	      <section class="panel">
	          <div class="bio-graph-heading project-heading">
	              <strong> [ {{ $survey->title }} ] </strong>
	          </div>
	          <div class="panel-body bio-graph-info">
	              <!--<h1>New Dashboard BS3 </h1>-->
	              <div class="row p-details">
	                  <div class="bio-row">
	                      <p><span class="bold">Created by </span>: {{ $survey->user->username }}</p>
	                  </div>
	                  <div class="bio-row">
	                      <p><span class="bold">Created at </span>: {{ $survey->getSurveyCreatedDate() }}</p>
	                  </div>
	                  <div class="bio-row">
	                      <p><span class="bold">Question </span>: {{ $survey->questions->count() }}</p>
	                  </div>
	                  <div class="bio-row">
	                      <p><span class="bold">Last Updated</span>: {{ $survey->getSurveyUpdatedDate() }}</p>
	                  </div>

	              </div>

	          </div>

	      </section>

	      <section class="panel">
	        <header class="panel-heading">
	          Last Activity
	        </header>
	        
	      </section>

	  </div>
	  <div class="col-md-4">
	      <section class="panel">
	          <header class="panel-heading">
	              Projects Description
	          </header>

	          
	      </section>
	  </div>
	</div>
	<!-- page end-->
@stop