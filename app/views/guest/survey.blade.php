@extends('layouts.default')

@section('content')
	@include('includes.alert')
	<section class="panel">
	  <header class="panel-heading">
	      Surveys done by {{ $guest->email }}
	  </header>
	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Survey Name</th>
	          @if (Auth::user()->role->type == 'super_admin')
	          	<th>Created By</th>
	          @endif
	          <th>Location</th>

	          <th>Survey taken</th>
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($track_surveys as $track_survey)
	      	<?php 
                $survey = Survey::find($track_survey->surveys_id);
             ?>
            <tr>
	          <td class="p-name">
	              <a href="#">{{ $survey->title }}</a>
	              <br>
	              <small>Created {{ $survey->getSurveyCreatedDate() }} Updated {{ $survey->getSurveyUpdatedDate() }}</small>
	          </td>
	          @if (Auth::user()->role->type == 'super_admin')
	          	<td class="p-name">
		          {{ $survey->user->username }}
		        </td>
	          @endif
	          <td>
	          	{{ $track_survey->lat }} , {{ $track_survey->lon }}
	          </td>
	          <td>
	            {{ $track_survey->created_at }}  
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->

@stop
