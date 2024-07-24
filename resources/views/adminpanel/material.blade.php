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
                            <i class="fa fa-plus"></i> &nbsp;Add Material
                        </h5>



                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('material.store') }}" method="post">
                        @csrf
                        <div class="col-md-3"></div>

                        <div class="col-md-2">
                            <label class="control-label">Add Material<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="material" placeholder="" required />
                        </div>

                        <div class="col-md-2">
                            <label>Select Unit Type</label>
                            <select class="form-control select" data-live-search="true" name="unit_type"
                                id="unit_type">
                                @foreach($unit_type as $unit_type)
                                <option value="{{ $unit_type->id }}">{{ $unit_type->unit_type }}</option>
                                @endforeach
                            </select>
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
                                <i class="fa fa-plus"></i> &nbsp;Added Material
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
                                        <th>Material</th>
                                        <th>Unit Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($material as $material)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>


                                        <td>{{ $material->material ?? null}}</td>
                                        <td>{{ $material->unit_type->unit_type ?? null}}</td>

                                        <td>

                                            <a href="{{ route('material-edit', $material->id) }}"><button
                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button>
                                                </a>

                                                    <a href="{{ route('material-destroy', $material->id) }}"><button
                                                        style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        onclick="confirmDelete({{ $material->id }})"><i
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
