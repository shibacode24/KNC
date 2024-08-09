@extends('layout.header')

@section('content')
<div class="page-content-wrap">
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
                    <form action="{{route('prediction.update')}}" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $predictionEdit->id }}">

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


            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
