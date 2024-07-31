@extends('layout.header')
@section('content')

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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
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
                                <i class="fa fa-plus"></i> &nbsp;Non Consumable Add Direct Issue Materials
                            </h5>
                        </div>
                    </div>

                    <form action="{{ route('non_consumable_direct_issue_material_update') }}" method="post">
                        @csrf
                        <div class="col-md-12" style="margin-top:10px;">
                            <!-- <div class="col-md-4"></div>
                                                -->
                            <input type="hidden" name="id" value="{{ $edit_material->id }}">
                            <div class="col-md-2" >
                                <label class="control-label">Date<font color="#FF0000">*</font></label>
                                <input type="date" name="date" id="date" value="{{ $edit_material->name }}" class="form-control">
                            </div>

                            <div class="col-md-2" >
                                <label class="control-label">Time<font color="#FF0000">*</font></label>
                                <input type="time" name="time" id="time" value="{{ $edit_material->time }}" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label>Select Site</label>
                                <select class="form-control select" data-live-search="true" name="site" id="site">
                                    <option value="">--Select--</option>
                                    @foreach ($site as $site)
                                        <option value="{{ $site->id }}" @if ($edit_material->site_id == $site->id)
                                            selected
                                        @endif>{{ $site->site_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Supervisor</label>
                                <select class="form-control select" data-live-search="true" name="supervisor"
                                    id="supervisor">
                                    <option value="">--Select--</option>
                                    @foreach ($supervisor as $supervisor)
                                        <option value="{{ $supervisor->id }}" @if ($edit_material->supervisor_id == $supervisor->id)
                                            selected
                                        @endif>{{ $supervisor->supervisor_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Warehouse</label>
                                <select class="form-control select" data-live-search="true" name="warehouse" id="warehouse">
                                    <option value="">--Select--</option>
                                    @foreach ($warehouse as $warehouse)
                                        <option value="{{ $warehouse->id }}" @if ($edit_material->warehouse_id == $warehouse->id)
                                            selected
                                        @endif>{{ $warehouse->warehouse_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2" >
                                <label>Select Category</label>
                                <select class="form-control select" data-live-search="true" name="material" id="category">
                                    <option value="">--Select--</option>
                                    @foreach ($category as $categorys)
                                        <option value="{{ $categorys->id }}" @if ($edit_material->material_id == $categorys->id)
                                            selected
                                        @endif>{{ $categorys->category }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2" style="margin-top: 15px; margin-left:10px">
                                <label>Select Sub Category</label>
                                <select class="form-control select" data-live-search="true" ame="raw_material_id" id="sub_category">
                                    <option value="">--Select--</option>
                                    @foreach ($materials as $materials)
                                        <option value="{{ $materials->id }}" @if ($edit_material->material_id == $materials->id)
                                            selected
                                        @endif>{{ $materials->material }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2" style="margin-top: 15px">
                                <label>Select Brand</label>
                                <select class="form-control select" data-live-search="true" name="brand" id="brand">
                                    <option value="">--Select--</option>
                                    @foreach ($brand as $brand)
                                        <option value="{{ $brand->id }}" @if ($edit_material->brand_id == $brand->id)
                                            selected
                                        @endif>{{ $brand->brand }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- <div class="col-md-2" style="margin-top: 15px">
                        <label>Select Raw Materials</label>
                        <select class="form-control select" data-live-search="true" name="raw_material" id="rawmaterial">
                            <option value="">--Select--</option>
                            @foreach ($rawmaterial as $raw_material)
                            <option value="{{$raw_material->id}}">{{$raw_material->raw_material_name}}</option>
                            @endforeach
                        </select>
                    </div> --}}

                            <div class="col-md-2" style="margin-top: 15px">
                                <label>Select Unit</label>
                                <select class="form-control select" data-live-search="true" name="unit_type">
                                    @foreach ($unit as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2" style="margin-top: 20px">
                                <label class="control-label">Material Qty<font color="#FF0000">*</font></label>
                                <input type="number" value="{{ $edit_material->quantity }}" class="form-control" name="quantity" placeholder="" />
                            </div>

                            <div class="col-md-2" style="margin-top: 20px">
                                <label class="control-label">Remark<font color="#FF0000">*</font></label>
                                <textarea name="remark" class="form-control" id="remark" cols="30" rows="3">{{ $edit_material->remark }}</textarea>
                            </div>


                            <div class="col-md-1" style="margin-top:35px;">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
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
        $(document).ready(function() {
            // Set current date in date input field
            var today = new Date().toISOString().split('T')[0];
            $('#date').val(today);

            $('#sub_category').change(function() {
                var material_id = $(this).val();
                $.ajax({
                    url: '{{ route('getNonConsumableMaterialBrands') }}',
                    type: 'GET',
                    data: {
                        material_id: material_id
                    },
                    success: function(response) {
                        console.log('Response:', response); // Check response in browser console
                        $('#brand').empty(); // Clear current options
                        $('#brand').append(
                        '<option value="">--Select--</option>'); // Add default option

                        $.each(response, function(index, brand) {
                            $('#brand').append('<option value="' + brand.id + '">' +
                                brand.brand + '</option>');
                        });
                        $('#brand').selectpicker('refresh'); // Refresh Bootstrap Select

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching brands:', error);
                    }
                });
            });


            $('#brand').change(function() {
                var brand_id = $(this).val();
                $.ajax({
                    url: '{{ route('material.getRawMaterial') }}',
                    type: 'GET',
                    data: {
                        brand_id: brand_id
                    },
                    success: function(response) {
                        console.log('Response:', response); // Check response in browser console
                        $('#rawmaterial').empty(); // Clear current options
                        $('#rawmaterial').append(
                        '<option value="">--Select--</option>'); // Add default option
                        $.each(response, function(index, rawmaterial) {
                            $('#rawmaterial').append('<option value="' + rawmaterial
                                .id + '">' + rawmaterial.raw_material_name +
                                '</option>');
                        });
                        $('#rawmaterial').selectpicker('refresh'); // Refresh Bootstrap Select
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching raw materials:', error);
                    }
                });
            });

            $('#category').change(function () {
            var category_id = $(this).val();
            $.ajax({
                url: '{{ route('getsubcategory') }}',
                type: 'GET',
                data: { category_id: category_id },
                success: function (response) {
                    console.log('Response:', response); // Check response in browser console
                    $('#sub_category').empty(); // Clear current options
                    $('#sub_category').append('<option value="">--Select--</option>'); // Add default option
                    $.each(response, function (index, sub_category) {
                        $('#sub_category').append('<option value="' + sub_category.id + '">' + sub_category.material + '</option>');
                    });
                    $('#sub_category').selectpicker('refresh'); // Refresh Bootstrap Select
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching raw materials:', error);
                }
            });
        });
        });
    </script>
@stop
