@extends('frontend::frontend.layouts.master')

@section('title')
    হোম
@endsection
@section('seo')
    <meta name="title" content="{{ $frontend_setting->meta_title }}">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="{{ $frontend_setting->social_title }}" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
<style>

    .dep_icon i {
        display: block;
        line-height: 12px;
        font-size: 25px
    }

    .dep_icon i.fa-long-arrow-right {
        color: #00ff63
    }

    .dep_icon i.fa-long-arrow-left {
        color: #00f5ff
    }

    .dep_h p {
        color: #ffffff;
        font-size: 14px;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .dep_h h4 {
        color: #ffffff;
        font-size: 16px;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .dep-list {
        margin-top: 105px;
    }

    .dep-list li {
        margin-bottom: 15px
    }

    .dep-list li a {
        display: flex;
        justify-content: start;
        align-items: center;
        align-content: center;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(14, 16, 48, .05);
        background: #fff;
        border-radius: 5px
    }

    .dep_list_1 {
        width: 120px;
        text-align: left;
        margin-right: 10px;
    }
    .dep_list_1 > small{
        color: #111;
        font-size: 12px;
        font-weight: 500;
    }
    .dep_list_1 > small i {
        color: #FDDE09;
        font-size: 14px
    }
    .dep_list_1 > small span {
        font-size: 19px;
    }
    .dep-list li ul li {
        display: inline-block;
        margin: 0 0 0 15px;
    }

    .dep-list li ul {
        text-align: center
    }

    .dep_l_ic > img {
        width: 25px;
        float: left;
    }

    .dep_list_1 p {
        color: #111;
        font-size: 12px;
        font-weight: 500;
    }

    .dep_list_1 h2 {
        font-size: 13px;
        color: #444;
    }

    .dep_l_ic span {
        width: 25px;
        display: inline-block;
        height: 15px;
        line-height: 16px;
        background: #fff;
        color: #111;
        font-weight: 500;
        border-radius: 5px;
        font-size: 11px;
        border: 1px solid #eee;
        margin-left: 5px;
    }

    .dep_l_d small {
        background: #0EF65F;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 15px;
        font-size: 12px;
    }
    .dep_list_3 p span {
        font-size: 17px;
    }
    .dep_l_d2 small {
        background: #0EF65F;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 16px;
        font-size: 13px;
    }

    .dep_l_d_2 small {
        background: #00F5FF;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 16px;
        font-size: 13px;
    }

    .dep_l_d_3 small {
        background: #6c2ff4;
        color: #fff;
        font-weight: 700;
        padding: 4px;
        border-radius: 5px;
        margin-top: 7px;
        display: inline-block;
        line-height: 15px;
        font-size: 12px;
    }

    .dep_list_3 {
        flex: 1;
        text-align: right;
        position: relative;
        top: -20px;
    }

    .dep_list_3 p {
        color: #0F9FC6;
        font-size: 12px
    }

    .form_container{
        width: 400px;
        max-height: 700px;
        -webkit-box-shadow: 0 1px 8px 0 rgba(0,0,0,.12);
        box-shadow: 0 1px 8px #0000001f;
        border-radius: 12px;
        margin: 20px;
        height: calc(100% - 40px);
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        z-index: 9;
        position: fixed;
    }

    .select2-container .select2-selection--single {
        height: 54px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 12px;
        margin-top: 22px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 14px;
        right: 7px;
    }

    .location{
        width: 100%;
        text-align: left;
        padding: 10px;
    }
    .location h5{
        font-size: 14px;
    }

    .card-header{
        position: absolute;
        top: 0;
        width: 100%;
    }

    #tab-footer{
        position: absolute;
        bottom: 0;
    }

    #tab-footer .nav-tabs{
        width: 100%;
        border-radius: 0 0 5px 5px;
    }

    #tab-footer .nav-item{
        width: 33.33%;
    }

    #tab-footer .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link{
        color: #ccc;
        margin-bottom: 0;
        margin: auto;
        font-size: 13px;
        font-weight: normal;
        width: 100%;
        padding: 11px 10px 5px 10px;
        border-radius: 5px;
    }

    #tab-footer .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        color: #fff;
    }

</style>
@endpush

@section('content')

<div class="form_container">
    <div class="card h-100" id="card">

        <div class="tab-pane fade show active" id="trip" role="tabpanel" aria-labelledby="trip-tab">
            <div class="card-header bg-dark py-3" id="card-header">

                <div class="row mt-1 mb-2">
                    {{-- <div class="col-3">
                        <a href="#" class="text-end" id="back">
                            <img src="{{ asset('assets/backend/img/back-white.png') }}" style="height: 24px;" class="text-center" alt="">
                        </a>
                    </div> --}}

                    <div class="col-3" style="display: flex;align-items: center;justify-content: flex-start;">
                        <a href="/" class="text-start" id="back" style="z-index: 1;">
                            <img src="{{ asset('assets/backend/img/back-white.png') }}" style="height: 24px;" class="text-center" alt="">
                        </a>
                    </div>
                    <div class="col-6" style="display: flex;align-items: center;justify-content: center;">
                        <a href="/" class="text-center">
                            <img src="{{ asset('assets/backend/img/logo.png') }}" style="height: 24px; width:auto;display:inline-block; padding: 4px; border-radius: 3px; background:#fff;" class="text-center" alt="">
                        </a>
                    </div>

                    <div class="col-3" style="display: flex;align-items: center;justify-content: flex-end;">
                        <a href="/" class="text-end">
                            <img src="{{ asset('assets/backend/img/user-white.png') }}" style="height: 24px;" class="text-center" alt="">
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="text-start mb-2">

                            <button type="button" class="btn btn-dark mb-0" data-bs-toggle="modal" data-bs-target="#cityModal">
                                <img src="{{ asset('assets/backend/img/icons/optimized/city-white.png') }}"
                                    style="height: 20px; width:auto;display:inline-block;position: relative;top: -3px;" class="" alt="">
                                @if (Session::has('city'))
                                    {{ Session::get('city')->name }}
                                @else
                                    Select City
                                @endif

                            </button>
                        </div>
                    </div>
                </div>

                <div id="form-parent">
                    <div class="form-floating mb-2">
                        <select class="form-select select2" name="from" id="from" aria-label="Floating label select example">
                            <option value="" selected disabled></option>
                            @foreach ($stoppages as $stoppage)
                                <option value="{{ $stoppage->lat.','.$stoppage->lon }}" @if(isset($from) && $from->id == $stoppage->id) selected @endif>{{ $stoppage->name }}</option>
                            @endforeach
                        </select>
                        <label for="from">Where are we starting?</label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select select2" name="to" id="to" aria-label="Floating label select example">
                            <option value="" selected disabled></option>
                            @foreach ($stoppages as $stoppage)
                                <option value="{{ $stoppage->lat.','.$stoppage->lon }}" @if(isset($to) && $to->id == $stoppage->id) selected @endif>{{ $stoppage->name }}</option>
                            @endforeach
                        </select>
                        <label for="to">Where are we going?</label>
                    </div>
                </div>

                @if (Session::has('city'))
                    <input type="hidden" name="city" id="city" value="{{ Session::get('city')->id }}" class="form-control">
                @endif

            </div>
            <div class="card-body p-0 tab-content" style="overflow:auto" id="card-body">

                <div class="p-3 py-4">
                    <div style="display:flex;justify-content: center;" id="submit-parent">
                        <button type="submit" id="submit" class="btn btn-dark mt-2"
                            style="height: 70px; width: 70px; border-radius: 70px; margin-top: 220px !important;">
                            <img src="{{ asset('assets/backend/img/icons/optimized/right-arrow-white.png') }}"
                                style="height: 25px; width:auto;display:inline-block;" class=""
                                alt="">
                        </button>
                    </div>

                    <div class="dep-list">
                        <ul id="result">

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
            <div class="card-header bg-dark py-3" id="card-header">

                <div class="row mt-1 mb-2">
                    <div class="col-3">

                    </div>
                    <div class="col-6" style="display: flex;align-items: center;justify-content: center;">
                        <a href="/" class="text-center text-white">
                            Schedule
                        </a>
                    </div>

                    <div class="col-3" style="display: flex;align-items: center;justify-content: flex-end;">
                        <a href="/" class="text-end">
                            <img src="{{ asset('assets/backend/img/user-white.png') }}" style="height: 24px;" class="text-center" alt="">
                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">

            </div>
        </div>

        <div class="tab-pane fade" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
            <div class="card-header bg-dark py-3" id="card-header">

                <div class="row mt-1 mb-2">
                    <div class="col-3">

                    </div>
                    <div class="col-6" style="display: flex;align-items: center;justify-content: center;">
                        <a href="/" class="text-center text-white">
                            Ticket
                        </a>
                    </div>

                    <div class="col-3" style="display: flex;align-items: center;justify-content: flex-end;">
                        <a href="/" class="text-end">
                            <img src="{{ asset('assets/backend/img/user-white.png') }}" style="height: 24px;" class="text-center" alt="">
                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">

            </div>
        </div>



        <div id="tab-footer" class="w-100">
            <div class="row">

                <div class="col">
                    <ul class="nav nav-tabs bg-dark" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link bg-dark border-0 active" id="trip-tab" data-bs-toggle="tab" data-bs-target="#trip" type="button" role="tab" aria-controls="trip" aria-selected="true">
                            <img src="{{ asset('assets/backend/img/trip-white.png') }}" alt="" style="margin: auto; height: 20px;">
                            Trip
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link bg-dark border-0" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab" aria-controls="schedule" aria-selected="false">
                            <img src="{{ asset('assets/backend/img/schedule-white.png') }}" alt="" style="margin: auto; height: 20px;">
                            Schedule
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link bg-dark border-0" id="ticket-tab" data-bs-toggle="tab" data-bs-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="false">
                            <img src="{{ asset('assets/backend/img/ticket-white.png') }}" alt="" style="margin: auto; height: 20px;">
                            Ticket
                          </button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="map_parent">
    <div id="map" style="height:100vh; width:100%;"></div>
</div>

@endsection


@push('js')

<script>
    // Create the map
    @include('core::layouts.map_style')

    var icon = {
        url: "{{ asset('assets/backend/img/icons/optimized/bus-stoppage-red.png') }}",
        size: new google.maps.Size(32, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(16, 32)
    };

    @if(Session::has('city'))
        var fenceCoords = {!! Session::get('city')->city_boundary !!};

        // Create a polygon object on the map using the fenceCoords array
        var fence = new google.maps.Polygon({
            paths: fenceCoords,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        });

        // Get the bounds of the polygon
        var bounds = new google.maps.LatLngBounds();
        fenceCoords.forEach(function(coord) {
            bounds.extend(coord);
        });

        // Get the center of the polygon by calculating the centroid of the bounds
        var center = bounds.getCenter();

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: myStyle,
            mapTypeControl: false,
            streetViewControl: false // disable Pegman
        });

        // Create a marker at the center of the polygon
        // var marker = new google.maps.Marker({
        //     position: center,
        //     map: map
        // });
        var markers =[
            @foreach ($stoppages as $stoppage)
                {
                    position: new google.maps.LatLng({{ $stoppage->lat }}, {{ $stoppage->lon }}),
                    title: "{{ $stoppage->name }}",
                    icon: icon
                },
            @endforeach
        ];



        // Loop through the markers array and add each marker to the map
        markers.forEach(function(marker) {
            var newMarker = new google.maps.Marker({
                position: marker.position,
                title: marker.title,
                icon: marker.icon,
                map: map
            });
        });

    @endif

</script>

<script>
    $(document).ready(function() {
        $('.async-img').each(function() {
            var src = $(this).data('src');
            $(this).attr('src', src).removeAttr('data-src');
        });
    });
</script>

<script>

    $("#back").hide();

    $("#submit").click(function(){
        var from = $("#from").val();
        var to = $("#to").val();

        if(from != null && to != null){
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ route('frontend.get_routes') }}",
                data: { from: from, to: to},
                success: function (result) {
                    console.log(result);
                    if (result === undefined || result != null || result != "") {
                        $("#form-parent").hide();
                        $("#submit-parent").hide();
                        $("#result").append(result);
                        $("#back").show();
                    }else{
                        $("#form-parent").hide();
                        $("#submit-parent").hide();
                        $("#result").append("<h5>No route found!</h5>");
                        $("#back").show();
                    }
                },
                error: function (request, error) {
                    alert("Error!");
                },
            });
        }
    });

    $("#back").click(function(){
        // $("#back").hide();
        $("#form-parent").show();
        $("#submit-parent").show();
        $("#result").empty().hide();
    });


    $( 'body').on( 'click', '.location', function () {
        var result_vehicle_route_id = $(this).val();

        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: "{{ route('frontend.get_route_by_id') }}",
            data: { result_vehicle_route_id: result_vehicle_route_id},
            success: function (result) {
                // Define the start and end locations and the intermediate stoppages
                var start       = new google.maps.LatLng(result.start.lat, result.start.lon);
                var end         = new google.maps.LatLng(result.end.lat, result.end.lon);
                var stoppages   = [];

                for (let [key, value] of Object.entries(result.vehicle_stoppages)) {
                    var location = {location: new google.maps.LatLng(value.lat, value.lon)};
                    stoppages.push(location);
                }

                // Create a directions service object
                var directionsService = new google.maps.DirectionsService();


                // Define the map options and create the map object
                var mapOptions  = {
                    zoom: 10,
                    center: start,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles:myStyle,
                    mapTypeControl: false,
                    streetViewControl: false, // disable Pegman
                    provideRouteAlternatives: true, // Only provide a single route
                    travelMode: 'DRIVING'
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                // shopMarker.setMap(null);

                // Define the directions display object
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    map: map
                });

                // Define the directions request object
                var request = {
                    origin: start,
                    destination: end,
                    waypoints: stoppages,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                // Send the request to the directions service
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        // Display the route on the map
                        directionsDisplay.setDirections(response);
                    }
                });
            }
        });
    });


</script>


<script>
</script>


@endpush
