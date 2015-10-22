@extends('layouts.default')

@section('content')
	@include('includes.alert')
	<section class="panel">
	  <header class="panel-heading">
	      Manage Surveys
	      <span class="pull-right">
	          <a href="#" class=" btn btn-success btn-xs"> Create New Survey</a>
	      </span>
	  </header>
	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Survey Name</th>
	          @if ($user_type != 'admin')
	          	<th>Created By</th>
	          @endif
	          <th>Customize</th>
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($surveys as $survey)
	      	<tr>
	          <td class="p-name">
	              <a href="{{ URL::route('showSurvey', $survey->id) }}">{{ $survey->title }}</a>
	              <br>
	              <small>Created {{ $survey->getSurveyCreatedDate() }} Updated {{ $survey->getSurveyUpdatedDate() }}</small>
	          </td>
	          @if ($user_type != 'admin')
	          	<td class="p-name">
		          {{ $survey->user->username }}
		        </td>
	          @endif
	          <td>
	              {{-- <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> --}}
	              <a data-toggle="modal" href="#renameModal" data-survey-id= "{{ $survey->id }}" data-survey-title="{{ $survey->title }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Rename </a>
	              <a data-toggle="modal" href="#deleteConfModal" data-survey-id="{{ $survey->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->

    <!--  Modals -->
	
	{{-- rename modal --}}
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

    {{-- delete confirmation modal --}}
	{{ Form::open(array('route' => ['destroySurvey'], 'method' => 'post', 'class' => 'form-signin')) }}

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
@stop

@section('script')
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
@stop