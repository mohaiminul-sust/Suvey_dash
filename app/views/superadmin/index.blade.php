@extends('layouts.default')

@section('content')
	@include('includes.alert')

	<!-- page start-->
	<section class="panel">
	  <header class="panel-heading">
	      Manage Admins
	      <span class="pull-right">
	          <a href="#" class=" btn btn-success btn-xs"> Create New Admin</a>
	      </span>
	  </header>

	  <table class="table table-hover p-table">
	      <thead>
	      <tr>
	          <th>Username</th>
	          <th>Surveys Created</th>
	          <th></th> {{-- controls --}}
	      </tr>
	      </thead>
	      <tbody>
	      @foreach ($admins as $admin)
	      	<tr>
	          <td class="p-name">
	              <a href="#">{{ $admin->username }}</a>
	              <br>
	              <small>Created {{ $admin->getAdminCreatedDate() }} Updated {{ $admin->getAdminUpdatedDate() }}</small>
	          </td>
	          <td class="p-team">
	          	  <span>{{ $admin->getSurveyCount() }}</span>
	          </td>
	          <td>
	              {{-- <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> --}}
	              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
	              <a data-toggle="modal" href="#deleteConfModal" data-admin-id="{{ $admin->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
	          </td>
	        </tr>
	      @endforeach
	      </tbody>
	  </table>
	</section>
	<!-- page end-->

    <!--  Modals -->
	
    {{-- delete confirmation modal --}}
	{{ Form::open(array('route' => ['destroyAdmin'], 'method' => 'post', 'class' => 'form-signin')) }}

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
@stop

@section('script')
	<script type="text/javascript">

		$('#deleteConfModal').on("show.bs.modal", function(e) {
			var adminId = $(e.relatedTarget).data('admin-id');
			$(e.currentTarget).find('input[name="adminId"]').val(adminId);
		});

	</script>
@stop