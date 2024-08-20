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
                        <h5 class="panel-title" style="color:#FFFFFF; background-color:#006699; width:100%; font-size:14px;margin-top: 1vh;" align="center">
                            <i class="fa fa-plus"></i> &nbsp;Track Location
                        </h5>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="{{ route('track_location') }}" method="get">
                        @csrf
                        <div class="col-md-2">
                            <label class="control-label">Select Employee Type<font color="#FF0000">*</font></label>
                            <select id="employeeTypeSelect" name="employee" class="form-control select">
                                <option value="">--Select--</option>
                                <option value="Site-Manager">Site Manager</option>
                                <option value="Site-Incharge">Site Incharge</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Engineer">Engineer</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Select Employee<font color="#FF0000">*</font></label>
                            <select id="employeeSelect" name="emp_id" class="form-control">
                                <option value="">--Select--</option>
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
                            <button id="on" type="submit" class="btn mjks" style="color:#FFFFFF; height:30px; width:auto;">
                                <i class="fa fa-plus"></i> Search
                            </button>
                        </div>
                    </form>

                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div id="map"></div> --}}
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&callback=initMap" async defer></script>

    <script>
  $(document).ready(function() {
    $('#employeeTypeSelect').change(function() {
        var selectedType = $(this).val();

        $.ajax({
            url: '{{ route('filterEmployees') }}',
            type: 'GET',
            data: { type: selectedType },
            success: function(data) {
                console.log('Data received:', data); // Verify the data received

                var $employeeSelect = $('#employeeSelect');
                $employeeSelect.empty();
                $employeeSelect.append('<option value="">--Select--</option>');

                if (Array.isArray(data)) {
                    data.forEach(function(employee) {
                        console.log('Appending employee:', employee); // Verify data being appended
                        $employeeSelect.append('<option value="' + employee.id + '">' + employee.name + '</option>');
                    });

                    // Trigger change event to update dropdown
                //     $employeeSelect.trigger('change');
                // } else {
                //     console.error('Unexpected data format:', data);
                // }
                    // Optionally force a repaint
                    $employeeSelect[0].style.display = 'none';
                            $employeeSelect[0].offsetHeight; // Trigger reflow
                            $employeeSelect[0].style.display = 'block';
                        } else {
                            console.error('Unexpected data format:', data);
                        }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});


    </script>

{{-- <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: { lat: 0, lng: 0 } // Placeholder center, will be updated
        });

        var locations = @json($locations); // Ensure $locations is a collection or array
        var latestLocation = @json($latestLocation); // Ensure $latestLocation is an object

        if (latestLocation && latestLocation.latitude && latestLocation.longitude) {
            var latestLatLng = {
                lat: parseFloat(latestLocation.latitude),
                lng: parseFloat(latestLocation.longitude)
            };
            console.log(latestLatLng);

            map.setCenter(latestLatLng);

            new google.maps.Marker({
                position: latestLatLng,
                map: map,
                title: 'Latest Location'
            });
        } else {
            console.error('Invalid latest location data:', latestLocation);
        }

        if (Array.isArray(locations) && locations.length) {
            locations.forEach(function(location) {
                if (location.latitude && location.longitude) {
                    new google.maps.Marker({
                        position: {
                            lat: parseFloat(location.latitude),
                            lng: parseFloat(location.longitude)
                        },
                        map: map,
                        title: new Date(location.created_at).toLocaleString()
                    });
                } else {
                    console.error('Invalid location data:', location);
                }
            });
        } else {
            console.error('No locations data or invalid format:', locations);
        }
    }

    $(document).ready(function() {
        initMap();
    });
</script> --}}


{{-- <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: { lat: 0, lng: 0 } // Placeholder center, will be updated
        });

        var locations = @json($locations); // Ensure $locations is a collection or array
        var latestLocation = @json($latestLocation); // Ensure $latestLocation is an object

        var pathCoordinates = []; // To store the coordinates for the polyline

        // Define custom icon sizes
        var iconSize = new google.maps.Size(20, 20); // Width: 20px, Height: 20px

        if (locations.length) {
            locations.forEach(function(location, index) {
                var latLng = {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude)
                };

                pathCoordinates.push(latLng);

                new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: new Date(location.created_at).toLocaleString(),
                    icon: {
                        url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png', // Blue dot for historical locations
                        scaledSize: iconSize // Apply custom size
                    }
                });
            });
        }

        if (latestLocation) {
            var latestLatLng = {
                lat: parseFloat(latestLocation.latitude),
                lng: parseFloat(latestLocation.longitude)
            };

            // Update the map center to the latest location
            map.setCenter(latestLatLng);

            // Add marker for the latest location with a distinct icon
            new google.maps.Marker({
                position: latestLatLng,
                map: map,
                title: 'Current Location',
                // icon:  'http://maps.google.com/mapfiles/ms/icons/red-dot.png', // Red dot for the current location

            });
        }

        // Draw the polyline
        if (pathCoordinates.length) {
            var path = new google.maps.Polyline({
                path: pathCoordinates,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            path.setMap(map);
        }
    }

    $(document).ready(function() {
        initMap();
    });
</script> --}}

<script>

$(document).ready(function() {
    // Initialize the map
    initMap();

    // Handle employee type change to filter employees
    $('#employeeTypeSelect').change(function() {
        var selectedType = $(this).val();

        $.ajax({
            url: '{{ route('filterEmployees') }}',
            type: 'GET',
            data: { type: selectedType },
            success: function(data) {
                var $employeeSelect = $('#employeeSelect');
                $employeeSelect.empty();
                $employeeSelect.append('<option value="">--Select--</option>');

                if (Array.isArray(data)) {
                    data.forEach(function(employee) {
                        $employeeSelect.append('<option value="' + employee.id + '">' + employee.name + '</option>');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: 0, lng: 0 } // Placeholder center
    });

    var locations = @json($locations);
    var latestLocation = @json($latestLocation);

    var pathCoordinates = [];
    var iconSize = new google.maps.Size(20, 20);

    if (locations.length) {
        locations.forEach(function(location) {
            var latLng = {
                lat: parseFloat(location.latitude),
                lng: parseFloat(location.longitude)
            };

            pathCoordinates.push(latLng);

            new google.maps.Marker({
                position: latLng,
                map: map,
                title: new Date(location.created_at).toLocaleString(),
                icon: {
                    url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: iconSize
                }
            });
        });
    }

    if (latestLocation) {
        var latestLatLng = {
            lat: parseFloat(latestLocation.latitude),
            lng: parseFloat(latestLocation.longitude)
        };

        map.setCenter(latestLatLng);

        new google.maps.Marker({
            position: latestLatLng,
            map: map,
            title: 'Current Location'
        });
    }

    if (pathCoordinates.length) {
        var path = new google.maps.Polyline({
            path: pathCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        path.setMap(map);
    }
}

</script>

@endsection
