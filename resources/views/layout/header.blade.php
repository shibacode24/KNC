<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>KNC</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ asset('public/logo/favicon.png') }}" type="image/x-icon" />
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('public/css/theme-default.css') }}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('public/css/notification.css') }}" />
    <!-- EOF CSS INCLUDE -->


    <!-- Include select2 library -->
    {{-- <link href="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js')}}"></script> --}}


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
    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top">
        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal">


                <li class="xn-logo" style="margin-right:30px;">
                    <a> <img src="{{ asset('public/logo/logo.png') }}" alt="" style="margin-top:-12px;" /></a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="{{ asset('public/assets/images/users/avatar.jpg') }}" alt="EMR - OPD Software" />
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" title="Dashboard"><span class="fa fa-desktop">
                        </span>Dashboard</a>

                </li>

                @php
                    $permission = Auth::user()->permission;
                    // echo $permission;
                @endphp


            @if (Auth::user()->panel_role == 1 || in_array('assign_site', $permission) || in_array('city', $permission))
                <li>
                    <a href="#" title="Masters"><span class="fa fa-list"> </span>Masters</a>
                    <ul>

                        {{-- @if (Auth::user()->panel_role == 1 || in_array('assign_site', $permission))
                            <li><a href="{{ route('assign_site') }}"><span class="fa fa-bars"></span>Assign Site</a>
                            </li>
                        @endif --}}

                        @if (Auth::user()->panel_role == 1 || in_array('city', $permission))
                            <li><a href="{{ route('city') }}"><span class="fa fa-plus"></span>Add City</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('firm', $permission))
                            <li><a href="{{ route('firm') }}"><span class="fa fa-plus"></span>Add Firm</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('branch', $permission))
                            <li><a href="{{ route('branch') }}"><span class="fa fa-plus"></span>Add Branch</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('client', $permission))
                            <li><a href="{{ route('client') }}"><span class="fa fa-plus"></span>Add Client</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('site', $permission))
                            <li><a href="{{ route('site') }}"><span class="fa fa-plus"></span>Add Sites</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('material', $permission) || in_array('brand', $permission)
                        || in_array('raw_material', $permission) || in_array('unit_type', $permission))
                        <li>
                            <a href="#" title="Consumable Inventory"><span class="fa fa-list"> </span>Consumable Inventory</a>
                            <ul>


                        @if (Auth::user()->panel_role == 1 || in_array('unit_type', $permission))
                        <li><a href="{{ route('unit_type') }}"><span class="fa fa-plus"></span>Add Unit Type</a>
                        </li>
                       @endif

                        @if (Auth::user()->panel_role == 1 || in_array('material', $permission))
                            <li><a href="{{ route('material') }}"><span class="fa fa-plus"></span>Add Material
                                    Category</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('brand', $permission))
                            <li><a href="{{ route('brand') }}"><span class="fa fa-plus"></span>Add Brand</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('raw_material', $permission))
                            <li><a href="{{ route('raw_material') }}"><span class="fa fa-plus"></span>Add Raw
                                    Materials</a>
                            </li>
                        @endif


                            </ul>
                        </li>
                        @endif

                        {{-- @if (Auth::user()->panel_role == 1 || in_array('material', $permission) || in_array('brand', $permission)
                        || in_array('raw_material', $permission) || in_array('unit_type', $permission))
                        <li>
                            <a href="#" title="Assign Site"><span class="fa fa-list"> </span>Assign Site</a>
                            <ul> --}}

                            {{-- </ul>
                        </li>
                        @endif --}}

                        @if (Auth::user()->panel_role == 1 || in_array('material', $permission) || in_array('brand', $permission)
                        || in_array('raw_material', $permission) || in_array('unit_type', $permission))
                        <li>
                            <a href="#" title="Non Consumable Inventory"><span class="fa fa-list"> </span>Non Consumable Inventory</a>
                            <ul>


                                @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                <li><a href=""><span class="fa fa-plus"></span>Add Unit Type</a>
                                </li>
                               @endif


                                @if (Auth::user()->panel_role == 1 || in_array('non-consumable-category', $permission))
                                <li><a href="{{ route('non-consumable-category') }}"><span class="fa fa-plus"></span>Add Category</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('non-consumable-category-material', $permission))
                                <li><a href="{{ route('non-consumable-category-material') }}"><span
                                            class="fa fa-plus"></span>Add Category Material</a>
                                </li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                            <li><a href=""><span class="fa fa-plus"></span>Add Brand</a></li>
                        @endif

                            </ul>
                        </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('working_unit_type', $permission))
                            <li><a href="{{ route('working_unit_type') }}"><span class="fa fa-plus"></span>Add Working
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



                        @if (Auth::user()->panel_role == 1 || in_array('warehouse', $permission))
                            <li><a href="{{ route('warehouse') }}"><span class="fa fa-plus"></span>Add Warehouse</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('contractor', $permission))
                            <li><a href="{{ route('contractor') }}"><span class="fa fa-plus"></span>Add Contractor</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('vendor', $permission))
                            <li><a href="{{ route('vendor') }}"><span class="fa fa-plus"></span>Add Vendor</a></li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('supervisor', $permission))
                            <li><a href="{{ route('supervisor') }}"><span class="fa fa-plus"></span>Add Supervisor</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('employee', $permission))
                            <li><a href="{{ route('employee') }}"><span class="fa fa-plus"></span>Add Employes</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('engg', $permission))
                            <li><a href="{{ route('engg') }}"><span class="fa fa-plus"></span>Add Engineers</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('site_manager', $permission))
                            <li><a href="{{ route('site_manager') }}"><span class="fa fa-plus"></span>Add Site Manager</a>
                            </li>
                        @endif

                        @if (Auth::user()->panel_role == 1 || in_array('site_incharge', $permission))
                            <li><a href="{{ route('site_incharge') }}"><span class="fa fa-plus"></span>Add Site Incharge</a>
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
                    <li><a href="{{ route('assign_site') }}"><span class="fa fa-bars"></span>Assign Site</a>
                    </li>
                @endif


                    @if (Auth::user()->panel_role == 1 || in_array('site_material', $permission) || in_array('add_material', $permission))

                    <li>
                        <a href="#" title="Inventory Managemnt"><span class="fa fa-exchange"> </span>Inventory
                            Managemnt</a>
                        <ul>
                            {{-- @if (Auth::user()->panel_role == 1 || in_array('assign_site', $permission))
                            <li><a href="{{ route('assign_site') }}"><span class="fa fa-bars"></span>Assign Site</a></li>
                        @endif --}}
 {{-- @if (Auth::user()->panel_role == 1 || in_array('site_material', $permission) || in_array('add_material', $permission)) --}}

 <li>
    <a href="#" title="Consumable Inventory"><span class="fa fa-bars"> </span>Consumable Inventory</a>
    <ul>
                             @if (Auth::user()->panel_role == 1 || in_array('site_material', $permission))
                        <li><a href="{{ route('site_material') }}"><span class="fa fa-plus"></span>Site Material Request List</a>
                        </li>
                        @endif
                            @if (Auth::user()->panel_role == 1 || in_array('add_material', $permission))
                                <li><a href="{{ route('add_material') }}"><span class="fa fa-plus"></span>Add
                                        Material</a></li>
                            @endif


                            @if (Auth::user()->panel_role == 1 || in_array('direct-issue-material', $permission))
                                <li><a href="direct-issue-material"><span class="fa fa-plus"></span>Direct Issue Material</a></li>
                            @endif
    </ul>
 </li>
 {{-- @endif --}}
                            {{-- @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                <li><a href=""><span class="fa fa-plus"></span>Transfer Stock</a></li>
                            @endif --}}


                            {{-- @if (Auth::user()->panel_role == 1 || in_array('site_material', $permission) || in_array('add_material', $permission)) --}}

                            <li>
                                <a href="#" title="Non Consumable Inventory"><span class="fa fa-bars"> </span>Non Consumable Inventory</a>
                                <ul>
                            @if (Auth::user()->panel_role == 1 || in_array('site-non-consumed-material', $permission))
                                <li><a href="{{ route('site-non-consumed-material') }}"><span
                                            class="fa fa-plus"></span>Site Non-Consumed Material Request List</a>
                                </li>
                            @endif
                                </ul>
                            </li>
                            {{-- @endif --}}
                        </ul>
                    </li>
                @endif


                @if (Auth::user()->panel_role == 1 ||
                        in_array('req_material', $permission) ||
                        in_array('order_details', $permission) ||
                        in_array('direct-po-list', $permission))

                    <li>
                        <a href="#" title="Purchase Department"><span class="fa fa-money"> </span>Purchase
                            Department</a>
                        <ul>
                            @if (Auth::user()->panel_role == 1 || in_array('req_material', $permission))
                                <li><a href="{{ route('req_material') }}"><span class="fa fa-plus"></span>Material
                                        Request
                                        List</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('order_details', $permission))
                                <li><a href="{{ route('order_details') }}"><span class="fa fa-plus"></span>Order
                                        Details
                                        List</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('direct-po-list', $permission))
                                <li><a href="direct-po-list"><span class="fa fa-plus"></span>Direct PO
                                        List</a></li>
                            @endif

                            {{-- @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                                <li><a href="{{ route('feedback') }}"><span class="fa fa-plus"></span>Feedback</a>
                                </li>
                            @endif --}}

                        </ul>
                    </li>
                @endif

                @if (Auth::user()->panel_role == 1 || in_array('grn', $permission) || in_array('issue_material', $permission))

                    <li>
                        <a href="#" title="Warehouse"><span class="fa fa-exchange"> </span>Warehouse</a>
                        <ul>
                            @if (Auth::user()->panel_role == 1 || in_array('grn', $permission))
                                <li><a href="{{ route('grn') }}"><span class="fa fa-plus"></span>GRN IN</a>
                                </li>
                            @endif


                            @if (Auth::user()->panel_role == 1 || in_array('issue_material', $permission))
                                <li><a href="{{ route('issue_material') }}"><span class="fa fa-plus"></span>GRN
                                        OUT</a></li>
                            @endif

                            @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                            <li><a href="{{ route('') }}"><span class="fa fa-plus"></span>Direct GRN IN</a>
                            </li>
                        @endif


                        @if (Auth::user()->panel_role == 1 || in_array('', $permission))
                            <li><a href="{{ route('') }}"><span class="fa fa-plus"></span>Direct GRN
                                    OUT</a></li>
                        @endif
                        </ul>
                    </li>
                @endif



                    {{-- <li>
                <a href="#" title="Warehouse"><span class="fa fa-list"> </span>Warehouse</a>
                <ul>
                    @if (Auth::user()->panel_role == 1 || in_array('grn', $permission))

                        <li><a href="{{ route('grn') }}"><span class="fa fa-plus"></span>GRN In</a></li>
                    @endif

                        @if (Auth::user()->panel_role == 1 || in_array('issue_material', $permission))

                            <li><a href="{{ route('issue_material') }}"><span class="fa fa-plus"></span>GRN
                                    Out</a>
                        </li>
                    @endif


                </ul>
            </li> --}}
            @if (Auth::user()->panel_role == 1 || in_array('app-user-roles', $permission) || in_array('panel-user-roles', $permission)
            || in_array('panel-user', $permission))
            <li>
                    <a href="#" title="User Roles"><span class="fa fa-user"> </span>User Roles</a>
                <ul>
                    @if (Auth::user()->panel_role == 1 || in_array('app-user-roles', $permission))
                    <li>
                            <a href="#" title="Mobile App"><span class="fa fa-user"> </span>Mobile App</a>
                        <ul>
                    @if (Auth::user()->panel_role == 1 || in_array('app-user-roles', $permission))
                            <li><a href="app-user-roles"><span class="fa fa-plus"></span>User Role</a>
                            </li>
            @endif
                        </ul>
                    </li>
                    @endif
                    @if (Auth::user()->panel_role == 1 || in_array('panel-user-roles', $permission) || in_array('panel-user', $permission))
                    <li>
                            <a href="#" title="Admin Panel"><span class="fa fa-user"> </span>Admin Panel</a>
                        <ul>
                @if (Auth::user()->panel_role == 1 || in_array('panel-user-roles', $permission))
                    <li>
                        <a href="{{ route('panel-user-roles') }}" title="User Role"><span class="fa fa-plus">
                            </span>User Role</a>

                    </li>
                @endif

                @if (Auth::user()->panel_role == 1 || in_array('panel-user', $permission))
                    <li>
                        <a href="{{ route('panel-user') }}" title="Panel User"><span class="fa fa-plus">
                            </span>Add User</a>

                    </li>
                @endif
                        </ul>
                    </li>
                    @endif
            </ul>
            </li>
            @endif

            @if (Auth::user()->panel_role == 1 || in_array('expense-master', $permission))

            <li>
                <a href="#" title="Account Department"><span class="fa fa-user"> </span>Account Department</a>
                <ul>
                    @if (Auth::user()->panel_role == 1 || in_array('expense-master', $permission))
                        <li><a href="expense-master"><span class="fa fa-plus"></span>Expenses</a></li>
                    @endif
                </ul>
            </li>
            @endif
        {{--

            <li>
                <a href="#" title="Prediction"><span class="fa fa-tachometer"> </span></a>

            </li> --}}

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
</body>

</html>

@yield('js')
