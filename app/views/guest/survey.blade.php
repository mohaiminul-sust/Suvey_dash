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
              <th></th> 
              @if (Auth::user()->role->type == 'super_admin')
              	<th>Created By</th>
              @endif
              <th>Questions</th>
              <th>Location</th>
              <th>Time taken</th>
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($track_surveys as $track_survey)
	      	<?php 
                $survey = Survey::find($track_survey->surveys_id);
             ?>
            <tr>
	          <td class="p-name">
	              <a href="{{ URL::route('showGuestSurveyAnswer', [$guest->id, $survey->id]) }}">{{ $survey->title }}</a>
	              <br>
	              <small>Created {{ $survey->getSurveyCreatedDate() }} Updated {{ $survey->getSurveyUpdatedDate() }}</small>
	          </td>
              <td>
                <a href="{{ URL::route('showGuestSurveyAnswer', [$guest->id, $survey->id]) }}" class="btn btn-primary btn-xs">
                   <i class="fa fa-folder"></i> View 
                </a>  
              </td>
	          @if (Auth::user()->role->type == 'super_admin')
	          	<td class="p-name">
		          {{ $survey->user->username }}
		        </td>
	          @endif
              <td>
                  {{ $survey->questions->count() }}
              </td>
	          <td>
	          	{{ $track_survey->lat }} , {{ $track_survey->lon }}
	          	{{-- {{ Utils::getAddressFromCoordinates($track_survey->lat, $track_survey->lon) }} --}}
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
