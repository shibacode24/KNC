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
                                        {{-- <th>Request ID</th> --}}
                                        <th>Site Name</th>

                                        <th>Supervisor Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($requestedMaterial as $groupKey => $materials)
                                        @php
                                            $firstMaterial = $materials->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $firstMaterial->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $firstMaterial->site_name->site_name }}</td>
                                            <td>{{ $firstMaterial->supervisor_name->supervisor_name ?? '' }}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#service-area-view"
                                                    style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                    type="button" class="btn btn-info serviceareaview"
                                                    data-date="{{ $firstMaterial->created_at->format('Y-m-d') }}"
                                                    data-site_id="{{ $firstMaterial->site_id }}" data-toggle="tooltip"
                                                    data-placement="top" title="View">
                                                    <i class="fa fa-eye" style="margin-left:5px;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach


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
                                            <th>Requested Date</th>
                                            <th>Site Name</th>
                                            <th>Request ID </th>
                                            <th>Material Name </th>
                                            <th>Brand Name </th>
                                            <th>Material Qty </th>
                                            {{-- <th>Material Unit </th> --}}
                                            <th>Warehouse </th>
                                            {{-- <th>Available Material</th> --}}
                                            <th>Issue Material </th>
                                            <th>Remaining Material </th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($issueMaterial as $material)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d-m-Y',strtotime($material->requested_material_date)) }}</td>
                                                <td>{{ $material->site_name->site_name ?? ''}}</td>
                                                <td>{{ $material->requested_material_id }}</td>
                                                <td>{{ $material->non_consumable_material_name->material ?? '' }}</td>
                                                <td>{{ $material->non_consumable_brand_name->brand ?? '' }}</td>
                                                <td>{{ $material->requested_material_quantity }}</td>
                                                {{-- <td>{{ $material->unit_type->unit_type }}</td> --}}
                                                <td>{{ $material->warehouse_name->warehouse_name ?? ''}}</td>
                                                {{-- <td>{{ $material->available_material }}</td> --}}
                                                <td>{{ $material->issue_material }}</td>
                                                <td>{{ $material->remaining_material }}</td>
                                                <td>
                                                    {{ $material->remark !== null && $material->remark !== '' ? $material->remark : 'No Remark' }}
                                                </td>

                                                <td>
                                                    <span style="color: red;font-weight: bold;">
                                                        {{ $material->inventory_status }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <button data-bs-toggle="modal" data-bs-target="#non_consumable_service-area-edit"
                                                    style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                    type="button" class="btn btn-info serviceareaedit"
                                                   data-toggle="tooltip" data-id="{{ $material->id }}"
                                                    data-placement="top" title="Edit">
                                                    <i class="fa fa-edit" style="margin-left:5px;"></i>
                                                </button>
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
    <div class="modal" id="non_consumable_service-area-edit" tabindex="-1" role="dialog" aria-labelledby="largeModalHead"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="H3">Additional Details</h4>
                </div>
                <div class="modal-body" id="appendbodyserviceareaview11">

                    <!-- Your content here -->

                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
    <div class="modal" id="service-area-view" tabindex="-1" role="dialog" aria-labelledby="largeModalHead"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="H4">Additional Details</h4>
                </div>
                <div class="modal-body" id="appendbodyserviceareaview">

                    <!-- Your content here -->

                </div>
            </div>
        </div>
    </div>

@stop
@section('js')

    <script>
        $(document).on('click', '.serviceareaview', function() {
            $("#service-area-view").modal({
                backdrop: "static",
                keyboard: false,
            });
            // var entry_id = $(this).attr('id');
            var date = $(this).data('date'); // Assuming you have a data attribute for date
            var site_id = $(this).data('site_id'); // Assuming you have a data attribute for site_id
            $("#appendbodyserviceareaview").empty();
            $.ajax({
                url: 'non_consumable_viewservicearea',
                type: 'get',
                data: {
                    // entry_id: entry_id
                    date: date,
                    site_id: site_id
                },
                dataType: 'json',
                success: function(data) {
                    $("#appendbodyserviceareaview").html(data.html);
                }
            });
        });


        $('#service-area-view').on('hidden.bs.modal', function() {
            location.reload();
        });
    </script>

<script>
    $(document).on('click', '.serviceareaedit', function() {
        console.log(1);
        $("#non_consumable_service-area-edit").modal({
            backdrop: "static",
            keyboard: false,
        });
        // var entry_id = $(this).attr('id');
        var id = $(this).data('id'); // Assuming you have a data attribute for date

        $("#appendbodyserviceareaview11").empty();
        $.ajax({
            url: 'non_consumable_viewservicearea_edit',
            type: 'get',
            data: {
                // entry_id: entry_id
                // date: date,
                id: id
            },
            dataType: 'json',
            success: function(data) {
                $("#appendbodyserviceareaview11").html(data.html);
            }
        });
    });


    $('#non_consumable_service-area-edit').on('hidden.bs.modal', function() {
        location.reload();
    });
</script>

@stop
