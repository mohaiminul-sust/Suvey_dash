@extends('layouts.default')
@section('style')
	{{ HTML::style('css/jquery.steps.css') }}
@stop
@section('content')
	@include('includes.alert')

	<!-- page start-->
	<div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  New Survey Wizard
              </header>
              <div class="panel-body">
              	<div class="stepy-tab"><ul id="default-titles" class="stepy-titles clearfix"><li id="default-title-0" class="current-step"><div>Step1</div><span> </span></li><li id="default-title-1" class=""><div>Step 2</div><span> </span></li><li id="default-title-2" class=""><div>Step 3</div><span> </span></li></ul></div>
                  <form class="form-horizontal" id="default">
                      <fieldset title="Step1" class="step" id="default-step-0" style="display: block;">
                          <legend> </legend>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Survey Title</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" placeholder="Enter Survey Title">
                              </div>
                          </div>
                          {{-- <div class="form-group">
                              <label class="col-lg-2 control-label">Email Address</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" placeholder="Email Address">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">User Name</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" placeholder="Username">
                              </div>
                          </div> --}}

                     {{--  <p id="default-buttons-0" class="default-buttons"><a id="default-next-0" href="javascript:void(0);" class="button-next  btn btn-info">Next</a></p> --}}</fieldset>
                      <fieldset title="Step 2" class="step" id="default-step-1" style="display: none;">
                          <legend> </legend>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Phone</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" placeholder="Phone">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Mobile</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" placeholder="Mobile">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Address</label>
                              <div class="col-lg-10">
                                  <textarea class="form-control" cols="60" rows="5"></textarea>
                              </div>
                          </div>

                      {{-- <p id="default-buttons-1" class="default-buttons"><a id="default-back-1" href="javascript:void(0);" class="button-back btn btn-info">Previous</a><a id="default-next-1" href="javascript:void(0);" class="button-next  btn btn-info">Next</a></p> --}}</fieldset>
                      <fieldset title="Step 3" class="step" id="default-step-2" style="display: none;">
                          <legend> </legend>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Full Name</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">Tawseef Ahmed</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Email Address</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">tawseef@vectorlab.com</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">User Name</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">tawseef</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Phone</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">01234567</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Mobile</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">01234567</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Address</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static">
                                      Dreamland Ave, Suite 73
                                      AU, PC 1361
                                      P: (123) 456-7891 </p>
                              </div>
                          </div>
                      <p id="default-buttons-2" class="default-buttons">{{-- <a id="default-back-2" href="javascript:void(0);" class="button-back btn btn-info">Previous</a> --}}<input type="submit" class="finish btn btn-danger" value="Finish"></p></fieldset>
                      
                  </form>
              </div>
          </section>
      </div>
  </div>
	<!-- page end-->

@stop

@section('script')
	{{ HTML::script('js/jquery.steps.min.js') }}
	{{ HTML::script('js/jquery.stepy.js') }}
	
	<script type="text/javascript">

      //step wizard

		$(function() {
			$('#default').stepy({
			  backLabel: 'Previous',
			  block: true,
			  nextLabel: 'Next',
			  titleClick: true,
			  titleTarget: '.stepy-tab'
			});
		});
  
	</script>

@stop