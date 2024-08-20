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
                                <i class="fa fa-plus"></i> &nbsp;Add Raw Materials
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('rawmaterial.store') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div> -->

                              <div class="col-md-2">
                                <label>Select Material</label>
                                <select class="form-control select" data-live-search="true" name="material_id"
                                    id="material">
                                    <option value="">--Select--</option>
                                    @foreach ($material as $material)
                                        <option value="{{ $material->id }}">{{ $material->material }}</option>
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
                                <label class="control-label">Raw Material Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="raw_material_name" placeholder=""
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label>Select Unit</label>
                                <select class="form-control select" data-live-search="true" name="unit_id">
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
                                    <i class="fa fa-plus"></i> &nbsp;Added Raw Materials

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
                                            <th>Raw Material Name</th>
                                            <th>Unit</th>
                                            <th>Selected Materials</th>
                                            <th>Selected Brand</th>
                                            {{-- <th>Material Type</th> --}}
                                            <th>Minimum Keeping Quantity</th>
                                            <th>Maximum Keeping Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($raw_material as $raw_material)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>


                                                <td>{{ $raw_material->raw_material_name ?? null }}</td>
                                                <td>{{ $raw_material->unit_name->unit_type ?? null }}</td>
                                                <td>{{ $raw_material->material_name->material ?? null }}</td>
                                                <td>{{ $raw_material->brand_name->brand ?? null }}</td>
                                                {{-- <td>{{ $raw_material->material_type ?? null }}</td> --}}
                                                <td>{{ $raw_material->minimum_keeping_quantity ?? null }}</td>
                                                <td>{{ $raw_material->maximum_keeping_quantity ?? null }}</td>
                                                <td>
                                                    <a href="{{ route('raw-material-edit', $raw_material->id) }}">

                                                    <button
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
        $('#material').change(function () {
            var material_id = $(this).val();
            $.ajax({
                url: '{{ route('brands.getBrands') }}',
                type: 'GET',
                data: { material_id: material_id },
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
