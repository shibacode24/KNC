<form action="{{route('add-issued-material')}}" method="post" style="background: white">
    @csrf

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

    <table width="100%" class="col-md-12">


        <tr>
            <table width="100%" border="1" style="margin-top: 5px;">
                <tr style="background-color:#f0f0f0; height:30px;">
                    <th width="3%" style="text-align:center;">Sr.No</th>
                    {{-- <th width="5%" style="text-align:center">Req. ID</th> --}}
                    <th width="5%" style="text-align:center">Material</th>
                    <th width="5%" style="text-align:center">Raw Material</th>
                    <th width="5%" style="text-align:center">Brand</th>
                    <th width="5%" style="text-align:center">Req. Quantity</th>
                   {{--  <th width="6%" style="text-align:center">Material Unit</th>--}}
                    <th width="11%" style="text-align:center">Select Warehouse<strong><font color="#FF0000">*</font></strong></th>
                    <th width="10%" style="text-align:center">Available Material<strong><font color="#FF0000">*</font></strong></th>
                    <th width="10%" style="text-align:center">Issue Material<strong><font color="#FF0000">*</font></strong></th>
                    <th width="10%" style="text-align:center">Remaining Material<strong><font color="#FF0000">*</font></strong></th>
                    <th width="2%" style="text-align:center">Remark</th>
                    <th width="11%" style="text-align:center">Status<strong><font color="#FF0000">*</font></strong></th>
                    <th width="5%" style="text-align:center">Action </th>
                </tr>

                    @foreach ($appendData as $data)
                    <tr>
                        <td style="padding:5px;" align="center">
                            {{$loop->iteration}}
                        </td>
                        {{-- <td style="padding:5px;" align="center"> --}}
                            <input type="hidden" name="data[{{ $loop->index }}][id]" value="{{ $data->id }}">
                            {{-- {{ $data->id }} --}}
                        {{-- </td> --}}
                        <td style="padding:5px;" align="center">
                            <input type="hidden" name="data[{{ $loop->index }}][material]" value="{{ $data->material_id }}">
                            {{ $data->material_name->material }}
                        </td>
                        <td style="padding:5px;" align="center">
                            <input type="hidden" name="data[{{ $loop->index }}][raw_material]" value="{{ $data->raw_material_id }}">
                            {{ $data->raw_material_name->raw_material_name }}
                        </td>
                        <td style="padding:5px;" align="center">
                            <input type="hidden" name="data[{{ $loop->index }}][brand]" value="{{ $data->brand_id }}">
                            {{ $data->brand_name->brand }}
                        </td>
                        <td style="padding:5px;" align="center">
                            <input type="hidden" name="data[{{ $loop->index }}][quantity]" value="{{ $data->requested_quantity }}">
                            {{ $data->requested_quantity }}
                        </td>
                       <td style="padding:5px;" align="center">
                            <input type="hidden" name="data[{{ $loop->index }}][unit_type]" value="{{ $data->material_unit_type_id }}">
                            {{ $data->unit_type->unit_type }}
                        </td>
                        <td style="padding:10px;" align="center">
                            <select class="form-control select" data-live-search="true" name="data[{{ $loop->index }}][warehouse]" data-loop-index="{{ $loop->index }}" required>
                                <option align="center">Select</option>
                                @foreach ($warehouseId as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="padding:5px;" align="center">
                            <input type="text" class="form-control available-material" name="data[{{ $loop->index }}][available_material]" placeholder="" style="color: #707B7C;" value="" readonly/>
                            </td>
                        <td style="padding:10px;" align="center">
                            <input type="text" class="form-control issue-material" name="data[{{ $loop->index }}][issue_material]" data-loop-index="{{ $loop->index }}" placeholder="" />
                        </td>
                        <td style="padding:5px;" align="center">
                            <input type="text" class="form-control remaining-material" name="data[{{ $loop->index }}][remaining_material]" placeholder="" style="color: #707B7C;" readonly />

                        </td>
                        <td style="padding:2px;" align="center">
                            <textarea name="data[{{ $loop->index }}][remark]" cols="10" rows="3"></textarea>
                        </td>

                        <td style="padding:10px;" align="center">
                            <select class="form-control select" data-live-search="true" name="data[{{  $loop->index }}][status]" data-loop-index="{{  $loop->index }}">
                                @foreach ($statusId as $status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="text-align:center;">
                            <button type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">Submit</button>
                        </td>
                    </tr>
                @endforeach

            </table>
        </tr>
    </table>
    </tr>
    </table>

</form>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select').change(function() {
            var warehouseId = $(this).val();
            var loopIndex = $(this).data('loop-index');
            var availableMaterialField = $('input[name="data[' + loopIndex + '][available_material]"]');

            if (warehouseId) {
                $.ajax({
                    url: '{{ route("get-available-material") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        warehouse_id: warehouseId
                    },
                    success: function(response) {
                        availableMaterialField.val(response.available_material);
                    }
                });
            } else {
                availableMaterialField.val('');
                updateRemainingMaterial(loopIndex);
            }
        });

        $('.issue-material').on('input', function() {
            var loopIndex = $(this).data('loop-index');
            updateRemainingMaterial(loopIndex);
        });

        function updateRemainingMaterial(loopIndex) {
            var availableMaterial = parseFloat($('input[name="data[' + loopIndex + '][quantity]"]').val()) || 0;
            var issueMaterial = parseFloat($('input[name="data[' + loopIndex + '][issue_material]"]').val()) || 0;
            var remainingMaterial = availableMaterial - issueMaterial;
            $('input[name="data[' + loopIndex + '][remaining_material]"]').val(remainingMaterial);
        }
    });
</script>
