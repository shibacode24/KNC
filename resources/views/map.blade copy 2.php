@extends('layout.header')

@section('title', 'Map')

@section('styles')
    <style>
        #map {
            height: 500px;
            width: 100%; /* Ensure the map takes full width */
        }
    </style>
@endsection

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
                            <i class="fa fa-plus"></i> &nbsp;Track Location
                        </h5>



                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('map') }}" method="get">
                        @csrf
                        {{-- <div class="col-md-1"></div> --}}

                        <div class="col-md-2">
                            <label class="control-label">Select Employee Type<font color="#FF0000">*</font></label>
                            <select id="employeeTypeSelect" name="employee" class="form-control">
                                <option value="">--Select--</option>
                                <option value="Site-Manager">Site Manager</option>
                                <option value="Site-Incharge">Site Incharge</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Engineer">Engineer</option>
                            </select>
                        </div>
                        {{-- <div class="col-md-2"> --}}
                            {{-- <label class="control-label">Select Employee<font color="#FF0000">*</font></label>
                            <select id="employeeSelect" name="emp_id" class="form-control">
                                <option value="">--Select--</option>
                                @foreach($emp as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->emp_id }}</option>
                                @endforeach
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div> --}}

                        <div class="col-md-2">
                            <label class="control-label">Select Employee<font color="#FF0000">*</font></label>
                            <select id="employeeSelect" name="emp_id" class="form-control">
                                <option value="">--Select--</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">From Date<font color="#FF0000">*</font></label>
                            <input type="date" class="form-control" name="from_date" placeholder="" required />
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">To Date<font color="#FF0000">*</font></label>
                            <input type="date" class="form-control" name="to_date" placeholder="" required />
                        </div>
                        <div class="col-md-2" style="margin-top:15px; margin-bottom:20px" align="left">
                            <button id="on" type="submit" class="btn mjks"
                                style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i>Search</button>

                        </div>
                    </form>
                </div>
                </div>
        </div>
    </div>


</div>




    <div id="map"></div>
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&callback=initMap" async defer></script>
    {{-- <script>

        function initMap() {
            var coordinateFromServer = @json($coordinate);

            if (!coordinateFromServer || !coordinateFromServer.latitude || !coordinateFromServer.longitude) {
                console.error('Invalid coordinate data');
                return;
            }

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)}
            });

            new google.maps.Marker({
                position: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)},
                map: map,
                title: 'Server Location'
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentPos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    new google.maps.Marker({
                        position: currentPos,
                        map: map,
                        title: 'Current Location'
                    });

                    var flightPlanCoordinates = [
                        {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)},
                        {lat: currentPos.lat, lng: currentPos.lng}
                    ];

                    var flightPath = new google.maps.Polyline({
                        path: flightPlanCoordinates,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 4
                    });

                    flightPath.setMap(map);
                    map.setCenter(currentPos);
                }, function() {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                handleLocationError(false, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.log(browserHasGeolocation
                        ? 'Error: The Geolocation service failed.'
                        : 'Error: Your browser doesn\'t support geolocation.');
        }
    </script> --}}
    <script>
        function initMap() {
            var selectedLocation = @json($selectedEmployeeLocation);
            var allLocations = @json($allLocations);

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: selectedLocation ? {lat: parseFloat(selectedLocation.latitude), lng: parseFloat(selectedLocation.longitude)} : {lat: 0, lng: 0}
            });

            if (selectedLocation) {
                new google.maps.Marker({
                    position: {lat: parseFloat(selectedLocation.latitude), lng: parseFloat(selectedLocation.longitude)},
                    map: map,
                    title: 'Selected Employee Location'
                });
            }

            allLocations.forEach(function(location) {
                new google.maps.Marker({
                    position: {lat: parseFloat(location.latitude), lng: parseFloat(location.longitude)},
                    map: map,
                    title: 'Employee Location'
                });
            });
        }
    </script>

{{-- <script>
    $(document).ready(function() {
        $('#employeeTypeSelect').change(function() {
            var selectedType = $(this).val();

            $.ajax({
                url: '{{ route('filterEmployees') }}',  // Adjust route as needed
                type: 'GET',
                data: { type: selectedType },
                success: function(data) {
                    var $employeeSelect = $('#employeeSelect');
                    $employeeSelect.empty();
                    $employeeSelect.append('<option value="">--Select--</option>');
                    $.each(data, function(index, employee) {
                        $employeeSelect.append('<option value="' + employee.id + '">' + employee.emp_id + '</option>');
                    });
                }
            });
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        $('#employeeTypeSelect').change(function() {
            var selectedType = $(this).val();

            $.ajax({
                url: '{{ route('filterEmployees') }}',  // Adjust route as needed
                type: 'GET',
                data: { type: selectedType },
                success: function(data) {
                    var $employeeSelect = $('#employeeSelect');
                    $employeeSelect.empty();
                    $employeeSelect.append('<option value="">--Select--</option>');
                    $.each(data, function(index, employee) {
                        $employeeSelect.append('<option value="' + employee.id + '">' + employee.name + '</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
