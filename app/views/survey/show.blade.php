@extends('layouts.default')

@section('content')
@include('includes.alert')
<!-- page start-->
<section class="panel">
	<header class="panel-heading">
		Survey Details
		<div class="pull-right">
			<a data-toggle="modal" href="#createModal" class="btn btn-success btn-xs">
		        <i class="fa fa-plus-square"></i> Create 
		    </a>
			<a data-toggle="modal" href="#renameModal" data-survey-id= "{{ $survey->id }}" data-survey-title="{{ $survey->title }}" class="btn btn-info btn-xs">
			    <i class="fa fa-pencil"></i> Rename 
			</a>
		    <a data-toggle="modal" href="#deleteConfModal" data-survey-id="{{ $survey->id }}" class="btn btn-danger btn-xs">
		        <i class="fa fa-trash-o"></i> Delete 
		    </a>
		</div>
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
								<div class="pull-right">
									<a data-toggle="modal" href="#" onclick="showUpdQ('{{ $question->type }}')" class="btn sr-btn btn-xs">
					                    <i class="fa fa-pencil"></i> 
					                </a>
									<a data-toggle="modal" href="#deleteQuesConfModal" data-question-id="{{ $question->id }}" class="btn sr-btn btn-xs">
										<i class="fa fa-trash-o"></i> 
									</a>
								</div>
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
					</div>
					<?php $iter++; ?>
					@endforeach
					
				</div>
			</div> {{-- panel body end --}}
		</section>

	</div>
	
	{{-- Add question --}}
	<div class="col-md-4 add-question">
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
						 		{{ Form::text('choice0', '', ['class'=>'form-control', 'placeholder'=>'Enter a choice']) }}
								{{ Form::button('-', ['class'=>'remove-field btn btn-danger']) }}
							</div>
						</div>
				 	</div>
				 </div>

	         <input type="hidden" name="surveyIdH" value="{{ $survey->id }}">
			 <input type="hidden" id="count" value="" name="count">
			
             {{ Form::submit('Add Question', array('class' => 'btn btn-success pull-right')) }}
	     	{{ Form::close() }}
          </div> {{-- panel end --}}

      </section>
    </div>


	{{-- Update Question --}}
    <div class="col-md-4 update-question" style="display:none">
      <section class="panel">
          <header class="panel-heading">
              Edit Question
              {{ Form::button('Back', ['class'=>'btn btn-danger btn-xs pull-right', 'onclick'=>'showAddQ()']) }}
          </header>

          <div class="panel-body">

			  	{{ Form::open(['route' => ['updateQuestion'], 'method' => 'post', 'class' => 'form']) }}

			 	 <div class="form-group">
					{{ Form::label('Question Body', '',['class'=>'control-label']) }}
					<div>
						{{ Form::text('questionBody', '', ['class'=>'form-control', 'placeholder'=>'Enter question body']) }}
					</div>
				 </div>

				 <div class="form-group multi-field-wrapper-update">
				 	<div class="form-group form-inline">
					 	{{ Form::label('Choices', '', ['class'=>'control-label']) }}
					 	{{ Form::button('+', ['class'=>'add-field btn btn-success pull-right']) }}
				 	</div>
				 	<div class="form-group">				 	
						<div class="multi-fields form-inline">
							<div class="multi-field input-append">
						 		{{ Form::text('choice0', '', ['class'=>'form-control', 'placeholder'=>'Enter a choice']) }}
								{{ Form::button('-', ['class'=>'remove-field btn btn-danger']) }}
							</div>
						</div>
				 	</div>
				 </div>

	         <input type="hidden" name="questionId" value="">
			 <input type="hidden" id="count" value="" name="count">
			
             {{ Form::submit('Update Question', array('class' => 'btn btn-success pull-right')) }}
	     	{{ Form::close() }}
          </div> {{-- panel end --}}

      </section>
    </div>
	
</div>
<!-- page end-->
{{-- Modals --}}
{{--Question delete confirmation modal --}}
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

{{-- Survey delete confirmation modal --}}
{{ Form::open(array('route' => ['destroySurvey'], 'method' => 'post', 'class' => 'form')) }}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="deleteConfModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Delete Survey</h4>
             </div>
             <div class="modal-body">
                 <p>Are you sure you want to delete the survey?</p>
                 {{-- <input type="text" name="surveyTitle" value="" autocomplete="off" class="form-control placeholder-no-fix"> --}}
                 <input type="hidden" name="surveyId" value="">
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
{{-- Survey rename modal --}}
{{ Form::open(array('route' => ['renameSurvey'], 'method' => 'post', 'class' => 'form-signin')) }}

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="renameModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Rename Survey</h4>
             </div>
             <div class="modal-body">
                 <p>Enter new title for the survey below</p>
                 <input type="text" name="surveyTitle" value="" autocomplete="off" class="form-control placeholder-no-fix">
                 <input type="hidden" name="surveyId" value="">
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

		$(document).ready(function(){

			// $('.update-question').hide();

			$('.radio-list').on('change', function() {
		   
			   var quesType = ($('input[name="questionTypeRadio"]:checked', '.radio-list').val());
			   // alert(quesType);
			   if(quesType == "mcq"){
			   		$('.multi-field-wrapper').fadeIn("slow", function(){
			   			$(this).show();
			   		});	
			   }
			   if(quesType == "written"){
			   		$('.multi-field-wrapper').fadeOut("normal", function(){
			   			$(this).hide();
			   		});	
			   }
			});

		});

	</script>

	<script type="text/javascript">
		$('.multi-field-wrapper').each(function() {
		    
		    var $wrapper = $('.multi-fields', this);

		    $(".add-field", $(this)).click(function(e) {
		    	
		    	var $field =$('.multi-fields').find('input[name^="choice"]:last');
		    	// alert(parseInt( $field.prop("name").match(/\d+/g), 10 ));
		    	var num = parseInt( $field.prop("name").match(/\d+/g), 10 ) +1;
		    	// alert(num);
		    	$('.multi-field:first-child', $wrapper).fadeIn("normal", function(){

		    		$(this).clone(true).appendTo($wrapper).find('input').prop('name', 'choice'+num).val('').focus();	    	
		    	});

		        document.getElementById('count').value = num;
		    });
		    
		    $('.multi-field .remove-field', $wrapper).click(function() {
		    
		        if ($('.multi-field', $wrapper).length > 1)
		    
		            $(this).parent('.multi-field').fadeOut("normal", function(){
		            	$(this).remove();
		            });
		    
		    });
		
		});

		$('.multi-field-wrapper-update').each(function() {
		    
		    var $wrapper = $('.multi-fields', this);

		    $(".add-field", $(this)).click(function(e) {
		    	
		    	var $field =$('.multi-fields').find('input[name^="choice"]:last');
		    	// alert(parseInt( $field.prop("name").match(/\d+/g), 10 ));
		    	var num = parseInt( $field.prop("name").match(/\d+/g), 10 ) +1;
		    	// alert(num);
		    	$('.multi-field:first-child', $wrapper).fadeIn("normal", function(){

		    		$(this).clone(true).appendTo($wrapper).find('input').prop('name', 'choice'+num).val('').focus();	    	
		    	});

		        document.getElementById('count').value = num;
		    });
		    
		    $('.multi-field .remove-field', $wrapper).click(function() {
		    
		        if ($('.multi-field', $wrapper).length > 1)
		    
		            $(this).parent('.multi-field').fadeOut("normal", function(){
		            	$(this).remove();
		            });
		    
		    });
		
		});
	</script>

	<script type="text/javascript">
		$('#deleteQuesConfModal').on("show.bs.modal", function(e) {
    
           var questionId = $(e.relatedTarget).data('question-id');
    
           $(e.currentTarget).find('input[name="questionId"]').val(questionId);

        });
	</script>

	<script type="text/javascript">

        $('#renameModal').on("show.bs.modal", function(e) {
            var surveyId = $(e.relatedTarget).data('survey-id');

            var surveyTitle = $(e.relatedTarget).data('survey-title');

            $(e.currentTarget).find('input[name="surveyId"]').val(surveyId);

            $(e.currentTarget).find('input[name="surveyTitle"]').val(surveyTitle);

        });

  
    
        $('#deleteConfModal').on("show.bs.modal", function(e) {
    
           var surveyId = $(e.relatedTarget).data('survey-id');
    
           $(e.currentTarget).find('input[name="surveyId"]').val(surveyId);

        });
    </script>
	
    <script type="text/javascript">
		
		function showUpdQ(questionType){

			$('.add-question').fadeOut("normal", function(){
				$(this).hide();
			});

			$('.update-question').fadeIn("normal", function(){
				$(this).show();
				$(this).find('input[name="questionBody"]').focus();
			});

			if(questionType == 'mcq'){

			}else if(questionType == 'written'){

				$('.multi-field-wrapper-update').hide();
			}
		}

		function showAddQ(){
			if($('.update-question').is(":visible")){

				$('.update-question').fadeOut("normal", function(){
					$(this).hide();
				});

				$('.add-question').fadeIn("normal", function(){
					$(this).show();
				});

			}
		}

    </script>
	
@stop