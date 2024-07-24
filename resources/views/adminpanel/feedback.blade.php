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
                            <i class="fa fa-edit"></i> &nbsp;Feedback
                        </h5>



                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">

                    <div class="col-md-2">
                        <label>Date<font color="#FF0000">*</font></label>
                        <div class="input-group">
                            <input type="hidden" id="dp-3" class="form-control datepicker" value="01-05-2020"
                                data-date="01-05-2020" data-date-format="dd-mm-yyyy" data-date-viewmode="years" />
                        </div>

                        <div class="input-group">
                            <input type="text" id="dp-3" class="form-control " value="10-10-2020" data-date="01-05-2020"
                                data-date-format="dd-mm-yyyy" data-date-viewmode="years" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>Select Vendor</label>
                        <select class="form-control select" data-live-search="true">
                            <option>Sharique Sheikh</option>
                            <option>Ashwini </option>
                            <option>Pratik Mohod</option>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label"> Order ID<font color="#FF0000">*</font></label>
                        <input type="text" class="form-control" name="name" placeholder="" />
                    </div>
                    <div class="col-md-4" style="margin-top: 5px;">
                        <label class="control-label"> Remark<font color="#FF0000">*</font></label>
                        <textarea type="text" class="form-control" name="name" rows="2" cols="8"></textarea>
                    </div>
                    <div class="col-md-2" style="margin-top:25px;" align="left">
                        <button id="on" type="button" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                            <i class="fa fa-file"></i>Submit</button>

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-edit"></i> &nbsp;Manage Feedback
                            </h5>



                        </div>

                        <div class="col-md-12" style="margin-top:15px;">

                            <!-- START DEFAULT DATATABLE -->

                            <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                            <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Date</th>
                                            <th>Vendor</th>
                                            <th>Order ID</th>
                                            <th>Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>23-12-2025</td>
                                            <td>Ashwini</td>
                                            <td>97987</td>
                                            <td>Test</td>
                                            <td>

                                                <button
                                                    style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                    type="button" class="btn btn-info" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"><i class="fa fa-edit"
                                                        style="margin-left:5px;"></i></button>
                                                <button
                                                    style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                    type="button" class="btn btn-info" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash-o"
                                                        style="margin-left:5px;"></i></button>
                                            </td>
                                        </tr>


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
@stop
