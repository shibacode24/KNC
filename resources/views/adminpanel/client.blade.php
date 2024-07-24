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
                                <i class="fa fa-users"></i> &nbsp;Add Client
                            </h5>



                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('client.store') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div>
                                                    -->
                            <div class="col-md-2">
                                <label class="control-label">Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="name" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Email<font color="#FF0000">*</font></label>
                                <input type="email" class="form-control" name="email" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Mobile Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="mobile_number" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">WhatsApp Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="whatsapp_number" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Aadhar Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="aadhar_number" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">PAN Number<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="pan_number" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label>City</label>
                                <select class="form-control select" data-live-search="true" name="city_id">
                                    @foreach ($city as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">Address<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="address" placeholder="" required />
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
                                    <i class="fa fa-users"></i> &nbsp;Added Client
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>WhatsApp Number</th>
                                            <th>Aadhar Number</th>
                                            <th>PAN Number</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($client as $index => $client)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->mobile_number }}</td>
                                                <td>{{ $client->whatsapp_number }}</td>
                                                <td>{{ $client->aadhar_number }}</td>
                                                <td>{{ $client->pan_number }}</td>
                                                <td>{{ $client->cityname->city ?? null }}</td>
                                                <td>{{ $client->city_address }}</td>
                                                <td>

                                                    <a href="{{ route('client-edit', $client->id) }}"><button
                                                        style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Edit"><i class="fa fa-edit"
                                                            style="margin-left:5px;"></i></button></a>

                                                    <a href="{{ route('client-destroy', $client->id) }}"><button
                                                            style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="confirmDelete({{ $client->id }})"><i
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
