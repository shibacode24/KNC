@extends('layout.header')
@section( 'content' )

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">


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

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <div class="panel-body" style="padding:1px 5px 2px 5px;">


                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title"
                            style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                            align="center">
                            <i class="fa fa-plus"></i> &nbsp;Order Materials
                        </h5>
                    </div>
                </div>

                <form action="{{ route('update-direct-po-list') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$issueEdit->id}}">

                <div class="col-md-12" style="margin-top:10px;">
                    <!-- <div class="col-md-4"></div>
                                            -->
                    <div class="col-md-2" style="margin-left: 5px;">
                        <label class="control-label">Date<font color="#FF0000">*</font></label>
                       <input type="date" name="date" id="date" class="form-control" value="{{$issueEdit->date}}">
                    </div>

                    {{-- <div class="col-md-2" style="margin-left: 5px;">
                        <label class="control-label">Time<font color="#FF0000">*</font></label>
                       <input type="time" name="time" id="time" class="form-control" >
                    </div> --}}

                    <div class="col-md-2">
                        <label>Select Warehouse</label>
                        <select class="form-control select" data-live-search="true" name="warehouse" id="warehouse">
                          <option value="">--Select--</option>
                            @foreach ($warehouse as $warehouse)

                            <option value="{{ $warehouse->id }}" {{ old('warehouse', $issueEdit->warehouse_id) == $warehouse->id ? 'selected' : '' }}>{{$warehouse->warehouse_name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Select Materials</label>
                        <select class="form-control select" data-live-search="true" name="material" id="material">
                            <option value="">--Select--</option>
                            @foreach ($material as $material)
                            <option value="{{ $material->id }}" {{ old('material', $issueEdit->material_id) == $material->id ? 'selected' : '' }}>{{$material->material}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Select Brand</label>
                        <select class="form-control select" data-live-search="true" name="brand" id="brand">
                          <option value="">--Select--</option>
                            @foreach ($brand as $brand)

                            <option value="{{ $brand->id }}" {{ old('brand', $issueEdit->brand_id) == $brand->id ? 'selected' : '' }}>{{$brand->brand}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2"  style="margin-top: px">
                        <label>Select Raw Materials</label>
                        <select class="form-control select" data-live-search="true" name="raw_material" id="rawmaterial">
                            <option value="">--Select--</option>
                            @foreach ($rawmaterial as $raw_material)
                            <option value="{{ $raw_material->id }}" {{ old('raw_material', $issueEdit->raw_material_id) == $raw_material->id ? 'selected' : '' }}>{{$raw_material->raw_material_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2" style="margin-top: 15px">
                        <label>Select Unit</label>
                        <select class="form-control select" data-live-search="true" name="unit_type">
                           @foreach ($unit as $unit)
                           <option value="{{$unit->id}}" {{ old('unit_type', $issueEdit->material_unit_id) == $unit->id ? 'selected' : '' }}>{{$unit->unit_type}}</option>
                           @endforeach
                        </select>
                    </div>

                    <div class="col-md-2"  style="margin-top: 20px">
                        <label class="control-label">Material Qty<font color="#FF0000">*</font></label>
                        <input type="number" class="form-control" name="quantity" placeholder="" value="{{$issueEdit->quantity}}"/>
                    </div>


                    <div class="col-md-2" style="margin-top: 20px">
                        <label>Select Vendor</label>
                        <select class="form-control select" data-live-search="true" name="vendor" id="vendor">
                            <option value="">--Select--</option>
                            @foreach ($vendor as $vendor)
                            <option value="{{$vendor->id}}" {{ old('vendor', $issueEdit->vendor_id) == $vendor->id ? 'selected' : '' }}>{{$vendor->vendor_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-1" style="margin-top:35px;">
                        <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                            <i class="fa fa-file"></i>Update</button>

                    </div>

                </div>

                </form>

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

<script>
    $(document).ready(function () {
         // Set current date in date input field
    var today = new Date().toISOString().split('T')[0];
    $('#date').val(today);

        $('#material').change(function () {
            var material_id = $(this).val();
            $.ajax({
                url: '{{ route('material.getBrands') }}',
                type: 'GET',
                data: { material_id: material_id },
                success: function (response) {
                    console.log('Response:', response); // Check response in browser console
                    $('#brand').empty(); // Clear current options
                    $('#brand').append('<option value="">--Select--</option>'); // Add default option

                    $.each(response, function (index, brand) {
                        $('#brand').append('<option value="' + brand.id + '">' + brand.brand + '</option>');
                    });
                    $('#brand').selectpicker('refresh'); // Refresh Bootstrap Select

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching brands:', error);
                }
            });
        });


        $('#brand').change(function () {
            var brand_id = $(this).val();
            $.ajax({
                url: '{{ route('material.getRawMaterial') }}',
                type: 'GET',
                data: { brand_id: brand_id },
                success: function (response) {
                    console.log('Response:', response); // Check response in browser console
                    $('#rawmaterial').empty(); // Clear current options
                    $('#rawmaterial').append('<option value="">--Select--</option>'); // Add default option
                    $.each(response, function (index, rawmaterial) {
                        $('#rawmaterial').append('<option value="' + rawmaterial.id + '">' + rawmaterial.raw_material_name + '</option>');
                    });
                    $('#rawmaterial').selectpicker('refresh'); // Refresh Bootstrap Select
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching raw materials:', error);
                }
            });
        });
    });
</script>
@stop
