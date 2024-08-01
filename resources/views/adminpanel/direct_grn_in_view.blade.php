<form action="{{ route('direct-grn-in-store') }}"  method="post" style="background: white">
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

    <table width="100%" class="col-md-12">
        <tr>

            <table width="100%" border="1" style="margin-top: 5px;">
<tr>

    <input type="hidden" name="material_req_list_id" value="{{ $materialReqListId }}">

        <div class="col-md-2" style="margin:7px">
            <label class="control-label">Received Date<font color="#FF0000">*</font></label>

            <input type="date" class="form-control" name="received_date" placeholder="" required />
        </div>
        <div class="col-md-2" style="margin:7px">
            <label class="control-label">Time<font color="#FF0000">*</font></label>
            <input type="time" class="form-control" name="received_time" placeholder="" required />
        </div>

        <div class="col-md-2" style="margin:7px">
            <label class="control-label">Location (Warehouse)<font color="#FF0000">*</font></label>

                <select class="form-control select" data-live-search="true" name="received_location">
                    <option align="center">--Select--</option>
                    @foreach ($warehouse as $warehouse)
                     <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                     @endforeach
                 </select>
        </div>
        <div class="col-md-2" style="margin:7px">
            <label class="control-label">Received Quantity<font color="#FF0000">*</font></label>
            <input type="text" class="form-control" name="received_quantity" placeholder="" required />
        </div>
        <div class="col-md-3" style="margin:7px">
            <label class="control-label">Received By<font color="#FF0000">*</font></label>
            <input type="text" class="form-control" name="received_by" placeholder="" required />
        </div>

        <div class="col-md-2" style="margin-top:22px; margin-left:10px" align="left">
            <button id="on" type="submit" class="btn mjks"
                style="color:#FFFFFF; height:30px; width:auto;">
                <i class="fa fa-plus"></i>submit</button>

        </div>
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
            var availableMaterial = parseFloat($('input[name="data[' + loopIndex + '][available_material]"]').val()) || 0;
            var issueMaterial = parseFloat($('input[name="data[' + loopIndex + '][issue_material]"]').val()) || 0;
            var remainingMaterial = availableMaterial - issueMaterial;
            $('input[name="data[' + loopIndex + '][remaining_material]"]').val(remainingMaterial);
        }
    });
</script>
