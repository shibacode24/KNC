@extends('layout.header')
@section( 'content' )



<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <div class="panel-body" style="padding:1px 5px 2px 5px;">

                <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-plus"></i> &nbsp;WareHouse/Issued Material Manage
                            </h5>



                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top:15px;">

                        <!-- START DEFAULT DATATABLE -->

                        <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                        <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">


{{-- --------------------------------- --}}

<div class="col-md-12" style="margin-top:5px;">


    <div class="tabs">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#tab1" data-toggle="tab">Issue Material</a></li>
            <li><a href="#tab2" data-toggle="tab">Direct Issue Material</a></li>
        </ul>
        <div class="panel-body tab-content">
            <!-- Issue Material Tab -->
            <div class="tab-pane active" id="tab1">
                <div class="tabs">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab1-pending" data-toggle="tab">Pending</a></li>
                        <li><a href="#tab1-approve" data-toggle="tab">Approve</a></li>
                        <li><a href="#tab1-inprogress" data-toggle="tab">In Progress</a></li>
                        <li><a href="#tab1-completed" data-toggle="tab">Completed</a></li>
                    </ul>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="tab1-pending">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Requested Date</th>
                                            <th>Request ID</th>
                                            <th>Site Name</th>
                                            <th>Material Name</th>
                                            <th>Brand Name</th>
                                            <th>Material Qty</th>
                                            <th>Material Unit</th>
                                            <th>Issue Material</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($issueMaterial->where('inventory_status', 'Pending')->sortByDesc('created_at') as $material)
                                            @php
                                                $existing = $existingMaterials->get($material->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $material->requested_material_date }}</td>
                                                <td>{{ $material->id }}</td>
                                                <td>{{ $material->site_name->site_name ?? '' }}</td>
                                                <td>{{ $material->material_name->material }}</td>
                                                <td>{{ $material->brand_name->brand }}</td>
                                                <td>{{ $material->requested_material_quantity }}</td>
                                                <td>{{ $material->unit_type->unit_type }}</td>
                                                <td>{{ $material->issue_material }}</td>
                                                <td>
                                                    <textarea class="form-control" name="remarks[{{ $material->id }}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>
                                                </td>
                                                <td>
                                                    <select class="form-control select" data-live-search="true" name="status[{{ $material->id }}]">
                                                        <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                                        <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                                        <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab1-approve">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($issueMaterial->where('inventory_status', 'Approve')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            {{-- @foreach ($statusID as $status)
                                            <option value="{{ $status->id }}" {{ (isset($existing) && $existing->status_id == $status->id) ? 'selected' : '' }}>{{$status->status}}</option>
                                            @endforeach --}}
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>

                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab1-inprogress">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($issueMaterial->where('inventory_status', 'Inprogress')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab1-completed">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($issueMaterial->where('inventory_status', 'Completed')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>

                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <!-- Add additional tab panes here if needed -->
                    </div>
                </div>
            </div>

            <!-- Direct Issue Material Tab -->
            <div class="tab-pane" id="tab2">
                <div class="tabs">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab2-pending" data-toggle="tab">Pending</a></li>
                        <li><a href="#tab2-approve" data-toggle="tab">Approve</a></li>
                        <li><a href="#tab2-inprogress" data-toggle="tab">In Progress</a></li>
                        <li><a href="#tab2-completed" data-toggle="tab">Completed</a></li>
                    </ul>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="tab2-pending">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Requested Date</th>
                                            <th>Request ID</th>
                                            <th>Site Name</th>
                                            <th>Material Name</th>
                                            <th>Brand Name</th>
                                            <th>Material Unit</th>
                                            <th>Material Qty</th>
                                            {{-- <th>Issue Material</th> --}}
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($directIssueMaterial->where('inventory_status', 'Pending')->sortByDesc('created_at') as $material)
                                            @php
                                                $existing = $existingMaterials->get($material->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $material->requested_material_date }}</td>
                                                <td>{{ $material->id }}</td>
                                                <td>{{ $material->site_name->site_name ?? '' }}</td>
                                                <td>{{ $material->material_name->material }}</td>
                                                <td>{{ $material->brand_name->brand }}</td>
                                                <td>{{ $material->unit_type->unit_type }}</td>
                                                <td>{{ $material->requested_material_quantity }}</td>
                                                <td>
                                                    <textarea class="form-control" name="remarks[{{ $material->id }}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>
                                                </td>
                                                <td>
                                                    <select class="form-control select" data-live-search="true" name="status[{{ $material->id }}]">
                                                        <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                                        <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                                        <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab2-approve">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($directIssueMaterial->where('inventory_status', 'Approve')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            {{-- @foreach ($statusID as $status)
                                            <option value="{{ $status->id }}" {{ (isset($existing) && $existing->status_id == $status->id) ? 'selected' : '' }}>{{$status->status}}</option>
                                            @endforeach --}}
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>

                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab2-inprogress">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($directIssueMaterial->where('inventory_status', 'Inprogress')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab2-completed">
                            <form action="{{ route('add-issued-material-by-warehouse') }}" method="POST">
                                @csrf
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Requested Date</th>
                                        <th>Request ID</th>
                                        <th>Site Name</th>

                                        <th>Material Name</th>
                                        <th>Brand Name</th>
                                        <th>Material Qty</th>
                                        <th>Material Unit</th>
                                        <th>Issue Material</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($directIssueMaterial->where('inventory_status', 'Completed')->sortByDesc('created_at') as $material)
                                    @php
                                    $existing = $existingMaterials->get($material->id);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$material->requested_material_date}}</td>
                                        <td>{{$material->id}}</td>
                                        <td>{{$material->site_name->site_name ?? ''}}</td>
                                        <td>{{$material->material_name->material}}</td>
                                        <td>{{$material->brand_name->brand}}</td>
                                        <td>{{$material->requested_material_quantity}}</td>
                                        <td>{{$material->unit_type->unit_type}}</td>
                                        <td>{{$material->issue_material}}</td>

                                        <td>
                                            <textarea class="form-control" name="remarks[{{$material->id}}]" rows="1" cols="4">{{ $existing->remark ?? '' }}</textarea>

                                            </td>
                                        <td>  <select class="form-control select" data-live-search="true" name="status[{{$material->id}}]">
                                            <option value="">--Select--</option>
                                            <option value="Pending" {{ isset($existing) && $existing->status_id == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approve" {{ isset($existing) && $existing->status_id == 'Approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="Inprogress" {{ isset($existing) && $existing->status_id == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>
                                            <option value="Completed" {{ isset($existing) && $existing->status_id == 'Completed' ? 'selected' : '' }}>Completed</option>

                                        </select></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            </form>
                        </div>
                        <!-- Add additional tab panes here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- START JUSTIFIED TABS -->

    <!-- END JUSTIFIED TABS -->
                            {{-- -------------------- --}}
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




<!-- PAGE CONTENT WRAPPER -->


</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

@stop
@section('js')
@stop
