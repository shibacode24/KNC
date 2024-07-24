@extends('layout.header')
@section( 'content' )

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <div class="panel-body" style="padding:1px 5px 2px 5px;">

            @if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title"
                            style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                            align="center">
                            <i class="fa fa-bars"></i> &nbsp;Material Request From Site
                        </h5>



                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                        <table class="table datatable">
                            <thead>
                                <tr>


                                    <th>Sr. No.</th>
                                    <th>Date</th>
                                    <th>Request ID</th>
                                    <th>Site Name</th>

                                    <th>Supervisor Name</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    @foreach ($requestedMaterial as $requestedMaterial)

                                    <td>{{$loop->iteration}}</td>

                                    <td>{{$requestedMaterial->created_at->format('d/m/Y')}}</td>
                                    <td>{{$requestedMaterial->id}}</td>
                                    <td>{{$requestedMaterial->site_name->site_name}}</td>
                                    <td>{{$requestedMaterial->supervisor_name->supervisor_name}}</td>

                                    <td>
                                        <button class="btn btn-info view-details" data-toggle="modal" data-target="#popup1"
                                            style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                            data-placement="top" title="View"><i class="fa fa-eye"
                                                style="margin-left:5px;"></i></button>

                                    </td>

                                    @endforeach
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Issued/Remaining Material Manage
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
                                        <th>Request ID </th>
                                        <th>Site Name</th>
                                        <th>Material Name </th>
                                        <th>Brand Name </th>
                                        <th>Material Qty </th>
                                        <th>Material Unit </th>
                                        <th>Issue Material </th>
                                        <th>Remaining Material </th>
                                        <th>Remark</th>

                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>1</td>

                                        <td>1234</td>
                                        <td>Nagpur</td>
                                        <td>Cement</td>
                                        <td>Ambuja</td>
                                        <td>100 </td>
                                        <td>Bags</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>material</td>
                                        <td><span style="color: red;font-weight: bold;">Pending</span></td>

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
<div class="modal" id="popup1" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="H4">Additional Details</h4>
            </div>
            <div class="modal-body" style="height:30%">
                <div class="col-md-12" style="overflow-x: scroll;">
                    <table width="100%" border="1">
                        <tr style="background-color:#f0f0f0; height:30px;">
                            <th width="3%" style="text-align:center">Sr.No.</th>
                            <th width="5%" style="text-align:center">Material Name </th>
                            <th width="5%" style="text-align:center">Brand Name </th>
                            <th width="5%" style="text-align:center">Material Qty </th>
                            <th width="5%" style="text-align:center">Material Unit </th>
                            <th width="10%" style="text-align:center">Select WareHouse </th>
                            <th width="5%" style="text-align:center">Available Material </th>
                            <th width="5%" style="text-align:center">Issue Material </th>
                            <th width="5%" style="text-align:center">Remaining Material </th>
                            <th width="15%" style="text-align:center">Remark</th>

                            <th width="4%" style="text-align:center">Action</th>
                        </tr>


                        <tr>
                            <td style="padding:5px;" align="center">
                                <label>1</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>Cement</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>Ultratech</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>100</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>1</label>
                            </td>
                            <td style="padding:5px;" align="center">

                                <select class="form-control select" data-live-search="true">
                                    <option>WareHouse 1</option>
                                    <option>WareHouse 2</option>
                                    <option>WareHouse 3</option>

                                </select>

                            </td>
                            <td style="padding:5px;" align="center">
                                <label>400</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>80</label>
                            </td>
                            <td style="padding:5px;" align="center">
                                <label>20</label>
                            </td>

                            <td style="padding:5px;" align="center">
                                <textarea type="text" class="form-control" name="name" rows="2" cols="4"></textarea>
                            </td>

                            <td style="text-align:center;">
                                <button id="on" type="button" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;"> Submit</button>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="modal-footer" style="border: none !important; background-color: #FFF !important;">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')


<script>
    $(document).on('click', '.serviceareaview', function() { $("#service-area-view").modal({

        backdrop: "static",
        keyboard: false,
        });
        var entry_id = $(this).attr('id');
        $("#appendbodyserviceareaview").empty();
        $.ajax({
        url: 'viewservicearea',
        type: 'get',
        data: {
        entry_id: entry_id

        },
        dataType: 'json',
        success: function(data) {
        $("#appendbodyserviceareaview").html(data.html);
        }
        });
        });
</script>
@stop
