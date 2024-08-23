@extends('layout.header')
@section('content')

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title"
                            style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                            align="center">
                            <i class="fa fa-plus"></i> &nbsp;Add User
                        </h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('panelUser.store') }}" method="post">
                        @csrf
                        <div class="col-md-2">
                            <label>Select</label>
                            <select class="form-control select" data-live-search="true" name="person" id="person">
                                <option value="">--Select--</option>
                                <option value="available_material"> Available Material</option>
                                <option value="consumed_material"> Consumed Material</option>
                                <option value="lost_material">Lost Material</option>
                            </select>
                        </div>
                        <div class="col-md-2" id="supervisorField">
                            <label>Select Supervisor</label>
                            <select class="form-control select" data-live-search="true" name="supervisor_id" id="supervisor">
                                @foreach ($supervisor as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" id="employeeField">
                            <label>Select Employee</label>
                            <select class="form-control select" data-live-search="true" name="employee" id="employee">
                                @foreach ($employee as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" id="nameField">
                            <label class="control-label">Name<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="name" placeholder=""  />
                        </div>
                        <div class="col-md-2" id="contactField">
                            <label class="control-label">Mobile<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="contact" placeholder=""  />
                        </div>
                        <div class="col-md-2" id="emailField">
                            <label class="control-label">Email Id<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="email" placeholder=""  />
                        </div>
                        <div class="col-md-2" id="passwordField">
                            <label class="control-label">Password<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="password" placeholder=""  />
                        </div>
                        <div class="col-md-2" id="roleField">
                            <label>Select Role</label>
                            <select class="form-control select" data-live-search="true" name="role_id">
                                @foreach ($role as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top:20px;" align="left">
                            <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i>Add
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-plus"></i> &nbsp;Added User
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">

                        <!-- START DEFAULT DATATABLE -->

                        <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                        <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                            <table class="table datatable">
                                <thead>

                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Selected Role</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email Id</th>
                                        <th>User Role</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($supervisor_data->sortByDesc('created_at')  as $supervisor)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$supervisor->role}}</td>


                                        @if(strtolower($supervisor->role) == 'supervisor')
                                        <td>{{ $supervisor->name ?? Null }}</td>
                                        <td>{{ $supervisor->contact ?? Null}}</td>
                                        <td>{{ $supervisor->email ?? Null }}</td>

                                    @elseif(strtolower($supervisor->role) == 'employee')
                                        <td>{{ $supervisor->name ?? '' }}</td>
                                        <td>{{ $supervisor->contact ?? '' }}</td>
                                        <td>{{ $supervisor->email ?? ''}}</td>
                                    @elseif($supervisor->role == 'Other')
                                        <td>{{ $supervisor->name ?? ''}}</td>
                                        <td>{{ $supervisor->contact ?? ''}}</td>
                                        <td>{{ $supervisor->email ?? ''}}</td>

                                    @else
                                        <td>N/A</td> <!-- Fallback in case role is not recognized -->
                                    @endif

                                    <td>{{$supervisor->role_name->role}}</td>
                                      <td>
                                        <a href=""><button
                                            style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"
                                                style="margin-left:5px;"></i></button></a>
                                      </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <!-- END DEFAULT DATATABLE -->


                    </div>
                    <div class="col-md-2" style="margin-top:15px;"></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

@stop
@section('js')
<script>
    $(document).ready(function() {
        // Function to toggle visibility based on selected person
        function toggleFields() {
            var selectedPerson = $('#person').val();
            if (selectedPerson === 'Supervisor') {
                $('#supervisorField').show();
                $('#employeeField').hide();
                $('#nameField').hide();
                $('#contactField').hide();
                $('#emailField').hide();
                $('#passwordField').hide();
                // $('#roleField').show();
            } else if (selectedPerson === 'Employee') {
                $('#supervisorField').hide();
                $('#employeeField').show();
                $('#nameField').hide();
                $('#contactField').hide();
                $('#emailField').hide();
                $('#passwordField').hide();
                // $('#roleField').show();
            } else if (selectedPerson === 'Other') {
                $('#supervisorField').hide();
                $('#employeeField').hide();
                $('#nameField').show();
                $('#contactField').show();
                $('#emailField').show();
                $('#passwordField').show();
                // $('#roleField').show();
            } else {
                $('#supervisorField').hide();
                $('#employeeField').hide();
                $('#nameField').hide();
                $('#contactField').hide();
                $('#emailField').hide();
                $('#passwordField').hide();
                // $('#roleField').hide();
            }
        }

        // Initial call to hide fields
        toggleFields();

        // Event listener for change event on person dropdown
        $('#person').change(function() {
            toggleFields();
        });
    });
</script>
@stop
