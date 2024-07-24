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
                                <i class="fa fa-plus"></i> &nbsp;Materials Request List from Inventory
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
                                            <th>Date</th>
                                            <th>Warehouse Name</th>
                                            <th>Material Name</th>
                                            <th>Brand Name</th>
                                            <th>Raw Material Name</th>
                                            <th>Unit Type</th>
                                            <th>Qty</th>
                                            <th>Select Vendor</th>
                                            <th>Order</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($reqMaterial->sortByDesc('created_at') as $index => $material)

                                        <tr>
                                            <form action="{{ route('storeOrder') }}" method="POST">
                                                @csrf
                                            <td>{{$loop->iteration}}</td>
                                            <input type="hidden" name="materials[{{$index}}][add_material_id]" value="{{$material->id}}">

                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][date]" value="{{$material->date}}">
                                                {{$material->date}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][warehouse_id]" value="{{$material->warehouse_id}}">
                                                {{$material->warehouse_name->warehouse_name ?? ''}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][material_id]" value="{{$material->material_id}}">
                                                {{$material->material_name->material}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][brand_id]" value="{{$material->brand_id}}">
                                                {{$material->brand_name->brand}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][raw_material_id]" value="{{$material->raw_material_id}}">
                                                {{$material->raw_material_name->raw_material_name}}
                                            </td>

                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][material_unit_id]" value="{{$material->material_unit_id}}">
                                                {{$material->unit_type->unit_type}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="materials[{{$index}}][quantity]" value="{{$material->quantity}}">
                                                {{$material->quantity}}
                                            </td>
                                            <td>
                                                <select class="form-control select" data-live-search="true" name="materials[{{$index}}][vendor_id]">
                                                    <option value="">--Select--</option>
                                                    @foreach ($vendor as $vend)
                                                    <option value="{{$vend->id}}">{{$vend->vendor_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                                    <i class="fa fa-shopping-cart"></i>Order
                                                </button>
                                            </td>
                                        </form>

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

@stop
@section('js')
@stop
