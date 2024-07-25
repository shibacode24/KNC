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
                        <form action="{{ route('rawmaterial.store') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div> -->

                              <div class="col-md-2">
                                <label>Select</label>
                                <select class="form-control select" data-live-search="true" name="person"
                                    id="material">
                                    <option value="">--Select--</option>
                                  <option value="Supervisor"> Supervisor</option>
                                  <option value="Employee"> Employee</option>
                                  <option value="Other"> Other</option>

                                </select>
                            </div>
                               <div class="col-md-2">
                                <label>Select Supervisor</label>
                                <select class="form-control select" data-live-search="true" name="supervisor"
                                    id="supervisor">
                                    @foreach ($supervisor as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->supervisor_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <select class="form-control select" data-live-search="true" name="brand" id="brand"> --}}
                                    {{-- Options will be dynamically added here --}}
                                {{-- </select> --}}
                            </div>

                            <div class="col-md-2">
                                <label>Select Employee</label>
                                <select class="form-control select" data-live-search="true" name="employee"
                                    id="employee">
                                    @foreach ($employee as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="name" placeholder=""
                                    required />
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Mobile<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="contact" placeholder=""
                                    required />
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Email Id<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="email" placeholder=""
                                    required />
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Password<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="password" placeholder=""
                                    required />
                            </div>

                            <div class="col-md-2">
                                <label>Select Role</label>
                                <select class="form-control select" data-live-search="true" name="role_id">
                                    @foreach ($role as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-2" style="margin-top:20px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Add</button>

                            </div>
                        </form>
                    </div>
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-plus"></i> &nbsp;Added Raw Materials

                                </h5>



                            </div>
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

</script>

@stop
