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

                    <form action="{{ route('non_consumable_direct_issue_material_store') }}" method="post">
                        @csrf
                        <div class="col-md-12" style="margin-top:10px;">
                            <!-- <div class="col-md-4"></div>
                                                    -->
                            <div class="col-md-2">
                                <label class="control-label">Date<font color="#FF0000">*</font></label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>

                            {{-- <div class="col-md-2">
                                <label class="control-label">Time<font color="#FF0000">*</font></label>
                                <input type="time" name="time" id="time" class="form-control">
                            </div> --}}

                            <div class="col-md-2">
                                <label>Select Warehouse</label>
                                <select class="form-control select" data-live-search="true" name="warehouse" id="warehouse">
                                    <option value="">--Select--</option>
                                    @foreach ($warehouse as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Site</label>
                                <select class="form-control select" data-live-search="true" name="site" id="site">
                                    <option value="">--Select--</option>
                                    @foreach ($site as $site)
                                        <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- <div class="col-md-2">
                                <label>Select Supervisor</label>
                                <select class="form-control select" data-live-search="true" name="supervisor"
                                    id="supervisor">
                                    <option value="">--Select--</option>
                                    @foreach ($supervisor as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->supervisor_name }}</option>
                                    @endforeach

                                </select>
                            </div> --}}



                            <div class="col-md-2">
                                <label>Select Category</label>
                                <select class="form-control select" data-live-search="true" name="material" id="category">
                                    <option value="">--Select--</option>
                                    @foreach ($material as $material)
                                        <option value="{{ $material->id }}">{{ $material->category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Sub Category</label>
                                <select class="form-control select" data-live-search="true" name="raw_material_id"
                                    id="subcategory">
                                    <option value="">--Select--</option>
                                    @foreach ($sub_category as $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2" >
                                <label>Select Brand</label>
                                <select class="form-control select" data-live-search="true" name="brand" id="brand">
                                    <option value="">--Select--</option>
                                    @foreach ($brand as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
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

                            <div class="col-md-2" style="margin-top: 20px">
                                <label>Select Unit</label>
                                <select class="form-control select" data-live-search="true" name="unit_type">
                                    <option value="">--Select--</option>
                                    @foreach ($unit as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2" style="margin-top: 20px">
                                <label class="control-label">Material Qty<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="quantity" placeholder="" />
                            </div>

                            <div class="col-md-2" style="margin-top: 20px">
                                <label class="control-label">Remark<font color="#FF0000">*</font></label>
                                <textarea name="remark" class="form-control" id="remark" cols="30" rows="3"></textarea>
                            </div>


                            <div class="col-md-1" style="margin-top:35px;">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-file"></i>Submit</button>

                            </div>

                        </div>

                    </form>
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-plus"></i> &nbsp;Non Consumable Added Direct Issue Materials

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
                                            {{-- <th>Time</th> --}}
                                            <th>Site Name</th>
                                            {{-- <th>Supervisor Name</th> --}}
                                            <th>Warehouse Name</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            {{-- <th>Raw Material Name</th> --}}
                                            <th>Brand Name</th>
                                            <th>Material Unit Type</th>
                                            <th>Material Qty</th>
                                            <th>Remark</th>
                                            {{-- <th>Remark</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($issue->sortByDesc('created_at') as $addMaterial)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{date('d-m-Y',strtotime($addMaterial->date))}}</td>
                                                {{-- <td>{{ $addMaterial->time }}</td> --}}
                                                <td>{{ $addMaterial->site_name->site_name ?? ''}}</td>
                                                {{-- <td>{{ $addMaterial->supervisor_name->supervisor_name ?? ''}}</td> --}}
                                                <td>{{ $addMaterial->warehouse_name->warehouse_name ?? ''}}</td>
                                                <td>{{ $addMaterial->material_name->category ?? ''}}</td>
                                                <td>{{$addMaterial->sub_category_name->sub_category_name ?? ''}}</td>
                                                <td>{{ $addMaterial->brand_name->brand ?? ''}}</td>
                                                <td>{{ $addMaterial->unit_type->unit_type ?? ''}}</td>
                                                <td>{{ $addMaterial->quantity ?? ''}}</td>
                                                <td>{{ $addMaterial->remark ?? ''}}</td>



                                                <td>
                                                    <a
                                                        href="{{ route('non_consumable_direct_issue_material_edit', $addMaterial->id) }}">
                                                        <button
                                                            style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Edit"><i class="fa fa-edit"
                                                                style="margin-left:5px;"></i></button>
                                                    </a>

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

            $('#category').change(function() {
                var category_id = $(this).val();
                $.ajax({
                    url: '{{ route('getsubcategory') }}',
                    type: 'GET',
                    data: {
                        category_id: category_id
                    },
                    success: function(response) {
                        console.log('Response:', response); // Check response in browser console
                        $('#sub_category').empty(); // Clear current options
                        $('#sub_category').append(
                        '<option value="">--Select--</option>'); // Add default option
                        $.each(response, function(index, sub_category) {
                            $('#sub_category').append('<option value="' + sub_category
                                .id + '">' + sub_category.material + '</option>');
                        });
                        $('#sub_category').selectpicker('refresh'); // Refresh Bootstrap Select
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching raw materials:', error);
                    }
                });
            });
        });
    </script>
@stop
