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
                            <i class="fa fa-university"></i> &nbsp;Add Warehouse
                        </h5>



                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('warehouse-update') }}" method="post">
                        @csrf
                        <!-- <div class="col-md-4"></div>
                                            -->

                        <input type="hidden" name="id" value="{{$warehouseEdit->id}}">
                        <div class="col-md-2">
                            <label class="control-label">Warehouse Name<font color="#FF0000">*</font></label>

                            <input type="text" class="form-control" name="warehouse_name" placeholder="" value="{{$warehouseEdit->warehouse_name}}" required />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Incharge Name<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="incharge_name" placeholder="" value="{{$warehouseEdit->incharge_name}}" required />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Incharge Contact<font color="#FF0000">*</font></label>
                            <input type="text" maxlength="10" class="form-control" name="incharge_contact"
                                placeholder=""  value="{{$warehouseEdit->incharge_contact}}" required />
                        </div>
                        <div class="col-md-2">
                            <label>City</label>
                            <select class="form-control select" data-live-search="true" name="city_id">
                                @foreach($city as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $warehouseEdit->city_id ? 'selected' : '' }}>{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Latitude<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="latitude" placeholder="" value="{{$warehouseEdit->latitude}}" required />
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">Longitude<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="longitude" placeholder="" value="{{$warehouseEdit->longitude}}" required />
                        </div>

                        <div class="col-md-12" style="margin-top:15px;" >
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
