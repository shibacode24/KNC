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
                                <i class="fa fa-bars"></i> &nbsp;Add Role
                            </h5>

                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('panel-user-role-store') }}" method="post">
                        @csrf
                        <div class="col-md-12" style="margin-top: 10px; margin-left:500px; margin-bottom:20px" >
                            <div class="d-flex justify-content-center">
                                <div class="col-md-2 d-flex flex-column align-items-center">
                                    <label class="control-label">Add Role<font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" name="role" placeholder="" required />
                                </div>
                            </div>


                        </div>

{{-- --------------------------------------------------------------------------------------------------------- --}}

                        <hr>
                        <div class="col-md-12" style="margin-top: 5px;margin-bottom: 20px;">
                            {{-- <img src="{{ asset('public/img/line.png') }}" width="100%" /> --}}
                        </div>

                        <div class="row g-2" style="margin-left: 10px">
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label" style="font-weight: bold; font-size:16px"> Masters
                                    :</label>
                            </div>

                            <div class="col-md-10">

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="city"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add City</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="firm"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Firm</label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="branch"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Branch</label>
                                </div>
                            </div>

                            {{-- Consumable --}}

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="unit_type"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Unit Type </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="material"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Material Category</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="brand"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Brand</label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="raw_material"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Raw Material </label>
                                </div>
                            </div>



                            {{-- Non Consumable --}}

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_unit_type"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Unit Type </label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non-consumable-category"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non-consumable-category-material"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Sub Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_brand"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Brand </label>
                                </div>
                            </div>
                            {{-- ------------------------ --}}


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="working_unit_type"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Working Unit Type </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="category"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Task Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="subcategory"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Task Sub Category </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="client"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Client</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Sites </label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="warehouse"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Warehouse </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="vendor"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Vendor</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site_manager"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Site Manager</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="site_incharge"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Site Incharge</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="supervisor"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Supervisor</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="engg"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Engineer</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="contractor"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Contractor</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="employee"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Employee</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="status"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Status </label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="issue"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Add Issues </label>
                                </div>
                            </div>



                            {{-- <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="dashboard_index"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">App Roles</label>
                                </div>
                            </div> --}}




                            {{-- <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="panel-role"
                                        name="permission[]" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">Panel Roles</label>
                                </div>
                            </div> --}}
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
                                        name="permission[]" id="flexCheckDefault">
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
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Site Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="add_material"
                                        id="flexCheckDefault1" name="permission[]">
                                    <label class="form-check-label" for="flexCheckDefault1">Add Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-issue-material"
                                        id="flexCheckDefault1" name="permission[]">
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
                                        name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Site Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_add_material"
                                        id="flexCheckDefault1" name="permission[]">
                                    <label class="form-check-label" for="flexCheckDefault1">Add Material</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_direct_issue_material"
                                        id="flexCheckDefault1" name="permission[]">
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
                                        name="permission[]" id="flexCheckDefault0">
                                    <label class="form-check-label" for="flexCheckDefault0">Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="order_details"
                                        id="flexCheckDefault12" name="permission[]">
                                    <label class="form-check-label" for="flexCheckDefault12">Order Details List</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-po-list"
                                        id="flexCheckDefault12" name="permission[]">
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
                                        name="permission[]" id="flexCheckDefault0">
                                    <label class="form-check-label" for="flexCheckDefault0">Material Req. List</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_order_list"
                                        id="flexCheckDefault12" name="permission[]">
                                    <label class="form-check-label" for="flexCheckDefault12">Order Details List</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="non_consumable_directPoList"
                                        id="flexCheckDefault12" name="permission[]">
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
                                        name="permission[]" id="flexCheckDefault7">
                                    <label class="form-check-label" for="flexCheckDefault7">GRN In</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="direct-grn-in"
                                        id="flexCheckDefault71" name="permission[]">
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
                                name="permission[]" id="flexCheckDefault7">
                            <label class="form-check-label" for="flexCheckDefault7">GRN OUT</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="direct-grn-out"
                                id="flexCheckDefault71" name="permission[]">
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
                            name="permission[]" id="flexCheckDefault7">
                        <label class="form-check-label" for="flexCheckDefault7">GRN In</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="non_consumable_direct_grn_in"
                            id="flexCheckDefault71" name="permission[]">
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
                    name="permission[]" id="flexCheckDefault7">
                <label class="form-check-label" for="flexCheckDefault7">GRN OUT</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="non_consumanle_directGrnOut"
                    id="flexCheckDefault71" name="permission[]">
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
            name="permission[]" id="flexCheckDefault7">
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
                        name="permission[]" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Add Role</label>
                </div>
            </div>


            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value=""
                        name="permission[]" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Add User</label>
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
                    name="permission[]" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Add Role</label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="panel-user"
                    name="permission[]" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Add User</label>
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
                name="permission[]" id="flexCheckDefault">
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
                name="permission[]" id="flexCheckDefault">
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
                name="permission[]" id="flexCheckDefault">
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
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-bars"></i> &nbsp;Added Roles
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
                                        <th>Role Name</th>
                                        {{-- <th>Assigned Role</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role->sortByDesc('created_at') as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->role ?? 'N/A' }}</td>
                                        {{-- <td>{{ is_array($role->permission) ? implode(', ', $role->permission) : ($role->permission ?? 'N/A') }}</td> --}}

                                        <td>

                                          <a href="{{route('panel-user-roles-edit', $role->id)}}">
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


            // Toggle password visibility
            $('.toggle-password').click(function() {
                var input = $(this).closest('.input-group').find('input');
                var icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });




            $(".add-row-purchase").click(function() {
                var acc_holder_name = $('#acc_holder_name').val();
                var bank = $('#bank').val();
                var ac_n = $('#ac_n').val();
                var ifsc_code = $('#ifsc').val();

                // Check if any of the fields are empty
                if (acc_holder_name === '' || bank === '' || ac_n === '' || ifsc_code === '') {
                    // If any field is empty, show a message
                    alert('Please fill all the fields before appending.');
                } else {
                    // If all fields are filled, proceed with appending
                    var markup =
                        '<tr>' +
                        '<td>' +
                        '<input type="hidden" name="acc_holder_name[]" required="" style="border:none; width: 100%;" value="' +
                        acc_holder_name + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + acc_holder_name +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="hidden" name="bank[]" required="" style="border:none; width: 100%;" value="' +
                        bank + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + bank +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="hidden" name="ac_n[]" required="" style="border:none; width: 100%;" value="' +
                        ac_n + '">' +
                        '<input type="text" required="" style="border:none; width: 100%;" value="' + ac_n +
                        '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="ifsc[]" required="" style="border:none; width: 100%;" value="' +
                        ifsc_code + '">' +
                        '</td>' +
                        '<td style="text-align:center; color:#FF0000">' +
                        '<button class="delete-row"><i class="fa fa-trash-o"></i></button>' +
                        '</td>' +
                        '</tr>';

                    $(".add_more_purchase").append(markup);

                    // Clear the input fields
                    $('#acc_holder_name').val('');
                    $('#bank').val('');
                    $('#ac_n').val('');
                    $('#ifsc').val('');
                }
            });

            $("tbody").delegate(".delete-row", "click", function() {
                $(this).parents("tr").remove();
            });
        });
    </script>
@stop
