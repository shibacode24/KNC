<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>KNC</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ asset('logo/favicon.png') }}" type="image/x-icon" />
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('public/css/theme-default.css') }}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('public/css/notification.css') }}" />
    <!-- EOF CSS INCLUDE -->


    <!-- Include select2 library -->
    {{-- <link href="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js')}}"></script> --}}


@yield('styles')

</head>

<body>

    <style>
        .task {
            position: relative;
            color: #2e2e2f;
            /cursor: move;/ background-color: #fff;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
            margin-bottom: 1rem;
            border: 3px dashed transparent;
            max-width: 208px;
        }

        .task:hover {
            box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;
            border-color: rgba(162, 179, 207, 0.2) !important;
        }

        .task p {
            font-size: 15px;
            margin: 1.2rem 0;
        }

        .tag {
            border-radius: 100px;
            padding: 4px 13px;
            font-size: 12px;
            color: #ffffff;
            background-color: #1389eb;
        }

        .tags {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .options {
            background: transparent;
            border: 0;
            color: #c4cad3;
            font-size: 17px;
        }

        .options svg {
            fill: #9fa4aa;
            width: 20px;
        }

        .stats {
            position: relative;
            width: 100%;
            color: #9fa4aa;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stats div {
            margin-right: 1rem;
            height: 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .stats svg {
            margin-right: 5px;
            height: 100%;
            stroke: #9fa4aa;
        }

        .viewer span {
            height: 30px;
            width: 30px;
            background-color: rgb(28, 117, 219);
            margin-right: -10px;
            border-radius: 50%;
            border: 1px solid #fff;
            display: grid;
            align-items: center;
            text-align: center;
            font-weight: bold;
            color: #fff;
            padding: 2px;
        }

        .viewer span svg {
            stroke: #fff;
        }
    </style>

{{-- MAP --}}


{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&callback=initMap" async defer></script> --}}

    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top">
        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal">


                <li class="" style="background-color:white;">
                    <a> <img src="{{ asset('public/logo/logo.png') }}" alt="" style="margin-top:-12px; width:130px" /></a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile" >
                    <a href="#" class="profile-mini">
                        <img src="{{ asset('public/assets/images/users/avatar.jpg') }}" alt="EMR - OPD Software" />
                    </a>
                </li>
                <li >
                    <a href="{{ route('dashboard') }}" title="Dashboard" style="font-size: 12px"><span class="fa fa-tachometer" style="margin-right: 0px; font-size: 20px">
                        </span></a>

                </li>

                @php
                    $permission = Auth::user()->permission;
                    // echo $permission;
                @endphp


                @if (Auth::user()->panel_role == 1
                || in_array('city', $permission)
                || in_array('firm', $permission)
                || in_array('branch', $permission)
                || in_array('unit_type', $permission)
                || in_array(' material', $permission)
                || in_array('brand', $permission)
                || in_array('raw_material', $permission)
                || in_array('non_consumable_unit_type', $permission)
                || in_array('non-consumable-category', $permission)
                || in_array('non-consumable-category-material', $permission)
                || in_array('non_consumable_brand', $permission)
                || in_array('working_unit_type', $permission)
                || in_array('category', $permission)
                || in_array('subcategory', $permission)
                || in_array('client', $permission)
                || in_array('site', $permission)
                || in_array('warehouse', $permission)
                || in_array('vendor', $permission)
                || in_array('site_manager', $permission)
                || in_array('site_incharge', $permission)
                || in_array('supervisor', $permission)
                || in_array('engg', $permission)
                || in_array('contractor', $permission)
                || in_array('employee', $permission)
                || in_array('status', $permission)
                || in_array('issue', $permission)

                )
                    <li style="margin-left:-20px;">
                        <a href="#" title="Masters" style="font-size: 12px"><span class="fa fa-list" style="margin-right: -1px; font-size: 12px"> </span>Masters</a>
                        <ul>

                            @if (Auth::user()->panel_role == 1 || in_array('city', $permission))
                                <li><a href="{{ route('city') }}"><span class="fa fa-plus"></span>Add City</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('firm', $permission))
                                <li><a href="{{ route('firm') }}"><span class="fa fa-plus"></span>Add Firm</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('branch', $permission))
                                <li><a href="{{ route('branch') }}"><span class="fa fa-plus"></span>Add Branch</a></li>
                            @endif


                            @if (Auth::user()->panel_role == 1 ||
                                    in_array('material', $permission) ||
                                    in_array('brand', $permission) ||
                                    in_array('raw_material', $permission) ||
                                    in_array('unit_type', $permission))
                                <li>
                                    <a href="#" title="Consumable Inventory"><span class="fa fa-list">
                                        </span>Consumable Inventory</a>
                                    <ul>


                                        @if (Auth::user()->panel_role == 1 || in_array('unit_type', $permission))
                                            <li><a href="{{ route('unit_type') }}"><span class="fa fa-plus"></span>Add
                                                    Unit Type</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('material', $permission))
                                            <li><a href="{{ route('material') }}"><span class="fa fa-plus"></span>Add
                                                    Material
                                                    Category</a></li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('brand', $permission))
                                            <li><a href="{{ route('brand') }}"><span class="fa fa-plus"></span>Add
                                                    Brand</a></li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('raw_material', $permission))
                                            <li><a href="{{ route('raw_material') }}"><span
                                                        class="fa fa-plus"></span>Add Raw
                                                    Materials</a>
                                            </li>
                                        @endif


                                    </ul>
                                </li>
                            @endif


                            @if (Auth::user()->panel_role == 1 ||
                                    in_array('non_consumable_unit_type', $permission) ||
                                    in_array('non-consumable-category', $permission) ||
                                    in_array('non-consumable-category-material', $permission) ||
                                    in_array('non_consumable_brand', $permission))
                                <li>
                                    <a href="#" title="Non Consumable Inventory"><span class="fa fa-list">
                                        </span>Non Consumable Inventory</a>
                                    <ul>




                                        @if (Auth::user()->panel_role == 1 || in_array('non_consumable_unit_type', $permission))
                                            <li><a href="{{ route('non_consumable_unit_type') }}"><span
                                                        class="fa fa-plus"></span>Add Unit Type</a>
                                            </li>
                                        @endif



                                        @if (Auth::user()->panel_role == 1 || in_array('non-consumable-category', $permission))
                                            <li><a href="{{ route('non-consumable-category') }}"><span
                                                        class="fa fa-plus"></span>Add Category</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('non-consumable-category-material', $permission))
                                            <li><a href="{{ route('non-consumable-category-material') }}"><span
                                                        class="fa fa-plus"></span>Add Sub Category</a>
                                            </li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('non_consumable_brand', $permission))
                                            <li><a href="{{ route('non_consumable_brand') }}"><span
                                                        class="fa fa-plus"></span>Add Brand</a></li>
                                        @endif

                                    </ul>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('working_unit_type', $permission))
                                <li><a href="{{ route('working_unit_type') }}"><span class="fa fa-plus"></span>Add
                                        Working
                                        Unit Type</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('category', $permission))
                                <li><a href="{{ route('category') }}"><span class="fa fa-plus"></span>Add Task
                                        Category</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('subcategory', $permission))
                                <li><a href="{{ route('subcategory') }}"><span class="fa fa-plus"></span>Add Task Sub
                                        Category</a></li>
                            @endif


                            @if (Auth::user()->panel_role == 1 || in_array('client', $permission))
                                <li><a href="{{ route('client') }}"><span class="fa fa-plus"></span>Add Client</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('site', $permission))
                                <li><a href="{{ route('site') }}"><span class="fa fa-plus"></span>Add Sites</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('warehouse', $permission))
                                <li><a href="{{ route('warehouse') }}"><span class="fa fa-plus"></span>Add
                                        Warehouse</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('vendor', $permission))
                            <li><a href="{{ route('vendor') }}"><span class="fa fa-plus"></span>Add Vendor</a></li>
                        @endif


                            @if (Auth::user()->panel_role == 1 || in_array('site_manager', $permission))
                            <li><a href="{{ route('site_manager') }}"><span class="fa fa-plus"></span>Add Site Manager</a>
                            </li>
                        @endif


                        @if (Auth::user()->panel_role == 1 || in_array('site_incharge', $permission))
                        <li><a href="{{ route('site_incharge') }}"><span class="fa fa-plus"></span>Add Site
                                Incharge</a>
                        </li>
                    @endif

                    @if (Auth::user()->panel_role == 1 || in_array('supervisor', $permission))
                    <li><a href="{{ route('supervisor') }}"><span class="fa fa-plus"></span>Add
                            Supervisor</a>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1 || in_array('engg', $permission))
                <li><a href="{{ route('engg') }}"><span class="fa fa-plus"></span>Add Engineer</a>
                </li>
                 @endif

                 @if (Auth::user()->panel_role == 1 || in_array('contractor', $permission))
                <li><a href="{{ route('contractor') }}"><span class="fa fa-plus"></span>Add
                Contractor</a>
                </li>
                @endif



                            @if (Auth::user()->panel_role == 1 || in_array('employee', $permission))
                                <li><a href="{{ route('employee') }}"><span class="fa fa-plus"></span>Add Employee</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('prediction', $permission))
                            <li style="margin-left:-20px; margin-right:-50px">
                                <a href="prediction" title="Prediction"  style="font-size: 12px; margin-left:20px"><span class="fa fa-plus"> </span>Prediction Calculator</a>

                            </li>
                            @endif



                            @if (Auth::user()->panel_role == 1 || in_array('status', $permission))
                                <li><a href="{{ route('status') }}"><span class="fa fa-plus"></span>Add Status</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('issue', $permission))
                                <li><a href="{{ route('issue') }}"><span class="fa fa-plus"></span>Add Issues</a></li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1 || in_array('assign_site', $permission))
                    <li style="margin-left:-20px;"><a href="{{ route('assign_site') }}"  style="font-size: 12px"><span class="fa fa-location-arrow" style="margin-right: -1px"></span>Assign Site</a>
                    </li>
                @endif


                @if (Auth::user()->panel_role == 1
                || in_array('site_material', $permission)
                || in_array('add_material', $permission)
                || in_array('direct-issue-material', $permission)
                || in_array('site-non-consumed-material', $permission)
                || in_array('non_consumable_add_material', $permission)
                || in_array('non_consumable_direct_issue_material', $permission)
                )

                    <li style="margin-left:-20px;">
                        <a href="#" title="Inventory Managemnt"  style="font-size: 12px"><span class="fa fa-exchange" style="margin-right: -1px; font-size: 12px"> </span>Inventory
                            Managemnt</a>
                        <ul>


                            @if (Auth::user()->panel_role == 1
                            || in_array('site_material', $permission)
                            || in_array('add_material', $permission)
                            || in_array('direct-issue-material', $permission)

                            )
                            <li>
                                <a href="#" title="Consumable Inventory"><span class="fa fa-bars">
                                    </span>Consumable Inventory</a>
                                <ul>
                                    @if (Auth::user()->panel_role == 1 || in_array('site_material', $permission))
                                        <li><a href="{{ route('site_material') }}"><span
                                                    class="fa fa-plus"></span>Site Material Request List</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->panel_role == 1 || in_array('add_material', $permission))
                                        <li><a href="{{ route('add_material') }}"><span class="fa fa-plus"></span>Add
                                                Material</a></li>
                                    @endif


                                    @if (Auth::user()->panel_role == 1 || in_array('direct-issue-material', $permission))
                                        <li><a href="direct-issue-material"><span class="fa fa-plus"></span>Direct
                                                Issue Material</a></li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('', $permission))

                                    <li><a href="#" title="Reports"><span class="fa fa-bars">
                                                </span>Reports</a>
                                            <ul>
                                        @if (Auth::user()->panel_role == 1 || in_array('consumable-available-material', $permission))
                                        <li><a href="{{route('consumable-available-material')}}"><span
                                                    class="fa fa-plus"></span>Available Material</a>
                                        </li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('consumable-consumed-material', $permission))
                                    <li><a href="{{route('consumable-consumed-material')}}"><span
                                                class="fa fa-plus"></span>Consumed Material</a>
                                    </li>
                                @endif

                                @if (Auth::user()->panel_role == 1 || in_array('consumable-lost-material', $permission))
                                <li><a href="consumable-lost-material"><span
                                            class="fa fa-plus"></span>Lost Material</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('consumable-received-material', $permission))
                            <li><a href="consumable-received-material"><span
                                        class="fa fa-plus"></span>Received Material</a>
                            </li>
                        @endif
                                    </ul>
                                @endif

                                </ul>
                            </li>
                            @endif



                            @if (Auth::user()->panel_role == 1
                            || in_array('site-non-consumed-material', $permission)
                            || in_array('non_consumable_add_material', $permission)
                            || in_array('non_consumable_direct_issue_material', $permission)

                            )
                            <li>
                                <a href="#" title="Non Consumable Inventory"><span class="fa fa-bars">
                                    </span>Non Consumable Inventory</a>
                                <ul>

                                    @if (Auth::user()->panel_role == 1 || in_array('site-non-consumed-material', $permission))

                                        <li><a href="{{ route('site-non-consumed-material') }}"><span
                                                    class="fa fa-plus"></span>Non Consumeble Site Material Request
                                                List</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->panel_role == 1 || in_array('non_consumable_add_material', $permission))
                                        <li><a href="{{ route('non_consumable_add_material') }}"><span
                                                    class="fa fa-plus"></span>Non Consumable Add Material</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->panel_role == 1 || in_array('non_consumable_direct_issue_material', $permission))
                                        <li><a href="non_consumable_direct_issue_material"><span
                                                    class="fa fa-plus"></span>Non Consumable Direct Issue Material</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->panel_role == 1 || in_array('', $permission))

                                    <li><a href="#" title="Reports"><span class="fa fa-bars">
                                                </span>Reports</a>
                                            <ul>
                                        @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                        <li><a href=""><span
                                                    class="fa fa-plus"></span>Available Material</a>
                                        </li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                    <li><a href=""><span
                                                class="fa fa-plus"></span>Consumed Material</a>
                                    </li>
                                @endif

                                @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                <li><a href=""><span
                                            class="fa fa-plus"></span>Lost Material</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                            <li><a href=""><span
                                        class="fa fa-plus"></span>Received Material</a>
                            </li>
                        @endif
                                    </ul>
                                @endif


                                </ul>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1
                || in_array('req_material', $permission)
                || in_array('order_details', $permission)
                || in_array('direct-po-list', $permission)
                || in_array('non_consume_req_material', $permission)
                || in_array('non_consumable_order_list', $permission)
                || in_array('non_consumable_directPoList', $permission)
                )

                    <li style="margin-left:-20px;">
                        <a href="#" title="Purchase Department"  style="font-size: 12px"><span class="fa fa-exchange" style="font-size: 12px; margin-right:-1px"> </span>Purchase
                            Department</a>
                        <ul>


                            @if (Auth::user()->panel_role == 1
                            || in_array('req_material', $permission)
                            || in_array('order_details', $permission)
                            || in_array('direct-po-list', $permission)

                            )
                            <li>
                                <a href="#" title="Consumable Purchase"><span class="fa fa-bars">
                                    </span>Consumable Purchase</a>
                                <ul>
                                    @if (Auth::user()->panel_role == 1 || in_array('req_material', $permission))
                                        <li><a href="{{ route('req_material') }}"><span
                                                    class="fa fa-plus"></span>Material
                                                Request
                                                List</a></li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('order_details', $permission))
                                        <li><a href="{{ route('order_details') }}"><span
                                                    class="fa fa-plus"></span>Order
                                                Details
                                                List</a></li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('direct-po-list', $permission))
                                        <li><a href="direct-po-list"><span class="fa fa-plus"></span>Direct PO
                                                List</a></li>
                                    @endif

                                </ul>
                            </li>
                            @endif


                            @if (Auth::user()->panel_role == 1
                            || in_array('non_consume_req_material', $permission)
                            || in_array('non_consumable_order_list', $permission)
                            || in_array('non_consumable_directPoList', $permission)

                            )
                            <li>
                                <a href="#" title="Non Consumable Purchase"><span class="fa fa-bars">
                                    </span>Non Consumable Purchase</a>
                                <ul>


                                    @if (Auth::user()->panel_role == 1 || in_array('non_consume_req_material', $permission))
                                        <li><a href="{{ route('non_consume_req_material') }}"><span
                                                    class="fa fa-plus"></span>Material
                                                Request
                                                List</a></li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('non_consumable_order_list', $permission))
                                        <li><a href="{{ route('non_consumable_order_list') }}"><span
                                                    class="fa fa-plus"></span>Order
                                                Details
                                                List</a></li>
                                    @endif

                                    @if (Auth::user()->panel_role == 1 || in_array('non_consumable_directPoList', $permission))
                                        <li><a href="{{route('non_consumable_directPoList')}}"><span class="fa fa-plus"></span>Direct PO
                                                List</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1
                || in_array('grn', $permission)
                || in_array('direct-grn-in', $permission)
                || in_array('issue_material', $permission)
                || in_array('direct-grn-out', $permission)
                || in_array('non_consumable_grn', $permission)
                || in_array('non_consumable_direct_grn_in', $permission)
                || in_array('non_consumable_grn_out_material', $permission)
                || in_array('non_consumanle_directGrnOut', $permission)
                || in_array('transfer-material', $permission)
                )

                    <li style="margin-left:-20px;">
                        <a href="#" title="Warehouse"  style="font-size: 12px"><span class="fa fa-exchange" style="margin-right: -1px; font-size: 12px"> </span>Warehouse</a>
                        <ul>

                            @if (Auth::user()->panel_role == 1
                            || in_array('grn', $permission)
                            || in_array('direct-grn-in', $permission)
                            || in_array('issue_material', $permission)
                            || in_array('direct-grn-out', $permission)

                            )


                            <li>
                                <a href="#" title="Consumable GRN"><span class="fa fa-exchange"> </span>Consumable GRN</a>
                                <ul>

                                    @if (Auth::user()->panel_role == 1
                                    || in_array('grn', $permission)
                                    || in_array('direct-grn-in', $permission)
                                    )
                            <li>
                                <a href="#" title="GRN In"><span class="fa fa-exchange"> </span>GRN In</a>
                                <ul>
                            @if (Auth::user()->panel_role == 1 || in_array('grn', $permission))
                                <li><a href="{{ route('grn') }}"><span class="fa fa-plus"></span>GRN In</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('direct-grn-in', $permission))
                            <li><a href="direct-grn-in"><span class="fa fa-plus"></span>Direct GRN In</a>
                            </li>
                        @endif
                                </ul>
                            </li>
                            @endif

                            @if (Auth::user()->panel_role == 1
                            || in_array('issue_material', $permission)
                            || in_array('direct-grn-out', $permission)
                            )

                            <li>
                                <a href="#" title="GRN Out"><span class="fa fa-exchange"> </span>GRN Out</a>
                                <ul>

                            @if (Auth::user()->panel_role == 1 || in_array('issue_material', $permission))
                                <li><a href="{{ route('issue_material') }}"><span class="fa fa-plus"></span>GRN
                                        Out</a></li>
                            @endif


                            @if (Auth::user()->panel_role == 1 || in_array('direct-grn-out', $permission))
                                <li><a href="{{route('direct-grn-out')}}"><span class="fa fa-plus"></span>Direct GRN
                                        Out</a></li>
                            @endif
                                </ul>
                            </li>

                            @endif

                                </ul>
                            </li>
                            @endif



                            @if (Auth::user()->panel_role == 1
                            || in_array('non_consumable_grn', $permission)
                            || in_array('non_consumable_direct_grn_in', $permission)
                            || in_array('non_consumable_grn_out_material', $permission)
                            || in_array('non_consumanle_directGrnOut', $permission)

                            )
                            <li>
                                <a href="#" title="Non Consumable GRN"><span class="fa fa-exchange"> </span>Non Consumable GRN</a>
                                <ul>

                                    @if (Auth::user()->panel_role == 1
                                    || in_array('non_consumable_grn', $permission)
                                    || in_array('non_consumable_direct_grn_in', $permission)
                                    )
                            <li>
                                <a href="#" title="GRN In"><span class="fa fa-exchange"> </span>GRN In</a>
                                <ul>
                            @if (Auth::user()->panel_role == 1 || in_array('non_consumable_grn', $permission))
                                <li><a href="{{route('non_consumable_grn')}}"><span class="fa fa-plus"></span>GRN In</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('non_consumable_direct_grn_in', $permission))
                            <li><a href="{{route('non_consumable_direct_grn_in')}}"><span class="fa fa-plus"></span>Direct GRN In</a>
                            </li>
                        @endif
                                </ul>
                            </li>
                            @endif


                            @if (Auth::user()->panel_role == 1
                            || in_array('non_consumable_grn_out_material', $permission)
                            || in_array('non_consumanle_directGrnOut', $permission)

                            )
                            <li>
                                <a href="#" title="GRN Out"><span class="fa fa-exchange"> </span>GRN Out</a>
                                <ul>

                            @if (Auth::user()->panel_role == 1 || in_array('non_consumable_grn_out_material', $permission))
                                <li><a href="{{route('non_consumable_grn_out_material')}}"><span class="fa fa-plus"></span>GRN
                                        Out</a></li>
                            @endif


                            @if (Auth::user()->panel_role == 1 || in_array('non_consumanle_directGrnOut', $permission))
                                <li><a href="{{route('non_consumanle_directGrnOut')}}"><span class="fa fa-plus"></span>Direct GRN
                                        Out</a></li>
                            @endif
                                </ul>
                            </li>
                            @endif

                                </ul>
                            </li>

                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('transfer-material', $permission))

                            <li >
                                <a href="transfer-material"  style="font-size: 12px"><span class="fa fa-truck" style="margin-right: 10px; font-size: 12px"></span>Transfer Material</a></li>
                            @endif

                        </ul>
                    </li>
                @endif


                @if (Auth::user()->panel_role == 1 ||
                        in_array('app-user-roles', $permission) ||
                        in_array('panel-user-roles', $permission) ||
                        in_array('panel-user', $permission))
                    <li style="margin-left:-20px;">
                        <a href="#" title="User Roles"  style="font-size: 12px"><span class="fa fa-user" style="margin-right: -1px; font-size: 12px"> </span>User Roles</a>
                        <ul>
                                @if (Auth::user()->panel_role == 1
                                || in_array('app-user-roles', $permission)
                                )
                                    <li>
                                        <a href="#" title="Mobile App"><span class="fa fa-user"> </span>Mobile
                                            App</a>
                                        <ul>
                                            @if (Auth::user()->panel_role == 1 || in_array('app-user-roles', $permission))
                                                <li><a href="{{ route('app-user-roles') }}"><span
                                                            class="fa fa-plus"></span>User Role</a></li>
                                            @endif

                                            @if (Auth::user()->panel_role == 1 || in_array('app-user', $permission))
                                            <li><a href="{{ route('app-user') }}"><span
                                                        class="fa fa-plus"></span>Add User</a></li>
                                        @endif


                                        </ul>
                                    </li>
                                @endif

                            @if (Auth::user()->panel_role == 1
                            || in_array('panel-user-roles', $permission)
                            || in_array('panel-user', $permission)
                            )
                                <li>
                                    <a href="#" title="Admin Panel"><span class="fa fa-user"> </span>Admin
                                        Panel</a>
                                    <ul>
                                        @if (Auth::user()->panel_role == 1 || in_array('panel-user-roles', $permission))
                                            <li><a href="{{ route('panel-user-roles') }}" title="User Role"><span
                                                        class="fa fa-plus"></span>User Role</a></li>
                                        @endif

                                        @if (Auth::user()->panel_role == 1 || in_array('panel-user', $permission))
                                            <li><a href="{{ route('panel-user') }}" title="Panel User"><span
                                                        class="fa fa-plus"></span>Add User</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1
                            || in_array('track_location', $permission)
                            )
                            <li style="margin-left:-20px;">
                                <a href="{{route('track_location')}}" title="Track Location"  style="font-size: 12px; margin-left:20px"><span class="fa fa-map-marker" style="margin-right: 10px; font-size: 12px"> </span>Track Location</a>
                            </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1
                || in_array('user-logs', $permission)
                )
                <li style="margin-left:-20px;">
                    <a href="{{route('user-logs')}}" title="User Logs"  style="font-size: 12px; margin-left:20px"><span class="fa fa-map-marker" style="margin-right: 10px; font-size: 12px"> </span>User Logs</a>
                </li>
                @endif



                {{-- @if (Auth::user()->panel_role == 1 || in_array('expense-master', $permission))
                    <li  style="margin-left:-20px;">
                        <a href="expense-master" title="Account Department"  style="font-size: 12px"><span class="fa fa-user" style="margin-right: -1px; font-size: 12px"> </span>Account
                            Department</a>

                    </li>
                @endif --}}

            {{-- @if (Auth::user()->panel_role == 1 || in_array('prediction', $permission))
            <li style="margin-left:-20px; margin-right:-50px">
                <a href="prediction" title="Prediction"  style="font-size: 12px"><span class="fa fa-tachometer"> </span></a>

            </li>
            @endif --}}

                {{-- <li>
                <a href="#" title="User Role"><span class="fa fa-money"> </span>User Roles For App</a>

            </li> --}}


                <li class="xn-icon-button pull-right">
                    <a href="{{ route('logout') }}" class="mb-control" data-box="#mb-signout"><span
                            class="fa fa-sign-out"></span></a>
                </li>

                {{-- @if (Auth::user()->role == 1 || in_array('raw_material', $permission)) --}}

                {{-- @endif --}}

                <!-- MESSAGES -->

                <li class="xn-icon-button pull-right"
                    style="margin-right:25px; min-width:100px; color:#FFFFFF; padding-top:20px;">
                    Welcome, Admin
                </li>

            </ul>

            @yield('content')

            <!-- MESSAGE BOX-->
            <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
                <div class="mb-container">
                    <div class="mb-middle">
                        <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                        <div class="mb-content">
                            <p>Are you sure you want to log out?</p>
                            <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                        </div>
                        <div class="mb-footer">
                            <div class="pull-right">
                                <div style="display: flex;">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="margin-right:5px;"
                                            class="btn btn-success btn-lg">Yes</button>
                                    </form>
                                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MESSAGE BOX-->

            <!-- START PRELOADS -->
            <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
            <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
            <!-- END PRELOADS -->


            <!-- START SCRIPTS -->
            <script type="text/javascript" src="{{ asset('public/js/plugins/jquery/jquery.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/jquery/jquery-ui.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap.min.js') }}"></script>
            <!-- END PLUGINS -->
            <!-- THIS PAGE PLUGINS -->
            <script type='text/javascript' src="{{ asset('public/js/plugins/icheck/icheck.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}">
            </script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap-timepicker.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap-colorpicker.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/dropzone/dropzone.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/fileinput/fileinput.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/plugins/filetree/jqueryFileTree.js') }}"></script>
            <!-- END PAGE PLUGINS -->
            <!-- START TEMPLATE -->
            <script type="text/javascript" src="{{ asset('public/js/plugins.js') }}"></script>
            <script type="text/javascript" src="{{ asset('public/js/actions.js') }}"></script>
            <!-- END TEMPLATE -->

            <script>
                $(function() {
                    $("#file-simple").fileinput({
                        showUpload: false,
                        showCaption: false,
                        browseClass: "btn btn-danger",
                        fileType: "any"
                    });
                    $("#filetree").fileTree({
                        root: '/',

                        expandSpeed: 100,
                        collapseSpeed: 100,
                        multiFolder: false
                    }, function(file) {
                        alert(file);
                    }, function(dir) {
                        setTimeout(function() {
                            page_content_onresize();
                        }, 200);
                    });
                });
            </script>

            <script>
                function confirmDelete(Id) {
                    var result = confirm('Are you sure you want to delete this Field?');
                    if (!result) {
                        event.preventDefault(); // Prevent the default action (deletion) if user clicks "Cancel"
                    } else {
                        window.location.href = '{{ url('categoryDestroy') }}/' + categoryId;
                    }
                }
            </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all elements with the class 'alert-temporary'
        var alerts = document.querySelectorAll('.alert-temporary');

        alerts.forEach(function(alert) {
            // Set a timeout to hide the alert after 5 seconds
            setTimeout(function() {
                alert.style.opacity = 0;
                // Optional: Remove the element from the DOM after fade out
                setTimeout(function() {
                    alert.remove();
                }, 500); // Matches the fade out duration
            }, 5000); // Time in milliseconds (5 seconds)
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchButton").addEventListener("click", function() {
            var fromDate = document.getElementById("fromDate").value;
            var toDate = document.getElementById("toDate").value;
            var tableRows = document.querySelectorAll("#example3 tbody tr");

            tableRows.forEach(function(row) {
                var dateColumn = row.querySelector("td:nth-child(2)").innerText;
                var date = new Date(dateColumn.split("-").reverse().join("-"));

                if (date >= new Date(fromDate) && date <= new Date(toDate)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

</body>

</html>

@yield('js')
