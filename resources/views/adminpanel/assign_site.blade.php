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
                                @foreach($role as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Assign To</label>
                            <select class="form-control select2" data-live-search="true" name="assign_to[]" id="assign_to" multiple>
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
                            $('#assign_to').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        $('#assign_to').select2();
                    }
                });
            } else {
                $('#assign_to').empty();
            }
        });
    });
</script>
@stop
