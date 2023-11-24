@push('css')
    <style>
        #map {
            height: 400px;
            width: 600px;
        }
    </style>
@endpush

<div class="row">

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('country_id') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.country_id') }}</span></label>
            <select name="country_id" id="country_id" class="form-control select2">
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @isset($stoppage) @if($stoppage->city->country->id == $country->id) selected @endif @endisset>{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('city_id') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.city_id') }}</span></label>
            <select name="city_id" id="city_id" class="form-control select2">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" @isset($stoppage) @if($stoppage->city_id == $city->id) selected @endif @endisset>{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('name') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.name') }}</span></label>
            <input type="text" name="name" id="name" class="form-control"
                value="@if (isset($stoppage)) {{ $stoppage->name }}@else{{ old('name') }} @endif">
            @error('name')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('slug') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.slug') }}</span></label>
            <input type="text" name="slug" id="slug" class="form-control"
                value="@if (isset($stoppage)) {{ $stoppage->slug }}@else{{ old('slug') }} @endif">
            @error('slug')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('lat') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.lat') }}</span></label>
            <input type="text" name="lat" id="lat" class="form-control"
                value="@if (isset($stoppage)) {{ $stoppage->lat }}@else{{ old('lat') }} @endif">
            @error('lat')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('lon') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('stoppage::stoppage.form.lon') }}</span></label>
            <input type="text" name="lon" id="lon" class="form-control"
                value="@if (isset($stoppage)) {{ $stoppage->lon }}@else{{ old('lon') }} @endif">
            @error('lon')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <input type="text" id="location-input" placeholder="Enter a location" style="position: relative;
    top: 48px;
    left: 200px;
    z-index: 1;
    width: auto;">

    <div id="map" style="height: 400px; width: 100%; margin-bottom: 50px;"></div>
</div>


@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhHPOCq-RqOtN1zmTF8d7nI44jLuixlj4&libraries=places"></script>

    <script>
        // Initialize the autocomplete object and map object
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location-input'));
        var geocoder = new google.maps.Geocoder();
        var map;
        var marker;


        // Create the map
        @include('core::layouts.map_style')

        // Add an event listener to the autocomplete object
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (place.geometry) {
                // Center the map at the selected place
                map.setCenter(place.geometry.location);

                // Move the existing marker to the selected place
                marker.setPosition(place.geometry.location);
                marker.setTitle(place.name);
            } else {
                // Geocode the address and center the map at the geocoded location
                geocodeAddress(document.getElementById('location-input').value);
            }

            // Update the hidden input fields with the marker's position
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            document.getElementById('lat').value = lat;
            document.getElementById('lon').value = lng;
        });

        // Function to geocode an address and center the map
        function geocodeAddress(address) {
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    // Center the map at the geocoded location
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();
                    map.setCenter({
                        lat: lat,
                        lng: lng
                    });

                    // Move the existing marker to the geocoded location
                    marker.setPosition({
                        lat: lat,
                        lng: lng
                    });
                    marker.setTitle(address);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }

                // Update the hidden input fields with the marker's position
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                document.getElementById('lat').value = lat;
                document.getElementById('lon').value = lng;
            });
        }

        // Create a map object and center it at a specific location
        map = new google.maps.Map(document.getElementById('map'), {
            @if (isset($stoppage))
                center: {
                    lat: {{ $stoppage->lat }},
                    lng: {{ $stoppage->lon }}
                },
            @else
                center: {
                    lat: 23.810332,
                    lng: 90.4125181
                }, // dhaka
            @endif
            zoom: 16,

            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: myStyle,
            mapTypeControl: false,
            streetViewControl: false // disable Pegman
        });

        // Add a marker to the map
        marker = new google.maps.Marker({
            @if (isset($stoppage))
                position: {
                    lat: {{ $stoppage->lat }},
                    lng: {{ $stoppage->lon }}
                },
            @else
                position: {
                    lat: 23.810332,
                    lng: 90.4125181
                }, // dhaka
            @endif
            map: map,
            title: 'Dhaka',
            draggable: true
        });

        // Add an event listener to the marker

        marker.addListener('dragend', function() {
            // Update the hidden input fields with the marker's position
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            document.getElementById('lat').value = lat;
            document.getElementById('lon').value = lng;

            // Reverse geocode the marker's position to get the location name
            geocoder.geocode({
                'location': marker.getPosition()
            }, function(results, status) {
                if (status === 'OK') {
                    // Update the search input field with the location name
                    var locationInput = document.getElementById('location-input');
                    locationInput.value = results[0].formatted_address;
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            });
        });
    </script>
@endpush
