@extends('layout.header')
@section('content')
    {{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>KNC-Expense Master</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="../../logo/favicon.png" type="image/x-icon" />
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="../../css/theme-default.css" />
    <link rel="stylesheet" type="text/css" id="theme" href="../../css/notification.css" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>
    <style>
        .mjbo {
            outline: 2px solid #08c8ea;
            outline-offset: 2px;
        }

        .mjprofile {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 20px;
            border-color: rgba(0, 0, 0, .2);
            color: #000;
            -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
        }
        .mjks {
background-color:#006699;
color:#FFF !important;
}
.mjks:hover {
background-color:#a8dbee;
color:#fff !important;
}
.tree {
color: #000000;
}
.tree:hover{
color: #003300;
}
.subtree {
color: #006699;
}
.subtree:hover{
color: #0099cc;
}
.subtreeactive{
color: #006699;
}
.mjksactive {
background-color:#006699 ;
color:#000 !important;
}
.mjkslink {
background-color:#ffffff;
color: white;

}
.mjkslink:hover {
background-color:#006699;

}
    </style>
    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top">
        <!-- PAGE CONTENT -->
        <div class="page-content">

            <ul class="x-navigation x-navigation-horizontal">
                <li class="xn-logo" style="margin-right:30px;">
                    <a> <img src="../../logo/logo.png" alt="" style="margin-top:-12px;"/></a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                  <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="assets/images/users/avatar.jpg" alt="EMR - OPD Software"/>
                    </a>
                </li>
                <li>
                    <a href="dashboard.html" title="Dashboard"><span class="fa fa-desktop"> </span>Dashboard</a>

                </li>

                <li>
                    <a href="city.html" title="Masters"><span class="fa fa-list"> </span>Masters</a>
                    <ul>
                        <li><a href="assign_task.html"><span class="fa fa-bars"></span>Assign Task</a></li>
                        <li><a href="city.html"><span class="fa fa-plus"></span>Add City</a></li>
                        <li><a href="firm.html"><span class="fa fa-plus"></span>Add Firm</a></li>
                        <li><a href="branch.html"><span class="fa fa-plus"></span>Add Branch</a></li>
                        <li><a href="client.html"><span class="fa fa-plus"></span>Add Client</a></li>
                        <li><a href="sites.html"><span class="fa fa-plus"></span>Add Sites</a></li>
                        <li><a href="unit_type.html"><span class="fa fa-plus"></span>Add Unit Type</a></li>
                        <li><a href="material.html"><span class="fa fa-plus"></span>Add Material</a></li>
                        <li><a href="raw_material.html"><span class="fa fa-plus"></span>Add Raw Materials</a></li>
                        <li><a href="brand.html"><span class="fa fa-plus"></span>Add Brand</a></li>
                        <li><a href="warehouse.html"><span class="fa fa-plus"></span>Add Warehouse</a></li>
                        <li><a href="contractor.html"><span class="fa fa-plus"></span>Add Contractor</a></li>
                        <li><a href="vendor.html"><span class="fa fa-plus"></span>Add Vendor</a></li>
                        <li><a href="supervisor.html"><span class="fa fa-plus"></span>Add Supervisor</a></li>
                        <li><a href="employee.html"><span class="fa fa-plus"></span>Add Employes</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" title="Inventory Mgt"><span class="fa fa-exchange"> </span>Inventory Managemnt</a>
                    <ul>
                        <li><a href="site_material.html"><span class="fa fa-plus"></span>Site Material Request List</a></li>
                        <li><a href="add_material.html"><span class="fa fa-plus"></span>Add Material</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#" title="Warehouse"><span class="fa fa-database"> </span>Warehouse</a>
                    <ul>
                        <li><a href="grn.html"><span class="fa fa-plus"></span>GRN</a></li>
                        <li><a href="issue_material.html"><span class="fa fa-plus"></span>Issue Material</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#" title="Purchase Department"><span class="fa fa-money"> </span>Purchase Department</a>
                    <ul>
                        <li><a href="req_material.html"><span class="fa fa-plus"></span>Material Request List</a></li>
                        <li><a href="order_details.html"><span class="fa fa-plus"></span>Order Details List</a></li>
                        <li><a href="feedback.html"><span class="fa fa-plus"></span>Feedback</a></li>
                    </ul>
                </li>
                <li>
                    <a href="expense_master.html" title="Account Department"><span class="fa fa-money"> </span>Account Department</a>

                </li>
                 <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                </li>
                <!-- MESSAGES -->
                <li class="xn-icon-button pull-right" style="margin-right:25px; min-width:100px; color:#FFFFFF; padding-top:20px;">
                    Welcome, Admin
                </li>

            </ul>
                <!-- END X-NAVIGATION --> --}}

    <div class="page-content-wrap">
        <!-- <div class="page-content-wrap">
                         -->
        <div class="row">

            <div class="col-md-12" style="margin-top:5px;">
                <a href="expense-master"> <button id="on" type="button" class="btn mjks"
                        style="color:#FFFFFF; height:30px; width:auto;background-color: #d54e10; "><i
                            class="fa fa-user"></i>Expense Masters</button>
                </a>

                <a href="income-billing"> <button id="on" type="button" class="btn mjks"
                        style="color:#FFFFFF; height:30px; width:auto;background-color: #990066;"><i
                            class="fa fa-plus"></i>Income/Billing</button>
                </a>
                <a href="expense-entry"> <button id="on" type="button" class="btn mjks"
                        style="color:#FFFFFF; height:30px; width:auto;background-color: #009999;"><i
                            class="fa fa-plus"></i>Expense Entry</button>
                </a>
            </div>
        </div>
        <!-- </div> -->
        <div class="row">
            <div class="col-md-12" style="text-align: center;margin-top: 5px;">
                <h6 class="panel-title"
                    style="color:#FFFFFF; background-color:#d54e10; width:100%;height: 50%; font-size:16px;" align="center">
                    <i class="fa fa-file-text"><label style="margin: 7px;">Expense Master</label> </i>
                </h6>


            </div>
            <div class="col-md-6" style="margin-top: 2vh;">
                <h3 style="font-weight: bold;">Expense Category</h3>
                <form action="{{ route('expence_category_create') }}" method="post">
                    @csrf
                    <div class="col-md-12" style="margin-top: 2vh;">
                        <table width="50%">
                            <tr style="height:30px;">

                                <th width="5%">Add Expense Category</th>

                                <th width="1%"></th>
                            </tr>


                            <tr>


                                <td style="padding: 2px;" width="1%">
                                    <input type="text" class="form-control" name="expence_category" placeholder="" />
                                </td>

                                <td>
                                    <button id="on" type="submit" class="btn mjks"
                                        style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;"><i
                                            class="fa fa-floppy-o" aria-hidden="true"></i>
                                        Submit</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </form>
                <div class="col-md-12" style="margin-top: 2vh;">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Added Expense Category</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expence_categorys as $expence_category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expence_category->expence_category }}</td>

                                    <td>

                                        <a href="{{ route('edit_expence_category', $expence_category->id) }}">
                                            <button
                                                style="background-color:#0d710d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button>
                                        </a>
                                        <a href="{{ route('expence_category_delete', $expence_category->id) }}">
                                            <button
                                                style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fa fa-trash-o"
                                                    style="margin-left:5px;"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 2vh;">
                <h3 style="font-weight: bold;">Expense Head</h3>
                <form action="{{ route('expence_category_head') }}" method="post">
                    @csrf
                    <div class="col-md-12" style="margin-top: 2vh;">
                        <table width="100%">
                            <tr style="height:30px;">

                                <th width="25%">Select Expense Category</th>

                                <th width="25%" style="padding-left: 1vh;">Add Expense Head</th>

                            </tr>


                            <tr>


                                <td style="padding: 2px;" width="25%">
                                    <select class="form-control select" data-live-search="true" name="expence_category_id">
                                        <option value="">Select</option>
                                        @foreach ($expence_categorys as $expence)
                                            <option value="{{ $expence->id }}">{{ $expence->expence_category }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td style="padding: 2px;padding-left: 1vh;" width="25%">
                                    <input type="text" class="form-control" name="expence_head" placeholder="" />
                                </td>

                                <td>
                                    <button id="on" type="submit" class="btn mjks"
                                        style="color:#FFFFFF; height:30px; width:auto;background-color: #006699;"><i
                                            class="fa fa-floppy-o" aria-hidden="true"></i>
                                        Submit</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </form>
                <div class="col-md-12" style="margin-top: 2vh;">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Selected Expense Category</th>
                                <th>Added Expense Head</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expence_head as $expence_heads)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expence_heads->expence_name->expence_category ?? '' }}</td>

                                    <td>{{ $expence_heads->expence_head }}</td>
                                    <td>

                                        <a href="{{ route('edit_expence_head', $expence_heads->id) }}">
                                            <button
                                                style="background-color:#0d710d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button>
                                        </a>
                                        <a href="{{ route('expence_head_delete', $expence_heads->id) }}">
                                            <button
                                                style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fa fa-trash-o"
                                                    style="margin-left:5px;"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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

    <!-- MESSAGE BOX-->
    {{-- <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to log out?</p>
                    <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
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
    <script type="text/javascript" src="../../js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- END PLUGINS -->
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src='../../js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript" src="../../js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap-file-input.js"></script>
    <script type="text/javascript" src="../../js/plugins/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="../../js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/fileinput/fileinput.min.js"></script>
    <script type="text/javascript" src="../../js/plugins/filetree/jqueryFileTree.js"></script>
    <!-- END PAGE PLUGINS -->
    <!-- START TEMPLATE -->
    <script type="text/javascript" src="../../js/plugins.js"></script>
    <script type="text/javascript" src="../../js/actions.js"></script>
    <!-- END TEMPLATE -->


    <script>
        $(function () {
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
            }, function (file) {
                alert(file);
            }, function (dir) {
                setTimeout(function () {
                    page_content_onresize();
                }, 200);
            });
        });
    </script>
</body>

</html> --}}
@endsection
