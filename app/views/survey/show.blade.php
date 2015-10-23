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
				{{-- <a data-toggle="modal" href="#createQuestionModal" class=" btn btn-success btn-xs pull-right">Add questions</a> --}}
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

	<div class="col-md-4">
      <section class="panel">
          <header class="panel-heading">
              Add Question
          </header>

          <div class="panel-body">
			  {{ Form::open(['route' => ['renameSurvey'], 'method' => 'post', 'class' => '']) }}

              <div class="form">

			 	 <div class="form-group">
					{{ Form::label('Question Body', '',['class'=>'control-label']) }}
					<div class= "">
						{{ Form::text('questionBody', '', ['class'=>'form-control', 'placeholder'=>'Enter question body']) }}
					</div>
				 </div>

				 <div class="form-group">
					{{ Form::label('Question Type', '', ['class'=>'control-label']) }}
					<div class="">
						<div class="radio-list">
							<div class="radio">
								{{ Form::radio('questionTypeRadio', 'mcq', 'true') }}
								{{ Form::label('MCQ') }}
							</div>
							<div class="radio">
								{{ Form::radio('questionTypeRadio', 'written', '') }}
								{{ Form::label('Written') }}
							</div>
						</div>
					</div>
				 </div>
				 
				 <div class="form-group">
				 	{{ Form::label('Choices', '', ['class'=>'control-label']) }}
				 	<div>
				 		{{ Form::text('choice', '', ['class'=>'form-control', 'placeholder'=>'Enter a choice']) }}
				 	</div>
				 </div>

			 </div>

	         <input type="hidden" name="questionTypeHidden" value="">
             {{-- {{ Form::submit('ADD', array('class' => 'btn btn-success')) }} --}}
	     {{ Form::close() }}
          </div> {{-- panel end --}}

      </section>
  </div>
	
</div>
<!-- page end-->

{{-- Modals --}}

{{-- create question modal --}}

{{ Form::open(array('route' => ['renameSurvey'], 'method' => 'post', 'class' => 'form-signin')) }}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="createQuestionModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Create Question</h4>
             </div>
             <div class="modal-body">
	                 
				 <div class="form">

				 	 <div class="form-group">
						{{ Form::label('Question Body', '',['class'=>'col-lg-4 control-label']) }}
						<div class= "col-lg-8">
							{{ Form::text('questionBody', '', ['class'=>'form-control', 'placeholder'=>'Enter question body']) }}
						</div>
					 </div>

					 <div class="form-group">
						{{ Form::label('Question Type', '', ['class'=>'col-lg-4 control-label']) }}
						<div class="col-lg-8">
							<div class="radio-list">
								<div class="radio">
									{{ Form::radio('questionTypeRadio', 'mcq', 'true') }}
									{{ Form::label('MCQ') }}
								</div>
								<div class="radio">
									{{ Form::radio('questionTypeRadio', 'written', '') }}
									{{ Form::label('Written') }}
								</div>
							</div>
						</div>
					 </div>
				
					 <div class="form-group">
						<div>
							{{ Form::label('Choices', '', ['class'=>'col-lg-4 control-label']) }}
							<a href="#" class="btn"> Add choices</a>
						</div>
						{{-- <div class="col-lg-8">
							{{ Form::password('password', ['class'=>'form-control']) }}
						</div> --}}
					 </div>
				
				
				 </div>

                 <input type="hidden" name="questionTypeHidden" value="">
             
             </div>
             <div class="modal-footer">
                 <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                 {{ Form::submit('Rename', array('class' => 'btn btn-success')) }}
                <!--  <button class="btn btn-success" type="button">Submit</button> -->
             </div>
         </div>
     </div>
    </div>

{{ Form::close() }}


@stop

@section('script')

	<script type="text/javascript">
	
		$('#radio-list input').on('change', function() {
		   var quesType = ($('input[name="questionTypeRadio"]:checked', '#radio-list').val()); 
		});
	
	</script>

@stop