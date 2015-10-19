@extends('layouts.default')

@section('content')
	@include('includes.alert')

	<!-- page start-->
	<section class="panel">
	  <header class="panel-heading">
	      Surveys
	      <span class="pull-right">
	          <a href="#" class=" btn btn-success btn-xs"> Create New Surveys</a>
	      </span>
	  </header>
	  {{-- <div class="panel-body">
	      <div class="row">

	          <div class="col-md-12">
	              <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
	              <button type="button" class="btn btn-sm btn-success"> GO!</button> </span></div>
	          </div>
	      </div>
	  </div> --}}
	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Survey Name</th>
	          <th></th>
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($surveys as $survey)
	      	<tr>
	          <td class="p-name">
	              <a href="#">{{ $survey->title }}</a>
	              <br>
	              <small>Created {{ $survey->getSurveyCreatedDate() }} Updated {{ $survey->getSurveyUpdatedDate() }}</small>
	          </td>
	          <td>
	              {{-- <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> --}}
	              <a data-toggle="modal" href="#myModal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Rename </a>
	              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->

    <!--  Modal -->

    {{ Form::open(array('route' => ['renameSurvey', $survey->id], 'method' => 'post', 'class' => 'form-signin')) }}

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Rename Survey</h4>
                 </div>
                 <div class="modal-body">
                     <p>Enter new title for the survey below</p>
                     <input type="text" name="survey_title" placeholder="" autocomplete="off" class="form-control placeholder-no-fix">
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