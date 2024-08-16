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
                                <i class="fa fa-plus"></i> &nbsp;Add Firm
                            </h5>


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


                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">

                        <form action="{{ route('firm.store') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div>
                                                -->
                            <div class="col-md-2">
                                <label class="control-label">Firm Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="firm_name" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Contact Person Name<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="contact_person_name" placeholder=""
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Contact Number<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="contact_number" maxlength="10"
                                    placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label>City</label>
                                <select class="form-control select" name="city_id" data-live-search="true">
                                    @foreach ($city as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Address<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="city_address" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Latitude<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="latitude" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">Longitude<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="longitude" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">GST<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="gst" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top:15px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Add</button>

                            </div>
                        </form>

                    </div>
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-plus"></i> &nbsp;Added Firm
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
                                            <th>Firm Name</th>
                                            <th>Contact Person Name</th>
                                            <th>Contact Number</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>GST</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($firm as $index => $firm)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $firm->firm_name ?? null }}</td>
                                                <td>{{ $firm->contact_person_name ?? null }}</td>
                                                <td>{{ $firm->contact_number ?? null }}</td>
                                                <td>{{ $firm->cityname->city ?? null }}</td>
                                                <td>{{ $firm->city_address ?? null }}</td>
                                                <td>{{ $firm->latitude ?? null }}</td>
                                                <td>{{ $firm->longitude ?? null }}</td>
                                                <td>{{ $firm->gst ?? null }}</td>
                                                <td>
                                                    <!-- HTML buttons for Edit and Delete -->
                                                    <a href="{{ route('firm-edit', $firm->id) }}"><button
                                                        style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Edit"><i class="fa fa-edit"
                                                            style="margin-left:5px;"></i></button></a>


                                                    <a href="{{ route('firm-destroy', $firm->id) }}"><button
                                                            style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="confirmDelete({{ $firm->id }})"><i
                                                                class="fa fa-trash-o"
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
@stop
