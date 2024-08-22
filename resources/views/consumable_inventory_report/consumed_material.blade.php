@extends('layout.header')
@section('content')

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="padding:1px 5px 2px 5px;">
                <div class="row" >
                    <div class="col-lg-12">
                        <!-- Date Filters -->
                        <div class="row" style="margin-top: 50px">
                            <div class="form-group col-md-3">
                                <label class="control-label">Warehouse<font color="#FF0000">*</font></label>
                                <select class="form-control select" data-live-search="true" name="siteIncharge" id="siteIncharge">
                                    @foreach ($warehouse as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name}}</option>
                                    @endforeach
                                </select>                            </div>
                            <div class="form-group col-md-3" style="margin-left: 20px">
                                <label class="control-label">Material<font color="#FF0000">*</font></label>
                                <select class="form-control select" data-live-search="true" name="siteIncharge" id="siteIncharge">
                                    @foreach ($material as $material)
                                        <option value="{{ $material->id }}">{{ $material->material}}</option>
                                    @endforeach
                                </select>                            </div>
                            <div class="form-group col-md-3" style="margin-left: 20px; margin-top:15px">
                                <button class="btn btn-primary" id="searchButton" type="button" style="height: 32px;">
                                    <i class="fa fa-search" aria-hidden="true"></i> Search
                                </button>
                            </div>
                        </div>
                        <!-- Data Table -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content collapse in">
                                        <div class="widgets-container">
                                            <div style="overflow-y: scroll">
                                                <table id="example7" class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Site Name</th>
                                                            <th>Workplace Name</th>
                                                            <th>Material Name</th>
                                                            <th>Raw Material Name</th>
                                                            <th>Brand Name</th>
                                                            <th>Unit Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($consumedMaterial as $material)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$material->site_name->site_name}}</td>
                                                            <td>{{$material->workplace_name->workplace_name}}</td>
                                                            <td>{{$material->material_name->material}}</td>
                                                            <td>{{$material->raw_material->raw_material_name}}</td>
                                                            <td>{{$material->brand_name->brand}}</td>
                                                            <td>{{$material->unit_type->unit_type}}</td>
                                                            <td>{{$material->available_quantity}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Data Table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')

@stop
