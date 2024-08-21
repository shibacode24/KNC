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
                        <form action="{{ route('non-consumable-category-material-update') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div> -->

                            <input type="hidden" name="id" value="{{$materialEdit->id}}">
                            <div class="col-md-2">
                                <label>Select Category</label>
                                <select class="form-control select" data-live-search="true" name="category" id="category">
                                    <option value="">--Select--</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $materialEdit->category_id ? 'selected' : '' }}>
                                            {{ $cat->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Select Brand</label>
                                <select class="form-control select" data-live-search="true" name="brand" id="brand">
                                    {{-- Options will be dynamically added here --}}
                                    @foreach ($brand as $brd)
                                        <option value="{{ $brd->id }}" {{ $brd->id == $materialEdit->brand_id ? 'selected' : '' }}>
                                            {{ $brd->brand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Sub Category Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="sub_category_name" placeholder=""
                                value="{{$materialEdit->sub_category_name}}" required />
                            </div>

                            <div class="col-md-2">
                                <label>Select Unit</label>
                                <select class="form-control select" data-live-search="true" name="unit_type">
                                    @foreach ($unit as $unt)
                                        <option value="{{ $unt->id }}" {{ $unt->id == $materialEdit->unit_type_id ? 'selected' : '' }}>
                                            {{ $unt->unit_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-2">
                                <label class="control-label">Minimum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="minimum_keeping_quantity" placeholder=""
                                value="{{$materialEdit->minimum_keeping_quantity}}"  required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Maximum Keeping Quantity<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="maximum_keeping_quantity" placeholder=""
                                value="{{$materialEdit->maximum_keeping_quantity}}"   required />
                            </div>


                            <div class="col-md-2" style="margin-top:20px;" align="left">
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
