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
                                <i class="fa fa-plus"></i> &nbsp;Add City
                            </h5>


                            @if ($errors->any())
                            <div class="alert alert-danger mt-2 alert-temporary">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-temporary">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-temporary">
                                {{ session('error') }}
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{ route('city.store') }}" method="post">
                            @csrf
                            <div class="col-md-4"></div>

                            <div class="col-md-2">
                                <label class="control-label">Add City<font color="#FF0000">*</font></label>
                                <input type="text" class="form-control" name="city" placeholder="" required />
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
                                    <i class="fa fa-plus"></i> &nbsp;Added City
                                </h5>



                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top:15px;"></div>
                        <div class="col-md-8" style="margin-top:15px;">

                            <!-- START DEFAULT DATATABLE -->

                            <!-- <h5 class="panel-title" style="color:#FFFFFF; background-color:#754d35; width:100%; font-size:14px;" align="center"> <i class="fa fa-plus"></i> Added Party</h5> -->
                            <div class="panel-body" style="margin-top:5px; margin-bottom:15px;">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>City</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($city->sortByDesc('created_at') as $city)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>


                                                <td>{{ $city->city ?? null }}</td>
                                                <td>

                                                    <a href="{{ route('city-edit', $city->id) }}"><button
                                                        style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Edit"><i class="fa fa-edit"
                                                        {{-- onclick="confirmDelete({{ $city->id }})" --}}
                                                            style="margin-left:5px;"></i></button></a>


                                                    <a href="{{ route('city-destroy', $city->id) }}"><button
                                                            style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                            type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="confirmDelete({{ $city->id }})"><i
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
