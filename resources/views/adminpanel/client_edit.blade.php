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
                        <form action="{{ route('client-update') }}" method="post">
                            @csrf
                            <!-- <div class="col-md-4"></div>-->

                            <input type="hidden" name="id" value="{{$clientEdit->id}}">
                            <div class="col-md-2">
                                <label class="control-label">Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="name" value="{{$clientEdit->name}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Email<font color="#FF0000">*</font></label>
                                <input type="email" class="form-control" name="email" value="{{$clientEdit->email}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Mobile Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="mobile_number" value="{{$clientEdit->mobile_number}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">WhatsApp Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="whatsapp_number" value="{{$clientEdit->whatsapp_number}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Aadhar Number<font color="#FF0000">*</font></label>
                                <input type="number" class="form-control" name="aadhar_number" value="{{$clientEdit->aadhar_number}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">PAN Number<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="pan_number" value="{{$clientEdit->pan_number}}" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label>City</label>
                                <select class="form-control select" data-live-search="true" name="city_id">
                                    @foreach ($city as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', $clientEdit->city_id) == $city->id ? 'selected' : '' }}>

                                            {{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">Address<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="address" value="{{$clientEdit->address}}" placeholder="" required />
                            </div>


                            <div class="col-md-2" style="margin-top:15px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Add</button>

                            </div>
                        </form>
                    </div>


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
