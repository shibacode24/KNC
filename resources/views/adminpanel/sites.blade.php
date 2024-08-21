@extends('layout.header')
@section( 'content' )


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <div class="panel-body" style="padding:1px 5px 2px 5px;">


                <div class="col-md-12" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <h5 class="panel-title"
                            style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                            align="center">
                            <i class="fa fa-bars"></i> &nbsp;Add Sites
                        </h5>



                    </div>
                </div>

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

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">

                            <li class="active"><a href="#tab9" data-toggle="tab">Personal &nbsp;<span
                                        style="color: red;"></span></a></li>
                            <li><a href="#tab10" data-toggle="tab">Business &nbsp;<span
                                        style="color: red;"></span></a></li>

                        </ul>
                        <div class="panel-body tab-content">
                            {{-- personal --}}

                            <div class="tab-pane active" id="tab9">
                                <form action="{{ route('sitepersonalorbuisness.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2">
                                        <label class="control-label">Select Firm<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true" name="firm_id">
                                            @foreach($firm as $firm2)
                                            <option value="{{ $firm2->id }}">{{ $firm2->firm_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="control-label">Select Client<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true" name="client_id">
                                            @foreach($client as $client2)
                                            <option value="{{ $client2->id }}">{{ $client2->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Site Name<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="site_name" placeholder=""
                                            required />
                                    </div>

                                    <input type="hidden" class="form-control" value="personal"
                                        name="site_personal_or_buisness" placeholder="" required />

                                    <div class="col-md-2">
                                        <label class="control-label">Mobile Number<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="mobile_number" placeholder=""
                                            required />
                                    </div>
                                    <div class="col-md-2">
                                        <label>City</label>
                                        <select class="form-control select" data-live-search="true" name="city_id">
                                            @foreach($city as $city1)
                                            <option value="{{ $city1->id }}">{{ $city1->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Address<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="city_address" placeholder=""
                                            required />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Latitude<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="latitude" placeholder=""
                                            required />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Longitude<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="longitude" placeholder=""
                                            required />
                                    </div>
                                    <div class="col-md-4" style="margin-top: 5px;">
                                        <label class="control-label">Site Description<font color="#FF0000">*</font>
                                        </label>
                                        <textarea type="text" class="form-control" name="site_description" rows="2"
                                            cols="5"></textarea>

                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Site Documents<font color="#FF0000">*</font>
                                        </label>
                                        <input type="file" class="form-control" name="site_documents" placeholder="" />
                                    </div>


                                    <div class="col-md-2" style="margin-top:15px;" align="left">
                                        <button id="on" type="submit" class="btn mjks"
                                            style="color:#FFFFFF; height:30px; width:auto;"> <i
                                                class="fa fa-plus"></i>Add</button>

                                    </div>
                                </form>

                                <div class="row">

                                    <div class="col-md-12" style="margin-top:15px;">
                                        <div class="panel panel-default">
                                            <h5 class="panel-title"
                                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                                align="center">
                                                <i class="fa fa-bars"></i> &nbsp;Added Sites
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
                                                        <th>Date</th>
                                                        <th>Site Name</th>
                                                        <th>Address</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($personalSite as $site)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>


                                                        <td>{{ $site->created_at->format('d-m-y') ?? null}}</td>
                                                        <td>{{ $site->site_name ?? null}}</td>
                                                        <td>{{ $site->city_address ?? null}}</td>
                                                        <td>
                                                            <button data-toggle="modal" data-target="#popup1"
                                                                style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                type="button" class="btn btn-info view-site" data-toggle="tooltip"
                                                                data-placement="top" title="View" data-site-id="{{ $site->id }}">
                                                                <i class="fa fa-eye" style="margin-left:5px;"></i>
                                                            </button>

                                                            <a href="{{ route('site-edit', $site->id) }}">
                                                            <button
                                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                                    style="margin-left:5px;"></i></button>
                                                            </a>

                                                                    <a href="{{ route('site-destroy', $site->id) }}"><button
                                                                        style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                                        data-placement="top" title="Delete"
                                                                        onclick="confirmDelete({{ $site->id }})"><i
                                                                            class="fa fa-trash-o" style="margin-left:5px;"></i></button>
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

                            {{-- buisness --}}
                            <div class="tab-pane" id="tab10">
                                <form action="{{ route('sitepersonalorbuisness.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2">
                                        <label class="control-label">Select Firm<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true" name="firm_id">
                                            @foreach($firm as $firm1)
                                            <option value="{{ $firm1->id }}">{{ $firm1->firm_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" value="buisness"
                                        name="site_personal_or_buisness" placeholder="" required />

                                    <div class="col-md-2">
                                        <label class="control-label">Select Client<font color="#FF0000">*</font></label>
                                        <select class="form-control select" data-live-search="true" name="client_id">
                                            @foreach($client as $client1)
                                            <option value="{{ $client1->id }}">{{ $client1->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Business Name<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="buisness_name" placeholder="" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Site Name<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="site_name" placeholder="" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Mobile Number<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="mobile_number" placeholder="" />
                                    </div>
                                    <div class="col-md-2">
                                        <label>City</label>
                                        <select class="form-control select" data-live-search="true" name="city_id">
                                            @foreach($city as $city2)
                                            <option value="{{ $city2->id }}">{{ $city2->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Address<font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="city_address" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Latitude<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="latitude" placeholder="" />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Longitude<font color="#FF0000">*</font></label>
                                        <input type="number" class="form-control" name="longitude" placeholder="" />
                                    </div>
                                    <div class="col-md-4" style="margin-top: 5px;">
                                        <label class="control-label">Site Description<font color="#FF0000">*</font>
                                        </label>
                                        <textarea type="text" class="form-control" name="site_description" rows="2"
                                            cols="5"></textarea>

                                    </div>
                                    <div class="col-md-2" style="margin-top: 5px;">
                                        <label class="control-label">Site Documents<font color="#FF0000">*</font>
                                        </label>
                                        <input type="file" class="form-control" name="site_documents" placeholder="" />
                                    </div>


                                    <div class="col-md-12" style="margin-top:15px;" align="right">
                                        <button id="on" type="submit" class="btn mjks"
                                            style="color:#FFFFFF; height:30px; width:auto;"> <i
                                                class="fa fa-plus"></i>Add</button>

                                    </div>
                                </form>

                                <div class="row">

                                    <div class="col-md-12" style="margin-top:15px;">
                                        <div class="panel panel-default">
                                            <h5 class="panel-title"
                                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                                align="center">
                                                <i class="fa fa-bars"></i> &nbsp;Added Sites
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
                                                        <th>Date</th>
                                                        <th>Site Name</th>
                                                        <th>Address</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($businessSite as $site)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>


                                                        <td>{{ $site->created_at->format('d-m-y') ?? null}}</td>
                                                        <td>{{ $site->site_name ?? null}}</td>
                                                        <td>{{ $site->city_address ?? null}}</td>
                                                        <td>
                                                            <button data-toggle="modal" data-target="#popup1"
                                                                style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                type="button" class="btn btn-info view-site" data-toggle="tooltip"
                                                                data-placement="top" title="View" data-site-id="{{ $site->id }}">
                                                                <i class="fa fa-eye" style="margin-left:5px;"></i>
                                                            </button>
                                                            <a href="{{ route('site-edit', $site->id) }}">
                                                            <button
                                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                                    style="margin-left:5px;"></i></button>
                                                            </a>

                                                                    <a href="{{ route('site-destroy', $site->id) }}"><button
                                                                        style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                                        data-placement="top" title="Delete"
                                                                        onclick="confirmDelete({{ $site->id }})"><i
                                                                            class="fa fa-trash-o" style="margin-left:5px;"></i></button>
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
                {{-- <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Added Sites
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
                                        <th>Date</th>
                                        <th>Site Name</th>
                                        <th>Address</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personalSite as $site)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>


                                        <td>{{ $site->created_at->format('d-m-y') ?? null}}</td>
                                        <td>{{ $site->site_name ?? null}}</td>
                                        <td>{{ $site->city_address ?? null}}</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#popup1"
                                                style="background-color:#1abc3d; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info view-site" data-toggle="tooltip"
                                                data-placement="top" title="View" data-site-id="{{ $site->id }}">
                                                <i class="fa fa-eye" style="margin-left:5px;"></i>
                                            </button>
                                            <button
                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button>


                                                    <a href="{{ route('site-destroy', $site->id) }}"><button
                                                        style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        onclick="confirmDelete({{ $site->id }})"><i
                                                            class="fa fa-trash-o" style="margin-left:5px;"></i></button>
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
                </div> --}}
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
<div class="modal" id="popup1" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="H4">Site Details</h4>
            </div>
            <div class="modal-body" style="height:30%">
                <div class="col-md-12" style="overflow-x: scroll;">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Firm Name</th>
                                <th>Client</th>
                                <th>Site Name</th>
                                <th>Mobile Number</th>
                                <th>City</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Site Address </th>
                                <th>Site Description </th>
                                <th>Site Documents </th>
                            </tr>
                        </thead>
                        <tbody id="siteData">
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="border: none !important; background-color: #FFF !important;">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('js')
<script>
    $(document).ready(function() {
$('.view-site').click(function() {
var siteId = $(this).data('site-id');
$.ajax({
url: '{{ route("sites.index") }}' + '/' + siteId, // Pass siteId in the URL
type: 'GET',
dataType: 'json',
success: function(response) {
// Update modal body with site data
var siteData = $('#siteData');
siteData.empty();
siteData.append('<tr>' +
    '<td>' + response.id + '</td>' + // Assuming 'id' is the primary key of Site model
    '<td>' + response.firm.firm_name + '</td>' +
    '<td>' + response.client.name + '</td>' +
    '<td>' + response.site_name + '</td>' +
    '<td>' + response.mobile_number + '</td>' +
    '<td>' + response.cityname.city + '</td>' +
    '<td>' + response.latitude + '</td>' +
    '<td>' + response.longitude + '</td>' +
    '<td>' + response.city_address + '</td>' +
    '<td>' + response.site_description + '</td>' +
    '<td>' + (response.site_documents ? '<a href="{{ asset(" public/images/site/") }}' + '/' + response.site_documents
            + '" download>' + response.site_documents + '</a>' : 'No document available' ) + '</td>' + '</tr>' ); },
            error: function(xhr, status, error) { console.error(xhr.responseText); } }); }); });
</script>
@stop
