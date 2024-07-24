@extends('layout.header')
@section( 'content' )


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
                                <i class="fa fa-plus"></i> &nbsp;Material Order List
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
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Unit Type</th>
                                        <th>Qty</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orderDetails->sortByDesc('created_at') as $orderDetails)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$orderDetails->order_id}}</td>

                                        <td>{{$orderDetails->date}}</td>
                                        <td>{{$orderDetails->material_name->material}}</td>
                                        <td>{{$orderDetails->brand_name->brand}}</td>
                                        <td>{{$orderDetails->unit_type->unit_type}}</td>
                                        <td>{{$orderDetails->quantity}}</td>

                                        <td>{{$orderDetails->vendor_name->vendor_name ?? ''}}</td>
 									<td style="font-weight: bold; color: {{ $orderDetails->status == 'Completed' ? 'green' : 'red' }}">
                                            {{ $orderDetails->status }}
                                        </td>
                                        <td>
                                            <button
                                                style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="View"><i class="fa fa-eye"
                                                    style="margin-left:5px;"></i></button>


                                             <button data-toggle="modal" data-target="#popup1" data-order-id="{{ $orderDetails->id }}"
    style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
    type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Add"
    {{ $orderDetails->status == 'Completed' ? '' : 'disabled' }}>
    <i class="fa fa-plus" style="margin-left:5px;"></i>
</button>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                        <div class="col-md-12" style="margin-top:15px; margin-bottom:35px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    &nbsp;Added Material
                                </h5>



                            </div>
                        </div>
                          <!-- START DEFAULT DATATABLE -->

                          <div style="margin-top: 20px"></div>
                        <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                        <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                            <table class="table datatable">
                                <thead>


                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Unit Type</th>
                                        <th>Qty</th>
                                        <th>Vendor</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice</th>
                                        {{-- <th>Status</th> --}}
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order->sortByDesc('created_at') as $orderDetails)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$orderDetails->order_id}}</td>

                                        <td>{{$orderDetails->date}}</td>
                                        <td>{{$orderDetails->material_name->material}}</td>
                                        <td>{{$orderDetails->brand_name->brand}}</td>
                                        <td>{{$orderDetails->unit_type->unit_type}}</td>
                                        <td>{{$orderDetails->quantity}}</td>

                                        <td>{{$orderDetails->vendor_name->vendor_name}}</td>
                                        <td>{{$orderDetails->invoice_date}}</td>
                                        <td>{{$orderDetails->invoice_number}}</td>
                                        <td>
                                            <a href="{{ asset('public/images/invoice/' . $orderDetails->invoice) }}" target="_blank">
                                                <img height="50px" width="50px" src="{{ asset('public/images/invoice/' . $orderDetails->invoice) }}" alt="Invoice Image" />
                                            </a>
                                        </td>

                                        {{-- <td><span style="color: red;font-weight: bold;">Pending</span></td> --}}

                                        {{-- <td>
                                            <button
                                                style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="View"><i class="fa fa-eye"
                                                    style="margin-left:5px;"></i></button>


                                          <button data-toggle="modal" data-target="#popup1" data-order-id="{{ $orderDetails->id }}"
    style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
    type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Add"
    {{ $orderDetails->status == 'Completed' ? '' : 'disabled' }}>
    <i class="fa fa-plus" style="margin-left:5px;"></i>
</button>

                                        </td> --}}
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
<!-- END PAGE CONTAINER -->
<div class="modal" id="popup1" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="H4">Material Request List</h4>
            </div>
            <div class="modal-body" style="height:30%">
                <div class="col-md-12">
                    <h3>Order
                    </h3>
                    <form action="{{route('add-invoice')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" id="order_id">

                    <div class="col-md-2">
                        <label>Date<font color="#FF0000">*</font></label>
                           <input type="date" class="form-control" name="invoice_date" id="invoice_date" placeholder="">
                    </div>
                    <div class="col-md-3" style="padding-left: 10px;">
                        <label class="control-label"> Invoice Number<font color="#FF0000">*</font></label>
                        <input type="text" class="form-control" name="invoice_number" placeholder="" />
                    </div>
                    <div class="col-md-3" style="padding-left: 10px;">
                        <label class="control-label">Add Invoice <font color="#FF0000">*</font></label>
                        <input type="file" class="form-control" name="invoice" placeholder="" />
                    </div>
                    <div class="col-md-2" style="margin-top:17px;padding-left: 15px;">
                        <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                            <i class="fa fa-file"></i>Submit</button>

                    </div>

                </form>

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
    $(document).ready(function () {
        // Set the current date for the date input in the modal
        function setCurrentDate() {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var currentDate = today.getFullYear() + "-" + (month) + "-" + (day);
            $('#invoice_date').val(currentDate);
        }

        $('#popup1').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var orderId = button.data('order-id'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('#order_id').val(orderId);
            setCurrentDate(); // Set the current date when the modal is shown
        });
    });
</script>
@stop

