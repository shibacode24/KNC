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
                            <i class="fa fa-bars"></i> &nbsp;Add Vendor
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
                <form action="{{ route('vendor.store') }}" method="post">
                    @csrf
                    <div class="col-md-12" style="margin-top:10px;">

                        <!-- <div class="col-md-4"></div>
                                            -->
                        <div class="col-md-2">
                            <label class="control-label">Name<font color="#FF0000">*</font></label>

                            <input type="text" class="form-control" name="vendor_name" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Email<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="email" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Mobile Number<font color="#FF0000">*</font></label>
                            <input type="number" class="form-control" name="mobile_number" placeholder="" />
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Aadhar Number<font color="#FF0000">*</font></label>
                            <input type="number" class="form-control" name="aadhar_number" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">PAN Number<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="pan_number" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label>City</label>
                            <select class="form-control select" data-live-search="true" name="city_id">
                                @foreach($city as $city)
                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">Address<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" name="city_address" placeholder="" />
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label>Select Brand</label>
                            <select class="form-control select" data-live-search="true" name="brand_id">
                                @foreach($brand as $b)
                                <option value="{{ $b->id }}">{{ $b->brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label>Select Materials</label>
                            <select class="form-control select" data-live-search="true" name="material_id">
                                @foreach($material as $m)
                                <option value="{{ $m->id }}">{{ $m->material }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top: 5px;margin-bottom: 5px;">
                            <img src="{{ asset('public/img/line.png') }}" width="100%" />
                            <!-- <h6>Bank Details</h6> -->
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">Account Holder<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" id="name" placeholder="" />
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">Bank Name<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" id="bank" placeholder="" />
                        </div>

                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">Account Number<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" id="ac_n" placeholder="" />
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <label class="control-label">IFSC Code<font color="#FF0000">*</font></label>
                            <input type="text" class="form-control" id="ifsc" placeholder="" />
                        </div>
                        <div class="col-md-2" style="margin-top:20px;" align="left">
                            <button id="on" type="button" class="btn mjks add-row-purchase"
                                style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus "></i></button>

                        </div>
                        <div class="col-md-8" style="margin-top:10px;" align="right">
                            <table width="100%" border="1">
                                <tr style="background-color:#f0f0f0; height:30px;">
                                    <th width="20%" style="text-align:center">Account Holder Name</th>
                                    <th width="20%" style="text-align:center">Bank Name</th>
                                    <th width="20%" style="text-align:center">Account No</th>
                                    <th width="20%" style="text-align:center">IFSC</th>

                                    <th width="20%" style="text-align:center">Action</th>
                                </tr>


                                <tbody class="add_more_purchase">



                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-2" style="margin-top:20px;" align="left">
                            <button id="on" type="submit" class="btn mjks"
                                style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-file"></i>Submit</button>

                        </div>
                    </div>
                </form>

                {{-- apppended supervisor data end--}}
                <div class="row">

                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="panel panel-default">
                            <h5 class="panel-title"
                                style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                align="center">
                                <i class="fa fa-bars"></i> &nbsp;Added Vendor
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
                                        {{-- <th>WhatsApp Number</th> --}}
                                        <th>Aadhar Number</th>
                                        <th>PAN Number</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Brand</th>
                                        <th>Material</th>
                                        <th>Status</th>
                                        {{-- <th>Account Holder Name</th>
                                        <th>Bank Name</th>
                                        <th>Account Number</th>
                                        <th>IFSC</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vendor as $index => $vendor)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $vendor->vendor_name}}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->mobile_number }}</td>
                                        {{-- <td>{{ $vendor->vendor->whatsapp_number }}</td> --}}
                                        <td>{{ $vendor->aadhar_number }}</td>
                                        <td>{{ $vendor->pan_number }}</td>
                                        <td>{{ $vendor->cityname->city ?? '' }}</td>
                                        <td>{{ $vendor->city_address ?? '' }}</td>
                                        <td>{{ $vendor->brandname->brand ?? ''}}</td>
                                        <td>{{ $vendor->materialname->material ?? ''}}</td>
                                        {{-- <td>{{ $vendor->account_holder }}</td>
                                        <td>{{ $vendor->bank_name }}</td>
                                        <td>{{ $vendor->account_number }}</td>
                                        <td>{{ $vendor->ifsc_code }}</td> --}}
                                        <td style="background-color: #ffffff;">
                                            <div class="d-flex align-items-center">

                                                       <?php if ($vendor->status=='1'){?>

                                                        <a href="{{url('/update_vendor_status', $vendor->id)}}"
                                                            class="btn btn-success"> Active</a>

                                                            <?php } else {?>
                                                            <a href="{{url('/update_vendor_status', $vendor->id)}}"
                                                                class="btn btn-danger">Inactive</a>
                                                                <?php
                                                        }?>
                                                        </td>


                                        <td>

                                            {{-- <button
                                                style="background-color:#3399ff; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                type="button" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fa fa-edit"
                                                    style="margin-left:5px;"></i></button> --}}

                                                    {{-- <a href="{{ route('vendor-destroy', $vendor->id) }}"><button
                                                        style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;"
                                                        type="button" class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Delete"
                                                        onclick="confirmDelete({{ $vendor->id }})"><i
                                                            class="fa fa-trash-o" style="margin-left:5px;"></i></button>
                                                </a> --}}

                                                <a href="{{route('vendor-edit',$vendor->id)}}">    <button
                                                    style="background-color:#3399ff; border:none; max-height:25px; margin-bottom:-5px;"
                                                    type="button" class="btn btn-info" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"><i class="fa fa-edit"
                                                        style="margin-left:5px;"></i></button>

                                            </a>

                                                {{-- @if($vendor->vendorn)

                                                <a href="{{ route('vendor-destroy', $vendor->vendorn->id) }}" onclick="return confirm('Are you sure you want to delete this Vendor?')">
                                                    <button style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o" style="margin-left:5px;"></i></button>
                                                </a>
                                                @endif --}}
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
<script>
    $(document).ready(function() {
    $(".add-row-purchase").click(function() {
        var name = $('#name').val();
        var bank = $('#bank').val();
        var ac_n = $('#ac_n').val();
        var ifsc_code = $('#ifsc').val();

        // Check if any of the fields are empty
        if (name === '' || bank === '' || ac_n === '' || ifsc_code === '') {
            // If any field is empty, show a message
            alert('Please fill all the fields before appending.');
        } else {
            // If all fields are filled, proceed with appending
            var markup =
                '<tr>' +
                '<td>' +
                '<input type="hidden" name="name[]" required="" style="border:none; width: 100%;" value="' + name + '">' +
                '<input type="text" required="" style="border:none; width: 100%;" value="' + name + '">' +
                '</td>' +
                '<td>' +
                '<input type="hidden" name="bank[]" required="" style="border:none; width: 100%;" value="' + bank + '">' +
                '<input type="text" required="" style="border:none; width: 100%;" value="' + bank + '">' +
                '</td>' +
                '<td>' +
                '<input type="hidden" name="ac_n[]" required="" style="border:none; width: 100%;" value="' + ac_n + '">' +
                '<input type="text" required="" style="border:none; width: 100%;" value="' + ac_n + '">' +
                '</td>' +
                '<td>' +
                '<input type="text" name="ifsc[]" required="" style="border:none; width: 100%;" value="' + ifsc_code + '">' +
                '</td>' +
                '<td style="text-align:center; color:#FF0000">' +
                '<button class="delete-row"><i class="fa fa-trash-o"></i></button>' +
                '</td>' +
                '</tr>';

            $(".add_more_purchase").append(markup);

            // Clear the input fields
            $('#name').val('');
            $('#bank').val('');
            $('#ac_n').val('');
            $('#ifsc').val('');
        }
    });

    $("tbody").delegate(".delete-row", "click", function() {
        $(this).parents("tr").remove();
    });
});
</script>



<script>
    const toggleButton = document.getElementById('toggleButton');
toggleButton.addEventListener('click', function() {
    const currentStatus = toggleButton.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    toggleButton.setAttribute('data-status', newStatus);
    toggleButton.classList.toggle('toggled', newStatus === 'active');
});
</script>

@stop
