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
                    <form action="{{ route('appUser.store') }}" method="post">
                        @csrf
                        <div class="col-md-2">
                            <label>Select</label>
                            <select class="form-control select" data-live-search="true" name="person" id="person">
                                <option value="">--Select--</option>
                                <option value="Site-Manager"> Site Manager</option>
                                <option value="Site-Incharge"> Site Incharge</option>
                                <option value="Supervisor"> Supervisor</option>
                                <option value="Engineer"> Engineer</option>
                                <option value="Other"> Other</option>
                            </select>
                        </div>
                        <div class="col-md-2" id="siteManagerField">
                            <label>Select Site Manager</label>
                            <select class="form-control select" data-live-search="true" name="siteManager" id="siteManager">
                                @foreach ($siteManager as $siteManager)
                                    <option value="{{ $siteManager->id }}">{{ $siteManager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" id="siteInchargeField">
                            <label>Select Site Incharge</label>
                            <select class="form-control select" data-live-search="true" name="siteIncharge" id="siteIncharge">
                                @foreach ($siteIncharge as $siteIncharge)
                                    <option value="{{ $siteIncharge->id }}">{{ $siteIncharge->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2" id="supervisorField">
                            <label>Select Supervisor</label>
                            <select class="form-control select" data-live-search="true" name="supervisor" id="supervisor">
                                @foreach ($supervisor as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" id="engineerField">
                            <label>Select Engineer</label>
                            <select class="form-control select" data-live-search="true" name="engineer" id="engineer">
                                @foreach ($engineer as $engineer)
                                    <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
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
                                    @foreach ($user_data->sortByDesc('created_at') as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->role }}</td>

                                        @if($user->role == 'Site-Manager')
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->contact ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                        @elseif($user->role == 'Site-Incharge')
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->contact ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                        @elseif($user->role == 'Supervisor')
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->contact ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                        @elseif($user->role == 'Engineer')
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->contact ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                        @elseif($user->role == 'Other')
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->contact ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                        @else
                                            <td>N/A</td> <!-- Fallback in case role is not recognized -->
                                        @endif

                                        <td>{{ $user->app_role_name->role ?? 'N/A' }}</td>
                                        <td>
                                            <a href="#"><button
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

            // Hide all fields initially
            $('#siteManagerField, #siteInchargeField, #supervisorField, #engineerField').hide();
            $('#nameField, #contactField, #emailField, #passwordField').hide();

            // Show the relevant fields based on selection
            if (selectedPerson === 'Site-Manager') {
                $('#siteManagerField').show();
            } else if (selectedPerson === 'Site-Incharge') {
                $('#siteInchargeField').show();
            } else if (selectedPerson === 'Supervisor') {
                $('#supervisorField').show();
            } else if (selectedPerson === 'Engineer') {
                $('#engineerField').show();
            } else if (selectedPerson === 'Other') {
                $('#nameField, #contactField, #emailField, #passwordField').show();
            }
        }

        // Initial call to set up visibility
        toggleFields();

        // Event listener for change event on person dropdown
        $('#person').change(function() {
            toggleFields();
        });
    });
</script>

@stop
