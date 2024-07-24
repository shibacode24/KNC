@extends('layout.header')
@section('content')
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="row">
                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-plus"></i> &nbsp;GRN Management
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                            <div class="col-md-12" style="margin-top:5px;">
                                <div class="tabs">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#tab8" data-toggle="tab">Pending</a></li>
                                        <li><a href="#tab9" data-toggle="tab">Completed</a></li>
                                    </ul>
                                    <div class="panel-body tab-content">
                                        <div class="tab-pane active" id="tab8">
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Order Date</th>
                                                        <th>Order ID</th>
                                                        <th>Warehouse Name</th>
                                                        <th>Material Name</th>
                                                        <th>Brand Name</th>
                                                        <th>Unit Type</th>
                                                        <th>Raw Material</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order as $order)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$order->date}}</td>
                                                        <td>{{$order->order_id}}</td>
                                                        <td>{{$order->warehouse_name->warehouse_name ?? null}}</td>
                                                        <td>{{$order->material_name->material ?? null}}</td>
                                                        <td>{{$order->brand_name->brand ?? null}}</td>
                                                        <td>{{$order->unit_type->unit_type ?? null }}</td>
                                                        <td>{{$order->raw_material_name->raw_material_name ?? null }}</td>
                                                        <td>
                                                            <button data-bs-toggle="modal" data-bs-target="#grn-view-modal"
                                                                style="background-color: #1abc3d; border: none; max-height: 25px; margin-top: -5px; margin-bottom: -5px;"
                                                                type="button" class="btn btn-info grnview"
                                                                data-entry_id="{{ $order->id }}" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <i class="fa fa-eye" style="margin-left: 5px;"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab9">
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Order Date</th>
                                                        <th>Order ID</th>
                                                        <th>Warehouse Name</th>
                                                        <th>Material Name</th>
                                                        <th>Brand Name</th>
                                                        <th>Unit Type</th>
                                                        <th>Raw Material</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($completeOrder as $completeOrder)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$completeOrder->date}}</td>
                                                        <td>{{$completeOrder->order_id}}</td>
                                                        <td>{{$completeOrder->warehouse_name->warehouse_name ?? null}}</td>
                                                        <td>{{$completeOrder->material_name->material ?? null}}</td>
                                                        <td>{{$completeOrder->brand_name->brand ?? null}}</td>
                                                        <td>{{$completeOrder->unit_type->unit_type ?? null }}</td>
                                                        <td>{{$completeOrder->raw_material_name->raw_material_name ?? null }}</td>
                                                        {{-- <td>
                                                            <button data-bs-toggle="modal" data-bs-target="#grn-view-modal"
                                                                style="background-color: #1abc3d; border: none; max-height: 25px; margin-top: -5px; margin-bottom: -5px;"
                                                                type="button" class="btn btn-info grnview"
                                                                data-entry_id="{{ $completeOrder->id }}" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <i class="fa fa-eye" style="margin-left: 5px;"></i>
                                                            </button>
                                                        </td> --}}
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top:15px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="grn-view-modal" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="H4">Additional Details</h4>
            </div>
            <div class="modal-body" id="appendbodygrnview">
                <!-- Your content here -->
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).off('click', '.grnview').on('click', '.grnview', function() {
        $("#grn-view-modal").modal({
            backdrop: "static",
            keyboard: false,
        });

        var entry_id = $(this).data('entry_id');
        $("#material_req_list_id").val(entry_id);
        $("#appendbodygrnview").empty();

        $.ajax({
            url: '{{ url('viewgrn') }}',
            type: 'get',
            data: {
                entry_id: entry_id
            },
            dataType: 'json',
            success: function(data) {
                $("#appendbodygrnview").html(data.html);
            }
        });
    });

    $('#grn-view-modal').on('hidden.bs.modal', function() {
        $("#appendbodygrnview").empty();
        location.reload();
    });
</script>
@stop
