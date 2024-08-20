@extends('layout.header')
@section('content')

    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                <div class="panel-body" style="padding:1px 5px 2px 5px;">


                    <div class="col-md-12" style="margin-top:5px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Add Role
                            </h5>

                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{route('app-user-role-store')}}" method="post">
                        @csrf
                        <div class="col-md-12" style="margin-top: 10px; margin-left:500px; margin-bottom:20px" >
                            <div class="d-flex justify-content-center">
                                <div class="col-md-2 d-flex flex-column align-items-center">
                                    <label class="control-label">Add Role<font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" name="role" placeholder="" required />
                                </div>
                            </div>


                        </div>

{{-- --------------------------------------------------------------------------------------------------------- --}}

                        <hr>
                        <div class="col-md-12" style="margin-top: 5px;margin-bottom: 20px;">
                            {{-- <img src="{{ asset('public/img/line.png') }}" width="100%" /> --}}
                        </div>

                        <div class="row g-2" style="margin-left: 10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px"> Home
                                    :</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="transfer-material-button"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Transfer Material</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="workplace-button"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Workplace</label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="inventory-button"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Inventory Button</label>
                                </div>
                            </div>

                            </div>

                        </div>
                        <hr>

                        <div class="row g-2" style="margin-top: 20px; margin-left:10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Workplace:
                                    </label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_all_consumed_material"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">All Consumed Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_add_consumed_material"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Consumed Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_add_workplace"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Workplace</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_task"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Task</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_work"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Work</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_weightage"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Task Weightage</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_task_issues"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Add Issues / Photos</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="wp_complete_task"
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Complete Task</label>
                                </div>
                            </div>

                        </div>
                    </div>
                {{-- </div> --}}
                        <hr>







                    {{-- </form> --}}

                    {{-- apppended supervisor data end --}}
   <div class="col-md-2" style="margin-top:20px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-file"></i>Submit</button>

                            </div>
                        </form>
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-bars"></i> &nbsp;Added Roles
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
                                        <th>Role Name</th>
                                        {{-- <th>Assigned Role</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role->sortByDesc('created_at') as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->role ?? 'N/A' }}</td>
                                        {{-- <td>{{ is_array($role->permission) ? implode(', ', $role->permission) : ($role->permission ?? 'N/A') }}</td> --}}

                                        <td>

                                          {{-- <a href="{{route('panel-user-roles-edit', $role->id)}}">
                                            <button
                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button>
                                                </a> --}}
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
    <script>
        $(document).ready(function() {


            // Toggle password visibility
            $('.toggle-password').click(function() {
                var input = $(this).closest('.input-group').find('input');
                var icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });




            $(".add-row-purchase").click(function() {
                var acc_holder_name = $('#acc_holder_name').val();
                var bank = $('#bank').val();
                var ac_n = $('#ac_n').val();
                var ifsc_code = $('#ifsc').val();

                // Check if any of the fields are empty
                if (acc_holder_name === '' || bank === '' || ac_n === '' || ifsc_code === '') {
                    // If any field is empty, show a message
                    alert('Please fill all the fields before appending.');
                } else {
                    // If all fields are filled, proceed with appending
                    var markup =
                        '<tr>' +
                        '<td>' +
                        '<input type="hidden" name="acc_holder_name[]" required="" style="border:none; width: 100%;" value="' +
                        acc_holder_name + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + acc_holder_name +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="hidden" name="bank[]" required="" style="border:none; width: 100%;" value="' +
                        bank + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + bank +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="hidden" name="ac_n[]" required="" style="border:none; width: 100%;" value="' +
                        ac_n + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + ac_n +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="ifsc[]" required="" style="border:none; width: 100%;" value="' +
                        ifsc_code + '">' +
                        '</td>' +
                        '<td style="text-align:center; color:#FF0000">' +
                        '<button class="delete-row"><i class="fa fa-trash-o"></i></button>' +
                        '</td>' +
                        '</tr>';

                    $(".add_more_purchase").append(markup);

                    // Clear the input fields
                    $('#acc_holder_name').val('');
                    $('#bank').val('');
                    $('#ac_n').val('');
                    $('#ifsc').val('');
                }
            });

            $("tbody").delegate(".delete-row", "click", function() {
                $(this).parents("tr").remove();
            });
        });
    </script>
@stop
