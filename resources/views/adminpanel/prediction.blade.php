@extends('layout.header')

@section('content')
<div class="page-content-wrap">


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

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;" align="center">
                            <i class="fa fa-plus"></i> &nbsp;Add Prediction Data
                        </h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{route('prediction.store')}}" method="post">
                        @csrf
                        <div class="col-md-2">
                            <label class="control-label">Select Category<font color="#FF0000">*</font></label>
                            <select id="employeeTypeSelect" name="category" class="form-control select">
                                <option value="">--Select--</option>
                                @foreach($category as $categories)
                                    <option value="{{ $categories['id'] }}">{{ $categories['category_name'] }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Select Sub-Category<font color="#FF0000">*</font></label>
                            <select id="employeeSelect" name="sub_category" class="form-control">
                                @foreach($subCategory as $subCategories)
                                <option value="{{ $subCategories['id'] }}">{{ $subCategories['subcategory_name'] }}</option>
                                @endforeach
                        </select>

                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Min. Measurement of Unit<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="min_measurement_of_unit" placeholder="" required />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Unit Type<font color="#FF0000">*</font></label>
                            <select id="employeeSelect" name="working_unit_type" class="form-control">
                                @foreach($unit_type as $unit_type)
                                <option value="{{ $unit_type['id'] }}">{{ $unit_type['working_unit_type'] }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label">Hours of Completion<font color="#FF0000">*</font></label>
                        <input type="text" class="form-control" name="hours_of_completion" placeholder="" required />
                    </div>
                        <div class="col-md-2" style="margin-top:15px; margin-bottom:20px" align="left">
                            <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Added Prediction Data
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
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Min. Measurement of Unit</th>
                                        <th>Unit Type</th>
                                        <th>Hours of Completion</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prediction as $index => $predictions)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $predictions->categoryName->category_name?? ''}}</td>
                                        <td>{{ $predictions->subCategoryName->subcategory_name ?? ''}}</td>
                                        <td>{{ $predictions->min_measurement_of_unit ?? ''}}</td>
                                        <td>{{ $predictions->workingUnitTypeName->working_unit_type ?? ''}}</td>
                                        <td>{{ $predictions->hours_of_completion ?? ''}}</td>
                                        <td>
                                            <a href="{{ route('prediction.edit', $predictions->id) }}"><button
                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                {{-- onclick="confirmDelete({{ $city->id }})" --}}
                                                    style="margin-left:5px;"></i></button></a>
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

@endsection

@section('js')

@endsection
