@extends('layouts.default')

@section('content')
@include('includes.alert')
<!-- page start-->
<section class="panel">
	<header class="panel-heading">
		Survey Answers
	</header>
</section>
<div class="row">
	<div class="col-md-8">
		<section class="panel">
			<div class="bio-graph-heading project-heading">
				<h2>  {{ $survey->title }}  </h2>
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
						<p><span class="bold">Questions </span>: {{ $survey->questions->count() }}</p>
					</div>
					<div class="bio-row">
						<p><span class="bold">Last Updated</span>: {{ $survey->getSurveyUpdatedDate() }}</p>
					</div> 
					<div class="bio-row">
						<p><span class="bold">Completed by</span>: {{ TrackSurvey::where('surveys_id', $survey->id)->count() }}</p>
					</div> 
					<div class="bio-row">
						<p><span class="bold">Questions Answered</span>: {{ $QA_count }}</p>
					</div>
				</div>

			</div>

		</section>

		<section class="panel">
			<header class="panel-heading">
				Questions & Answers
			</header>
			<div class="panel-body">
				<div class="panel-group" id="accordion1">
					<?php $iter=1; ?>
					@foreach ($survey->questions as $question)
					<div class="panel panel-default form-group">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a href="#accordion1_{{ $iter }}" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle">
									{{ $iter }}. {{ $question->body }}
								</a>
							</h4>
						</div>
						<div class="{{ Utils::getAccordianClass($question->type) }}" id="{{ Utils::getAccordianId($question->type, $iter) }}">
							@if($question->type == 'mcq')
								<div class="col-lg-offset-1" id="labels">
									<?php $i=1; ?>
									@foreach ($question->choices as $choice)
									<label>
										{{ $i }}. 
									</label>
									<label>
										{{ $choice->choice }}
									</label><br>
									<?php $i++; ?>
									@endforeach
								</div>
							@elseif($question->type == 'written')

							@endif
						</div>
						<div id="answer" class="room-desk">
							<h5 class="pull-left"><strong>Answers :</strong> </h5>
							<?php 
								$answers = Answer::where('questions_id', $question->id)->get();
							 ?>
							 @if ($answers->isEmpty())
							 	{{-- {{ 'No answers given by guests!' }}<br> --}}
							 	<div class="room-box">
	                              <h5 class="text-primary">No answers given by guests yet !</h5>
	                              {{-- <p>No answers given by guests yet</p> --}}
						 		</div>
							 @elseif($answers)
							 	@foreach ($answers as $answer)
							 		{{-- {{ $answer->body }} <small>by {{ GuestUser::find($answer->users_id)->email }}</small><br> --}}
							 		<div class="room-box">
		                              <h5 class="text-primary"><a href="{{ URL::route('showGuestSurvey', GuestUser::find($answer->users_id)->id) }}">{{ GuestUser::find($answer->users_id)->email }}</a></h5>
		                              <p>{{ $answer->body }}</p>
		                              <?php 
		                              	$info = TrackSurvey::where('users_id', $answer->users_id)->first();
		                               ?>
		                              <p><span class="text-muted">Answered at :</span> {{ $info->created_at }} | <span class="text-muted">Location :</span> {{ $info->lat }}, {{ $info->lon }}</p>
							 		</div>
							 	@endforeach
							 @endif
						</div>
					</div>
					<?php $iter++; ?>
					@endforeach
					
				</div>
			</div> 
		</section>

	</div>
	
</div>
<!-- page end-->
@stop

