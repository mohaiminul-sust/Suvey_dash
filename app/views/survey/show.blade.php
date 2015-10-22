@extends('layouts.default')

@section('content')
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
                                      <p><span class="bold">Questions </span>: {{ $survey->questions->count() }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Last Updated</span>: {{ $survey->getSurveyUpdatedDate() }}</p>
                                  </div>
                                 
                                  
                              </div>

                          </div>

                      </section>

                      <section class="panel">
                        <header class="panel-heading">
                          Questions
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
				                              	<div class="col-lg-offset-1">
				                              		<?php $i=1; ?>
				                              		@foreach ($question->choices as $choice)
					                              		<label>
					                              			{{ $i }}. {{ $choice->choice }}
	                                          	  		</label><br>
	                                          	  		<?php $i++; ?>
					                              	@endforeach
				                              	</div>
				                              @elseif($question->type == 'written')

											  @endif
				                          </div>
				                    </div>
				                    <?php $iter++; ?>
		                      	@endforeach
			                    
		                    </div>
                        </div> {{-- panel body end --}}
                      </section>

                  </div>
                  
              </div>
              <!-- page end-->
@stop