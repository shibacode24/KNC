@extends('layout.header')
@section('content')

    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

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
                                <i class="fa fa-plus"></i> &nbsp;Add Non Consumable Sub Category
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('non-consumable-category-material-store') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div> -->

                              <div class="col-md-2">
                                <label>Select Category</label>
                                <select class="form-control select" data-live-search="true" name="category"
                                    id="category">
                                    <option value="">--Select--</option>
                                    @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                                </select>
                            </div>
                               <div class="col-md-2">
                                <label>Select Brand</label>
                                {{-- <select class="form-control select" data-live-search="true" name="brand"
                                    id="brand"> --}}
                                    {{-- @foreach ($brand as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                    @endforeach --}}
                                {{-- </select> --}}
                                <select class="form-control select" data-live-search="true" name="brand" id="brand">
                                    {{-- Options will be dynamically added here --}}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Sub Category Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="sub_category_name" placeholder=""
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label>Select Unit</label>
                                <select class="form-control select" data-live-search="true" name="unit_type">
                                    @foreach ($unit as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-2">
                                <label>Select Material Type</label>
                                <select class="form-control select" data-live-search="true" name="material_type"
                                    id="material_type">
                                    <option value="">--Select--</option>
                                        <option value="Consumable">Consumable</option>
                                        <option value="Non Consumable">Non Consumable</option>
                                </select>
                            </div> --}}


                            <div class="col-md-2">
                                <label class="control-label">Minimum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="minimum_keeping_quantity" placeholder=""
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Maximum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="maximum_keeping_quantity" placeholder=""
                                    required />
                            </div>


                            <div class="col-md-2" style="margin-top:20px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Add</button>

                            </div>
                        </form>
                    </div>
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-plus"></i> &nbsp;Added Non Consumable Sub Categories

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
                                            <th>Sub-Category Name</th>
                                            <th>Unit Type</th>
                                            <th>Selected Category</th>
                                            <th>Selected Brand</th>
                                            {{-- <th>Material Type</th> --}}
                                            <th>Minimum Keeping Quantity</th>
                                            <th>Maximum Keeping Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($material as $raw_material)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>


                                                <td>{{ $raw_material->sub_category_name ?? null }}</td>
                                                <td>{{ $raw_material->unit_name->unit_type ?? null }}</td>
                                                <td>{{ $raw_material->category_name->category ?? null }}</td>
                                                <td>{{ $raw_material->brand_name->brand ?? null }}</td>
                                                <td>{{ $raw_material->minimum_keeping_quantity ?? null }}</td>
                                                <td>{{ $raw_material->maximum_keeping_quantity ?? null }}</td>
                                                <td>

                                                    <a href="{{ route('non-consumable-category-material-edit', $raw_material->id) }}"><button
                                                        style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Edit"><i class="fa fa-edit"
                                                            style="margin-left:5px;"></i></button>
                                                    </a>

                                                    {{-- <a href="{{ route('raw-material-destroy', $raw_material->id) }}"><button
                                                            style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="confirmDelete({{ $raw_material->id }})"><i
                                                                class="fa fa-trash-o" style="margin-left:5px;"></i></button>
                                                    </a> --}}
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
    $(document).ready(function () {
        $('#category').change(function () {
            var category_id = $(this).val();
            $.ajax({
                url: '{{ route('brands.getNonConsumableBrands') }}',
                type: 'GET',
                data: { category_id: category_id },
                success: function (response) {
                    console.log('Response:', response); // Check response in browser console
                    $('#brand').empty(); // Clear current options
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
    });
</script>

@stop
