@extends('layouts.default')

@section('content')
	@include('includes.alert')

	<!-- page start-->
	<section class="panel">
	  <header class="panel-heading">
	      Manage Admins
	      <span class="pull-right">
	          <a href="{{ URL::route('showCreateAdmin') }}" class=" btn btn-success btn-xs"> Create New Admin</a>
	      </span>
	  </header>
	  
	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Username</th>
	          <th>Surveys Created</th>
	          <th>Customize</th> {{-- controls --}}
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($admins as $admin)
	      	<tr>
	          <td class="p-name">
	              {{ $admin->username }}
	              <br>
	              <small>Created {{ $admin->getAdminCreatedDate() }} Updated {{ $admin->getAdminUpdatedDate() }}</small>
	          </td>
	          <td class="p-team">
	          	  <span>{{ $admin->getSurveyCount() }}</span>
	          </td>
	          <td>
	              {{-- <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> --}}
	              <a data-toggle="modal" href="#updateModal" data-admin-id="{{ $admin->id }}" data-admin-username="{{ $admin->username }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update </a>
	              <a data-toggle="modal" href="#deleteConfModal" data-admin-id="{{ $admin->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->

    <!--  Modals -->
	
    {{-- Delete Admin Confirmation Modal --}}

	{{ Form::open(['route' => 'destroyAdmin', 'method' => 'post', 'class' => 'form-signin']) }}

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="deleteConfModal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Delete Admin</h4>
                 </div>
                 <div class="modal-body">
                     <p>Are you sure you want to delete admin?</p>
                     <input type="hidden" name="adminId" value="">
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

    {{-- Update Admin modal --}}
    
    {{ Form::open(['route' => 'updateAdmin', 'method' => 'post', 'class' => 'form-horizontal tasi-form']) }}

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="updateModal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Update Admin Info</h4>
                 </div>
                 <div class="modal-body">
	                 
					 <div class="form">

					 	 <div class="form-group">
							{{ Form::label('Username', '',['class'=>'col-lg-4 control-label']) }}
							<div class= "col-lg-8">
								{{ Form::text('username', '', ['class'=>'form-control']) }}
							</div>
						 </div>

						 <div class="form-group">
							{{ Form::label('Old Password', '', ['class'=>'col-lg-4 control-label']) }}
							<div class="col-lg-8">
								{{ Form::password('oldpass', ['class'=>'form-control']) }}
							</div>
						 </div>
					
						 <div class="form-group">
							{{ Form::label('New Password', '', ['class'=>'col-lg-4 control-label']) }}
							<div class="col-lg-8">
								{{ Form::password('password', ['class'=>'form-control']) }}
							</div>
						 </div>
					
						 <div class="form-group">
							{{ Form::label('Confirm Password', '', ['class'=>'col-lg-4 control-label']) }}
							<div class="col-lg-8">
								{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
							</div>
						 </div>
					
					 </div>

                     <input type="hidden" name="adminId" value="">
                 
                 </div>
                 
                 <div class="modal-footer">
                     <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                     {{ Form::submit('Update', array('class' => 'btn btn-success')) }}
                    <!--  <button class="btn btn-success" type="button">Submit</button> -->
                 </div>
             </div>
         </div>
        </div>

    {{ Form::close() }}

@stop

@section('script')
	<script type="text/javascript">

		$('#deleteConfModal').on("show.bs.modal", function(e) {
			var adminId = $(e.relatedTarget).data('admin-id');
			$(e.currentTarget).find('input[name="adminId"]').val(adminId);
		});

		$('#updateModal').on("show.bs.modal", function(e) {
			var adminId = $(e.relatedTarget).data('admin-id');
			var adminUsername = $(e.relatedTarget).data('admin-username');
			$(e.currentTarget).find('input[name="adminId"]').val(adminId);
			$(e.currentTarget).find('input[name="username"]').val(adminUsername);
		});
	</script>
@stop