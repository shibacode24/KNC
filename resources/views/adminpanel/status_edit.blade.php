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
                                <i class="fa fa-plus"></i> &nbsp;Add Status
                            </h5>

                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('status-update') }}" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{$statusEdit->id}}">
                            <div class="col-md-4"></div>

                            <div class="col-md-2">
                                <label class="control-label">Add Status<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="status" placeholder="" value="{{$statusEdit->status}}" required />
                            </div>
                            <div class="col-md-2" style="margin-top:15px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Update</button>

                            </div>
                        </form>
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
