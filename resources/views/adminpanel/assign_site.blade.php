@extends('layout.header')
@section('content')

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;" align="center">
                            <i class="fa fa-users"></i> &nbsp;Allocate Site
                        </h5>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('assign_site.store') }}" method="post">
                        @csrf
                        <div class="col-md-2"></div>
                        <div class="col-md-2" style="margin-right: -40px;">
                            <label>Date<font color="#FF0000">*</font></label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="date" value="" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Site</label>
                            <select class="form-control select" data-live-search="true" name="site">
                                @foreach($site as $site)
                                <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Select Role</label>
                            <select class="form-control select" data-live-search="true" name="role" id="role">
                                <option value="">--Select--</option>
                                {{-- @foreach($role as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach --}}
                                <option value="site-manager">Site Manager</option>
                                <option value="site-incharge">Site Incharge</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Engineer">Engineer</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Assign To</label>
                            <select class="form-control select2" data-live-search="true" name="assign_to[]" id="assign_to" multiple>
                                <option value="">--Select--</option>
                                @foreach($user as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;" align="left">
                            <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i>Add</button>
                        </div>
                    </form>
                </div>

                <!-- Table and other content -->

                <div class="row">
                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-plus"></i> &nbsp;Added Branch
                            </h5>



                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top:15px;"></div>
                    <div class="col-md-8" style="margin-top:15px;">

                        <!-- START DEFAULT DATATABLE -->

                        <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                        <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Date</th>
                                        <th>Assign Site</th>
                                        <th>Role</th>
                                        <th>Assign To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignSite as $assignSite)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>


                                            <td>{{ $assignSite->date }}</td>
                                            <td>{{$assignSite->site_name->site_name ?? ''}}</td>
                                            <td>{{$assignSite->role_name->role ?? ''}}</td>
                                            {{-- <td>{{$assignSite->user_id}}</td> --}}
                                            <td>
                                                @php
                                                    // Handle cases where user_id is a comma-separated string or an array
                                                    $userIds = is_string($assignSite->user_id) ? explode(',', $assignSite->user_id) : (array) $assignSite->user_id;
                                                @endphp

                                                @if (!empty($userIds))
                                                    @foreach ($userIds as $userId)
                                                        @php
                                                            $user = App\Models\User::find(trim($userId));
                                                        @endphp
                                                        {{ $user->name ?? '' }}@if (!$loop->last), @endif
                                                    @endforeach
                                                @else
                                                    No user assigned
                                                @endif
                                            </td>
                                            {{-- <td>{{ is_array($assignSite->user_id) ? implode(', ', $assignSite->user_id) : ($assignSite->user_id ?? 'N/A') }}</td> --}}
                                            {{-- <td>
                                                @if (is_array($assignSite->user_id))
                                                    @foreach ($assignSite->username as $user)
                                                        {{ $user->name ?? ''}}@if (!$loop->last), @endif
                                                    @endforeach
                                                @else
                                                    {{ $assignSite->username->name ?? 'N/A' }}
                                                @endif
                                            </td> --}}
                                            <td>

                                                <a href="{{ route('assign-site-edit', $assignSite->id) }}"><button
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

@stop
@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let dateInput = document.querySelector('input[name="date"]');
        let today = new Date().toISOString().split('T')[0];
        dateInput.value = today;

        // Initialize select2
        $('.select2').select2();

        // Clear dropdown initially
        $('#assign_to').empty().append('<option value="">--Select--</option>').select2();

        // Event listener for role change
        $('#role').change(function() {
            let roleId = $(this).val();
            if (roleId) {
                $.ajax({
                    url: '{{ route("get-users-by-role") }}',
                    type: 'GET',
                    data: { role_id: roleId },
                    success: function(data) {
                        $('#assign_to').empty();
                        $.each(data, function(key, value) {
                            // Skip admin user
                            if (value.name !== 'admin') {
                                $('#assign_to').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                        });
                        $('#assign_to').select2();
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
