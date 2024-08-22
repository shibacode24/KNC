{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <style>
        #map {
            height: 500px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4"></script>
</head>
<body>
    <div id="map"></div>

    <script>
        function initMap() {
            // Get the coordinate from the server
            var coordinateFromServer = @json($coordinate);

            // Initialize the map with the coordinate from the server
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)}
            });

            // Add a marker for the server coordinate
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)},
                map: map,
                title: 'Server Location'
            });

            // Use Geolocation API to get the current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentPos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Add a marker for the current location
                    var currentMarker = new google.maps.Marker({
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
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.log(browserHasGeolocation
                        ? 'Error: The Geolocation service failed.'
                        : 'Error: Your browser doesn\'t support geolocation.');
        }

        document.addEventListener("DOMContentLoaded", function() {
            initMap();
        });
    </script>
</body>
</html> --}}


@extends('layout.header')
@section('content')
<style>
    #map {
        height: 500px;
    }
</style>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&callback=initMap" async defer></script> --}}

<div id="map"></div>

<script>
    function initMap() {
        // Get the coordinate from the server
        var coordinateFromServer = @json($coordinate);

        // Initialize the map with the coordinate from the server
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)}
        });

        // Add a marker for the server coordinate
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(coordinateFromServer.latitude), lng: parseFloat(coordinateFromServer.longitude)},
            map: map,
            title: 'Server Location'
        });

        // Use Geolocation API to get the current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var currentPos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Add a marker for the current location
                var currentMarker = new google.maps.Marker({
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
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, pos) {
        console.log(browserHasGeolocation
                    ? 'Error: The Geolocation service failed.'
                    : 'Error: Your browser doesn\'t support geolocation.');
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
    });
</script>
@stop
