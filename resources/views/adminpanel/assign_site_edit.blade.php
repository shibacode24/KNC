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
                            <select class="form-control select" data-live-search="true" name="site_id">
                                @foreach($site as $site)
                                <option value="{{ $site->id }}"
                                    {{ old('site', $assignSiteEdit->site_assign) == $site->id ? 'selected' : '' }}>
                                    {{ $site->site_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Assign Supervisor</label>
                            <select class="form-control select" data-live-search="true" name="supervisor_id">
                                @foreach($supervisor as $supervisor)
                                <option value="{{ $supervisor->user_id }}"
                                   {{old('supervisor_id', $assignSiteEdit->supervisor) == $supervisor->id ? 'selected' : ''}} >
                                    {{ $supervisor->supervisor_name }}</option>
                                @endforeach
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
@stop
