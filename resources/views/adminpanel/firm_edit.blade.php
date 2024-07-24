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



                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('firm-update') }}" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{$firmEdit->id}}"/>

                            <!-- <div class="col-md-4"></div>
                                                -->
                            <div class="col-md-2">
                                <label class="control-label">Firm Name<font color="#FF0000">*</font></label>

                                <input type="text" class="form-control" name="firm_name" value="{{$firmEdit->firm_name}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Contact Person Name<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="contact_person_name" value="{{$firmEdit->contact_person_name}}" placeholder=""
                                    required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Contact Number<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="contact_number" value="{{$firmEdit->contact_number}}" maxlength="10"
                                    placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label>City</label>
                                <select class="form-control select" name="city_id" data-live-search="true">
                                    @foreach ($city as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $firmEdit->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Address<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="city_address" value="{{$firmEdit->city_address}}" placeholder="" required />
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Latitude<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="latitude" value="{{$firmEdit->latitude}}" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">Longitude<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="longitude" value="{{$firmEdit->longitude}}" placeholder="" required />
                            </div>
                            <div class="col-md-2" style="margin-top: 5px;">
                                <label class="control-label">GST<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="gst" value="{{$firmEdit->gst}}" placeholder="" required />
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
