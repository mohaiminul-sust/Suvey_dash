@extends('layouts.default')

@section('content')
  @include('includes.alert')
  <section class="panel">
    <header class="panel-heading">
        Guests
        <span class="pull-right">
            <a href="{{ URL::route('guests') }}" class=" btn btn-success btn-xs">
                <i class="fa fa-refresh"></i> Refresh
            </a>
        </span>
    </header>
    <table class="table table-hover p-table">
        <thead>
        <tr>
            <th>Guest email</th>
            @if (Auth::user()->role->type == "super_admin")
                <th>Survey taken</th>
            @endif
            <th>Customize</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($guests as $guest)
          <tr>
            <td class="p-name">
                <a href="#">{{ $guest->email }}</a>
                <br>
                <small>Joined {{ $guest->getGuestCreatedDate() }}</small>
            </td>
            @if (Auth::user()->role->type == "super_admin")
                <td>
                    {{ $guest->getSurveyTakenCount($guest->id) }}
                </td>
            @endif
            <td>
                <a href="#" class="btn btn-primary btn-xs">
                    <i class="fa fa-folder"></i> View 
                </a>
                <a data-toggle="modal" href="#deleteGuestConfModal" data-guest-id="{{ $guest->id }}" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash-o"></i> Delete 
                </a>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </section>
  <!-- page end-->

    {{-- delete confirmation modal --}}
    {{ Form::open(array('route' => ['destroyGuest'], 'method' => 'post', 'class' => 'form-signin')) }}

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="deleteGuestConfModal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Delete Guest</h4>
                 </div>
                 <div class="modal-body">
                     <p>Are you sure you want to delete the survey?</p>
                     <input type="hidden" name="guestId" value="">
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
   
        $('#deleteGuestConfModal').on("show.bs.modal", function(e) {
    
           var guestId = $(e.relatedTarget).data('guest-id');
    
           $(e.currentTarget).find('input[name="guestId"]').val(guestId);

        });
    </script>

@stop