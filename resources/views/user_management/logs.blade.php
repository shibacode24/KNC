@extends('layout.header')

@section('title', 'Map')

@section('styles')
    <style>
        #map {
            height: 500px;
            width: 100%; /* Ensure the map takes full width */
        }
    </style>
@endsection

@section('content')
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;" align="center">
                            <i class="fa fa-plus"></i> &nbsp;Find User Logs
                        </h5>
                    </div>
                </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="" method="get">
                            @csrf
                            <div class="col-md-2">
                                <label class="control-label">Select Role<font color="#FF0000">*</font></label>
                                <select id="role" name="role_id" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Select Employee<font color="#FF0000">*</font></label>
                                <select id="employeeSelect" name="emp_id" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach ($emp as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="col-md-2">
                            <label class="control-label">From Date<font color="#FF0000">*</font></label>
                            <input type="date" class="form-control" name="from_date" placeholder="" required />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">To Date<font color="#FF0000">*</font></label>
                            <input type="date" class="form-control" name="to_date" placeholder="" required />
                        </div>
                        <div class="col-md-2" style="margin-top:15px; margin-bottom:20px" align="left">
                            <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i> Search
                            </button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>
</div>

{{-- <div id="map"></div> --}}
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('#role').on('change', function () {
            var roleId = $(this).val();

            if (roleId) {
                $.ajax({
                    url: '{{ route("filter.employees.by.role") }}',
                    type: 'GET',
                    data: { role_id: roleId },
                    success: function (data) {
                        $('#employeeSelect').empty();
                        $('#employeeSelect').append('<option value="">--Select--</option>');
                        $.each(data, function (key, employee) {
                            $('#employeeSelect').append('<option value="' + employee.id + '">' + employee.name + '</option>');
                        });
                    }
                });
            } else {
                $('#employeeSelect').empty();
                $('#employeeSelect').append('<option value="">--Select--</option>');
            }
        });
    });
</script>


@endsection
