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
	  <div class="panel-body">
	      <div class="row">

	          <div class="col-md-12">
	              <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
	              <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
	          </div>
	      </div>
	  </div>
	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Survey Name</th>
	          <th>Custom</th>
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
	              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
	              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
	              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->
@stop