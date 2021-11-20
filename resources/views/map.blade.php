<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 500px;
            z-index:999999999;
            border:1px solid #ccc;
            float:left;
            width:97%;
            position:relative;
            bottom:0;
        }
    </style>
    <title>Map</title>
    <script>
        var users = <?php use Illuminate\Support\Facades\Auth; echo json_encode($users); ?>;
        var loggedInUserLat = <?php echo json_encode(Auth::user()->latitude); ?>;
        var loggedInUserLon = <?php echo json_encode(Auth::user()->longitude); ?>;
        function initMap() {
            var latlng = new google.maps.LatLng( loggedInUserLat, loggedInUserLon);
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: latlng,
            });

            setMarkers(map);
        }

        // Data for the markers consisting of a name, a LatLng and a zIndex for the
        // order in which these markers should display on top of each other.


        function setMarkers(map) {
            // Adds markers to the map.
            // Marker sizes are expressed as a Size of X,Y where the origin of the image
            // (0,0) is located in the top left of the image.
            // Origins, anchor positions and coordinates of the marker increase in the X
            // direction to the right and in the Y direction down.
            const image = {
                url: "https://mts.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=A&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1",
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(20, 32),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(0, 32),
            };
            // Shapes define the clickable region of the icon. The type defines an HTML
            // <area> element 'poly' which traces out a polygon as a series of X,Y points.
            // The final coordinate closes the poly by connecting to the first coordinate.
            const shape = {
                coords: [1, 1, 1, 20, 18, 20, 18, 1],
                type: "poly",
            };
            const locations = [];

            locations.push(23.759739);
            locations.push(90.392418);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.759739, 90.392418),
                map: map,
                draggable: false,
                anchorPoint: new google.maps.Point(0, -29),
            });

            for (var key in users) {
                var value = users[key];

                locations.push(value.latitude);
                locations.push(value.longitude);

                var location = new google.maps.LatLng(value.latitude, value.longitude);
                var labels = value.name;
                labelIndex = 0;

                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable: false,
                    title: labels,
                    anchorPoint: new google.maps.Point(0, -29),
                    label: labels[labelIndex++ % labels.length],
                });

            }

        }// JavaScript Document
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbEeUbn4iZTXVViqFHw6YKf7J6pqhWwr4&callback=initMap&fullscreen=0" async></script>


