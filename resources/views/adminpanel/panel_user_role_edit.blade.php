@extends('layout.header')
@section('content')

    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                <div class="panel-body" style="ping:1px 5px 2px 5px;">


                    <div class="col-md-12" style="margin-top:5px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Edit Role
                            </h5>

                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('panel-user-roles-update')}}" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{$roleEdit->id}}">
                        <div class="col-md-12" style="margin-top: 10px; margin-left:500px; margin-bottom:20px" >
                            <div class="d-flex justify-content-center">
                                <div class="col-md-2 d-flex flex-column align-items-center">
                                    <label class="control-label"> Role<font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" name="role" placeholder="" required value="{{$roleEdit->role}}" />
                                </div>
                            </div>


                        </div>

{{-- --------------------------------------------------------------------------------------------------------- --}}

                        <hr>
                        <div class="col-md-12" style="margin-top: 5px;margin-bottom: 20px;">
                            {{-- <img src="{{ asset('public/img/line.png') }}" width="100%" /> --}}
                        </div>

                        <div class="col-md-10">
                            @php
                                $permission = $roleEdit->permission ?? [];
                            @endphp


                        <div class="row g-2" style="margin-left: 10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px"> Masters
                                    :</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="city"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('city', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> City</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="firm"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('firm', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Firm</label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="branch"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('branch', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Branch</label>
                                </div>
                            </div>

                            {{-- Consumable --}}

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="unit_type"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('unit_type', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Unit Type </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="material"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6">Material Category</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="brand"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('brand', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Brand</label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="raw_material"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('raw_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Raw Material </label>
                                </div>
                            </div>



                            {{-- Non Consumable --}}

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_unit_type"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('non_consumable_unit_type', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Unit Type </label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non-consumable-category"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('non-consumable-category', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non-consumable-category-material"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('non-consumable-category-material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Sub Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_brand"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('non_consumable_brand', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Brand </label>
                                </div>
                            </div>
                            {{-- ------------------------ --}}


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="working_unit_type"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('working_unit_type', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Working Unit Type </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="category"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('category', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Task Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="subcategory"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('subcategory', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Task Sub Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="client"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('client', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Client</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('site', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Sites </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="warehouse"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('warehouse', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Warehouse </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="vendor"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('vendor', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Vendor</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site_manager"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('site_manager', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Site Manager</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site_incharge"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('site_incharge', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Site Incharge</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="supervisor"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('supervisor', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Supervisor</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="engg"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('engg', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Engineer</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="contractor"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('contractor', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Contractor</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="employee"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('employee', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Employee</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="status"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('status', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Status </label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="issue"
                                        name="permission[]" id="flexCheckDefault6"  {{ in_array('issue', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault6"> Issues </label>
                                </div>
                            </div>

                            </div>

                        </div>
                        <hr>

                        <div class="row g-2" style="margin-top: 20px; margin-left:10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Assign Site:
                                    </label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="assign_site"
                                        name="permission[]" id="flexCheckDefault"  {{ in_array('assign_site', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Assign Site</label>
                                </div>
                            </div>

                        </div>
                    </div>
                {{-- </div> --}}
                        <hr>
                        <div class="row g-2" style="margin-top: 20px; margin-left:10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Inventory Management
                                    :</label>
                            </div>
                        </div>

                        <div class="row g-2" style="margin-top: 20px; margin-left:10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Consumable Inventory
                                    :</label>
                            </div>

                            <div class="col-md-10" style="margin-bottom:10px">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site_material"
                                        name="permission[]" id="flexCheckDefault"  {{ in_array('site_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Site Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="add_material"
                                        id="flexCheckDefault1"  name="permission[]"  {{ in_array('add_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault1">Add Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-issue-material"
                                        id="flexCheckDefault1"  name="permission[]"  {{ in_array('direct-issue-material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault1">Direct Issue Material</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2" style="margin-top: 20px; margin-left:0px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Non-Consumable Inventory:</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site-non-consumed-material"
                                        name="permission[]" id="flexCheckDefault"  {{ in_array('site-non-consumed-material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Site Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable__material"
                                        id="flexCheckDefault1"  name="permission[]"  {{ in_array('non_consumable__material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault1"> Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_direct_issue_material"
                                        id="flexCheckDefault1"  name="permission[]"  {{ in_array('non_consumable_direct_issue_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault1">Direct Issue Material</label>
                                </div>
                            </div>
                        </div>

                        </div>


                        <hr>

                        <div class="row g-2" style="margin-top: 20px; margin-left:0px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label"
                                    style="font-weight: bold; font-size:16px">Purchase Department :</label>
                            </div>
                        </div>

                        <div class="row g-2" style="margin-top: 20px; margin-left:0px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Consumable Purchase
                                    :</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="req_material"
                                        name="permission[]" id="flexCheckDefault0"  {{ in_array('req_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault0">Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="order_details"
                                        id="flexCheckDefault12" name="permission[]"  {{ in_array('order_details', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault12">Order Details List</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-po-list"
                                        id="flexCheckDefault12" name="permission[]"  {{ in_array('direct-po-list', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault12">Direct PO List</label>
                                </div>
                            </div>

                        </div>
                        </div>


                        <div class="row g-2" style="margin-top: 20px; margin-left:0px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Non-Consumable Purchase
                                    :</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consume_req_material"
                                        name="permission[]" id="flexCheckDefault0"  {{ in_array('non_consume_req_material', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault0">Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_order_list"
                                        id="flexCheckDefault12" name="permission[]"  {{ in_array('non_consumable_order_list', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault12">Order Details List</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_directPoList"
                                        id="flexCheckDefault12" name="permission[]"  {{ in_array('non_consumable_directPoList', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault12">Direct PO List</label>
                                </div>
                            </div>

                        </div>
                        </div>
                        <hr>
                        <div class="row g-2" style="margin-top: 20px; ">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label"
                                    style="font-weight: bold; font-size:16px">Warehouse :</label>
                            </div>
                        </div>

                            <div class="row g-2" style="margin-top: 20px; ">
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label"
                                        style="font-weight: bold; font-size:15px">Consumable GRN :</label>
                                </div>
                            </div>

                                <div class="row g-2" style="margin-top: 20px; ">
                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label"
                                            style="font-weight: bold; font-size:13px">GRN IN :</label>
                                    </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="grn"
                                        name="permission[]" id="flexCheckDefault7"  {{ in_array('grn', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault7">GRN In</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-grn-in"
                                        id="flexCheckDefault71" name="permission[]"  {{ in_array('direct-grn-in', $permission) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault71">Direct GRN In</label>
                                </div>
                            </div>

                        </div>
                        </div>

                        {{--Consumable GRN OUT --}}

                        <div class="row g-2" style="margin-top: 20px; ">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label"
                                    style="font-weight: bold; font-size:13px">GRN OUT :</label>
                            </div>

                    <div class="col-md-10">

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="issue_material"
                                name="permission[]" id="flexCheckDefault7"  {{ in_array('issue_material', $permission) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault7">GRN OUT</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="direct-grn-out"
                                id="flexCheckDefault71" name="permission[]"  {{ in_array('direct-grn-out', $permission) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault71">Direct GRN OUT</label>
                        </div>
                    </div>

                </div>
                </div>

                {{-- NON Consumable GRN--}}

                <div class="row g-2" style="margin-top: 20px; ">
                    <div class="col-md-2">
                        <label for="inputFirstName" class="form-label"
                            style="font-weight: bold; font-size:15px">Non-Consumable GRN :</label>
                    </div>
                </div>

                    <div class="row g-2" style="margin-top: 20px; ">
                        <div class="col-md-2">
                            <label for="inputFirstName" class="form-label"
                                style="font-weight: bold; font-size:13px">GRN IN :</label>
                        </div>

                <div class="col-md-10">

                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="non_consumable_grn"
                            name="permission[]" id="flexCheckDefault7"  {{ in_array('non_consumable_grn', $permission) ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault7">GRN In</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="non_consumable_direct_grn_in"
                            id="flexCheckDefault71" name="permission[]"  {{ in_array('non_consumable_direct_grn_in', $permission) ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault71">Direct GRN In</label>
                    </div>
                </div>

            </div>
            </div>

            {{--Consumable GRN OUT --}}

            <div class="row g-2" style="margin-top: 20px; ">
                <div class="col-md-2">
                    <label for="inputFirstName" class="form-label"
                        style="font-weight: bold; font-size:13px">GRN OUT :</label>
                </div>

        <div class="col-md-10">

        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="non_consumable_grn_out_material"
                    name="permission[]" id="flexCheckDefault7"  {{ in_array('non_consumable_grn_out_material', $permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault7">GRN OUT</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="non_consumanle_directGrnOut"
                    id="flexCheckDefault71" name="permission[]"  {{ in_array('non_consumanle_directGrnOut', $permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault71">Direct GRN In</label>
            </div>
        </div>

    </div>
    </div>


    <div class="row g-2" style="margin-top: 20px; ">
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label"
                style="font-weight: bold; font-size:13px">Transfer Material :</label>
        </div>

<div class="col-md-10">

<div class="col-md-2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="transfer-material"
            name="permission[]" id="flexCheckDefault7"  {{ in_array('transfer-material', $permission) ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault7">Transfer Material</label>
    </div>
</div>

</div>
</div>
    <hr>


    <div class="row g-2" style="margin-top: 20px; ">
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">User Roles:
                </label>
        </div>
    </div>

    <div class="row g-2" style="margin-top: 20px; ">
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Mobile App User Roles:
                </label>
        </div>

        <div class="col-md-10">

            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="app-user-roles"
                        name="permission[]" id="flexCheckDefault"  {{ in_array('app-user-roles', $permission) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">Add App User Role</label>
                </div>
            </div>


            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value=""
                        name="permission[]" id="flexCheckDefault"  {{ in_array('', $permission) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">Add App User</label>
                </div>
            </div>


    </div>
</div>

<div class="row g-2" style="margin-top: 20px; ">
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:14px">Panel User Roles:
            </label>
    </div>

    <div class="col-md-10">

        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="panel-user-roles"
                    name="permission[]" id="flexCheckDefault"  {{ in_array('panel-user-roles', $permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault">Add Panel Role</label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="panel-user"
                    name="permission[]" id="flexCheckDefault"  {{ in_array('panel-user', $permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault">Add Panel User</label>
            </div>
        </div>



</div>
</div>

<hr>

<div class="row g-2" style="margin-top: 20px; ">
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Track User Location:
            </label>
    </div>

    <div class="col-md-10">

    <div class="col-md-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="track_location"
                name="permission[]" id="flexCheckDefault"  {{ in_array('track_location', $permission) ? 'checked' : '' }}>
            <label class="form-check-label" for="flexCheckDefault">Track User Location</label>
        </div>
    </div>

</div>
</div>

<hr>



<div class="row g-2" style="margin-top: 20px; ">
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Account Department:
            </label>
    </div>

    <div class="col-md-10">

    <div class="col-md-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="expense-master"
                name="permission[]" id="flexCheckDefault"  {{ in_array('expense-master', $permission) ? 'checked' : '' }}>
            <label class="form-check-label" for="flexCheckDefault">Account Department</label>
        </div>
    </div>

</div>
</div>

<hr>


<div class="row g-2" style="margin-top: 20px; ">
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px">Prediction:
            </label>
    </div>

    <div class="col-md-10">

    <div class="col-md-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="prediction"
                name="permission[]" id="flexCheckDefault"  {{ in_array('prediction', $permission) ? 'checked' : '' }}>
            <label class="form-check-label" for="flexCheckDefault">Prediction</label>
        </div>
    </div>

</div>
</div>

<hr>



                    {{-- </form> --}}

                    {{-- apppended supervisor data end --}}
   <div class="col-md-2" style="margin-top:20px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-file"></i>Submit</button>

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
