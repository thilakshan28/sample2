@if(Auth::user()->role->name != 'Admin')
{!! Form::text('name', 'Name') !!}
{!! Form::text('password', 'Password')->type('password') !!}
{!! Form::text('password_confirmation', 'Confirm Password')->type('password') !!}
<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You can edit only curtain fields</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@else
{!! Form::text('name', 'Name') !!}
{!! Form::text('email', 'E-Mail')->type('email') !!}
{!! Form::select('department', 'Department')->options([''=>'----Chhose Your Department----','Blog' => 'Blog','Education' =>'Education']) !!}
<div id="education" class="d-none" >
    {!! Form::select('role_id1', 'Choose Your Role')->options($roles2)!!}
</div>
<div id="blog" class="d-none" >
    {!! Form::select('role_id2', 'Choose Your Role')->options($roles1) !!}
</div>
{!! Form::text('password', 'Password')->type('password') !!}
{!! Form::text('password_confirmation', 'Confirm Password')->type('password') !!}
@endif


@section('js')
<script>
$(document).ready(function () {

    function roleChange(dep,val) {
        if (val != null){
            if (dep == 'Blog'){
                $('#blog').removeClass('d-none');
                $('#education').addClass('d-none');
                $("#inp-role_id2").val(val);
            }else{
                $('#education').removeClass('d-none');
                $('#blog').addClass('d-none');
                $("#inp-role_id1").val(val);
                }
        }else{
            if (dep == 'Blog'){
                $('#blog').removeClass('d-none');
                $('#education').addClass('d-none');

            }else{
                $('#education').removeClass('d-none');
                $('#blog').addClass('d-none');
                }
        }

    }
    $('#inp-department').change(function () {
        var val = this.value;
        roleChange(val);
    });

    @if(isset($user))
        var existingRoleId = "{{ $user->role_id }}";
        var existingDepartment = "{{ $user->department }}";
        roleChange(existingDepartment,existingRoleId);
    @endif

    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
});
</script>
@endsection
