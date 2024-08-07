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
                                <i class="fa fa-plus"></i> &nbsp;Transfer Material
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                        <form action="{{route('transfer-material.store')}}" method="post">
                            @csrf
                            <div class="col-md-2"></div>

                            <div class="col-md-2">
                                <label class="control-label">Select Transfer Type<font color="#FF0000">*</font></label>
                                <select class="form-control select" data-live-search="true" name="transfer_type" id="transfer_type">
                                    <option value="">--Select--</option>
                                    <option value="Warehouse-to-Warehouse">Warehouse to Warehouse</option>
                                    <option value="Warehouse-to-Site">Warehouse to Site</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Select Source Location<font color="#FF0000">*</font></label>
                                <select name="source_location" id="source_location" class="form-control select">
                                    @foreach($warehousesArray as $warehouse)
                                    <option value="{{ $warehouse['id'] }}">{{ $warehouse['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Select Target Location<font color="#FF0000">*</font></label>
                                <select name="target_location" id="target_location" class="form-control select">
                                    <!-- Options will be dynamically updated based on transfer type -->
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-top:15px;" align="left">
                                <button id="on" type="submit" class="btn mjks"
                                    style="color:#FFFFFF; height:30px; width:auto;">
                                    <i class="fa fa-plus"></i>Transfer</button>
                            </div>
                        </form>
                    </div>

                    <!-- The rest of your template code remains unchanged -->
                    <div class="row">

                        <div class="col-md-12" style="margin-top:15px;">
                            <div class="panel panel-default">
                                <h5 class="panel-title"
                                    style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;"
                                    align="center">
                                    <i class="fa fa-bars"></i> &nbsp;Transfered Material
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
                                            <th>Transfer Type</th>
                                            <th>Source Location</th>
                                            <th>Target Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transferedMaterial as $index => $material)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $material->transfer_type}}</td>
                                            <td>{{ $material->sourceWarehouseName->warehouse_name ?? '' }}</td>
                                            <td>
                                                @if($material->transfer_type === 'Warehouse-to-Warehouse')
                                                    {{ $material->targetWarehouseName->warehouse_name ?? '' }}
                                                @else
                                                    {{ $material->siteName->site_name ?? '' }}
                                                @endif
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
@endsection
@section('js')
<script>
    $(document).ready(function() {
        const transferType = $('#transfer_type');
        const targetLocation = $('#target_location');

        // Fetch options from Blade
        const siteOptions = @json($sitesArray);
        const warehouseOptions = @json($warehousesArray);

        console.log('Site Options:', siteOptions);
        console.log('Warehouse Options:', warehouseOptions);

        transferType.change(function() {
            console.log('Transfer type changed:', this.value); // Check if this is logged

            const selectedType = this.value;
            let options = '';
            console.log('Warehouse Options:', warehouseOptions);
            console.log('Site Options:', siteOptions);
            if (selectedType === 'Warehouse-to-Warehouse') {
                warehouseOptions.forEach(warehouse => {
                    options += `<option value="${warehouse.id}">${warehouse.name}</option>`;
                });
            } else if (selectedType === 'Warehouse-to-Site') {
                siteOptions.forEach(site => {
                    options += `<option value="${site.id}">${site.name}</option>`;
                });
            }

            targetLocation.html(options);

            // Reinitialize the bootstrap-select
            targetLocation.selectpicker('refresh');
        });

        // Initialize bootstrap-select on page load
        targetLocation.selectpicker();
    });
</script>
@stop


