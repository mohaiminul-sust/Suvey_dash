@extends('layouts.default')

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
								<a data-toggle="modal" href="#deleteQuesConfModal" data-question-id="{{ $question->id }}" class="btn sr-btn btn-xs pull-right">
									<i class="fa fa-trash-o"></i> 
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
			  {{ Form::open(['route' => ['createQuestion'], 'method' => 'post', 'class' => 'form']) }}

			 	 <div class="form-group">
					{{ Form::label('Question Body', '',['class'=>'control-label']) }}
					<div>
						{{ Form::text('questionBody', '', ['class'=>'form-control', 'placeholder'=>'Enter question body']) }}
					</div>
				 </div>

				 <div class="form-group">
					{{ Form::label('Question Type', '', ['class'=>'control-label']) }}
					<div>
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
				 
				 <div class="form-group multi-field-wrapper">
				 	<div class="form-group form-inline">
					 	{{ Form::label('Choices', '', ['class'=>'control-label']) }}
					 	{{ Form::button('+', ['class'=>'add-field btn btn-success pull-right']) }}
				 	</div>
				 	<div class="form-group">				 	
						<div class="multi-fields form-inline">
							<div class="multi-field input-append">
						 		{{ Form::text('choices[]', '', ['class'=>'form-control sr-input', 'placeholder'=>'Enter a choice']) }}
								{{ Form::button('-', ['class'=>'remove-field btn btn-danger']) }}
							</div>
						</div>
				 	</div>
				 </div>

			 

	         <input type="hidden" name="surveyIdH" value="{{ $survey->id }}">

             {{ Form::submit('Add Question', array('class' => 'btn btn-success pull-right')) }}
	     {{ Form::close() }}
          </div> {{-- panel end --}}

      </section>
  </div>
	
</div>
<!-- page end-->
{{-- Modals --}}
{{-- delete confirmation modal --}}
{{ Form::open(['route' => ['destroyQuestion'], 'method' => 'post', 'class' => 'form-signin']) }}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="deleteQuesConfModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Delete Question</h4>
             </div>
             <div class="modal-body">
                 <p>Are you sure you want to delete the question ?</p>
                 {{-- <input type="text" name="surveyTitle" value="" autocomplete="off" class="form-control placeholder-no-fix"> --}}
                 <input type="hidden" name="questionId" value="">
             </div>
             <div class="modal-footer">
                 <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                 {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
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
		   // $('.panel-body').find('input[name="questionTypeH"]').val(quesType);
		});
	
	</script>

	<script type="text/javascript">
		$('.multi-field-wrapper').each(function() {
		    var $wrapper = $('.multi-fields', this);
		    $(".add-field", $(this)).click(function(e) {
		        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
		    });
		    $('.multi-field .remove-field', $wrapper).click(function() {
		        if ($('.multi-field', $wrapper).length > 1)
		            $(this).parent('.multi-field').remove();
		    });
		});
	</script>

	<script type="text/javascript">
		$('#deleteQuesConfModal').on("show.bs.modal", function(e) {
    
           var questionId = $(e.relatedTarget).data('question-id');
    
           $(e.currentTarget).find('input[name="questionId"]').val(questionId);

        });
	</script>

@stop