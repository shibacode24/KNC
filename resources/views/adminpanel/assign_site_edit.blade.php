@extends('layout.header')
@section( 'content' )

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <div class="panel-body" style="padding:1px 5px 2px 5px;">


                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title"
                            style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                            align="center">
                            <i class="fa fa-users"></i> &nbsp;Allocate Task
                        </h5>



                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('assign-site-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$assignSiteEdit->id}}"/>

                        <div class="col-md-2"></div>
                        <div class="col-md-2" style="margin-right: -40px;">
                            <label>Date<font color="#FF0000">*</font></label>
                            <div class="input-group">
                                <input type="date" class="form-control " name="date" value="{{$assignSiteEdit->date}}" required />
                            </div>


                        </div>
                        <div class="col-md-2">
                            <label>Site</label>
                            <select class="form-control select" data-live-search="true" name="site">
                                @foreach($site as $site)
                                <option value="{{ $site->id }}"
                                    {{ old('site', $assignSiteEdit->site_assign) == $site->id ? 'selected' : '' }}>
                                    {{ $site->site_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Select Role</label>
                            <select class="form-control select" data-live-search="true" name="role" id="role">
                                @foreach($role as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role', $assignSiteEdit->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-2">
                            <label>Assign To</label>
                            <select class="form-control select2" data-live-search="true" name="assign_to[]" id="assign_to" multiple>
                                {{-- The options will be populated by JavaScript --}}
                            </select>
                        </div>

                        <div class="col-md-2" style="margin-top:15px;" align="left">
                            <button id="on" type="submit" class="btn mjks"
                                style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i>Add</button>

                        </div>
                    </form>
                </div>
                <div class="row">

                    {{-- <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-users"></i> &nbsp;Manage Unit Type
                            </h5>



                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>


</div>

</div>


<!-- START DEFAULT DATATABLE -->


</div>



</div>

<!-- PAGE CONTENT WRAPPER -->


</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize select2
        $('.select2').select2();

        // Populate the Assign To dropdown with previously saved values
        var initialValues = @json($assignSiteEdit->user_id ?? []);

        // Function to update the dropdown with values
        function updateDropdown(users) {
            $('#assign_to').empty().append('<option value="">--Select--</option>');
            $.each(users, function(key, value) {
                // Skip admin user
                if (value.name !== 'admin') {
                    $('#assign_to').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                }
            });
            // Reapply previously saved values
            $('#assign_to').val(initialValues).trigger('change');
        }

        // Load the initial values if any
        updateDropdown(@json($user)); // Use the initial list of users

        // Event listener for role change
        $('#role').change(function() {
            let roleId = $(this).val();
            if (roleId) {
                $.ajax({
                    url: '{{ route("get-users-by-role") }}',
                    type: 'GET',
                    data: { role_id: roleId },
                    success: function(data) {
                        updateDropdown(data); // Update dropdown with users based on selected role
                    }
                });
            } else {
                // Clear dropdown if no role is selected
                $('#assign_to').empty().append('<option value="">--Select--</option>').select2();
            }
        });
    });
</script>
@stop


