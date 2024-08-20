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
                                <i class="fa fa-plus"></i> &nbsp;Add Raw Materials
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('raw-material-update') }}" method="post">
                            @csrf


                            <input type="hidden" name="id" value="{{ $rawMaterialEdit->id }}">

                            <div class="col-md-2">
                                <label>Select Material</label>
                                <select class="form-control select" data-live-search="true" name="material_id" id="material">
                                    <option value="">--Select--</option>
                                    @foreach ($material as $mat)
                                        <option value="{{ $mat->id }}"
                                            {{ old('material_id', $rawMaterialEdit->material_id) == $mat->id ? 'selected' : '' }}>
                                            {{ $mat->material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Brand</label>
                                <select class="form-control select" data-live-search="true" name="brand" id="brand">
                                    <option value="">--Select--</option>
                                    @foreach ($brand as $br)
                                        <option value="{{ $br->id }}"
                                            {{ old('brand', $rawMaterialEdit->brand_id) == $br->id ? 'selected' : '' }}>
                                            {{ $br->brand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col-md-2">
                                <label class="control-label">Raw Material Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="raw_material_name" placeholder="" value="{{$rawMaterialEdit->raw_material_name}}"
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



                            <div class="col-md-2">
                                <label class="control-label">Minimum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="minimum_keeping_quantity" placeholder="" value="{{$rawMaterialEdit->minimum_keeping_quantity}}"
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Maximum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="maximum_keeping_quantity" placeholder="" value="{{$rawMaterialEdit->maximum_keeping_quantity}}"
                                    required />
                            </div>


                            <div class="col-md-2" style="margin-top:15px;" align="left">
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
