<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>




    <style>
        .liam {
            float: left;
            width: 45%;
            padding: 10px;
        }

        * {
            font-family: DejaVu Sans !important;

            font-size: smaller;
        }

        .half {
            width: 45%;
            vertical-align: top;
            display: inline-block;
            border-top: lightgray 1px solid;
        }

        .imgs {
            width: 200px;
            height: auto;
        }
    </style>
</head>

<body>

    <div id="logo" style="width: 100%;text-align: center;"><img
            src="https://sabbianco.fosetico.com/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt="">
    </div>


    <h3>
        <span id="listingPriceTitle">€{{ $data->price }}</span>
    </h3>

    @if ($data->property_tnumber_of_bedroomsype != '' && $data->number_of_bedrooms != 0)
        <span>
            <i class="flaticon-bed mr-2" aria-hidden="true"></i>
            <strong id="ListingBedroomsTitle">{{ $data->number_of_bedrooms }}</strong>
            <span> bed</span>
        </span>
    @endif
    @if ($data->number_of_bedrooms != '' && $data->number_of_bedrooms != 0)
        <span>
            <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
            <strong id="ListingBedroomsTitle">{{ $data->number_of_bathrooms }}</strong>
            <span> bath</span>
        </span>
    @endif

    @if ($data->area_size != '' && $data->area_size != 0)
        <span>
            <i class="flaticon-square mr-2" aria-hidden="true"></i>
            <strong id="ListingBedroomsTitle">{{ $data->area_size }} </strong>
            <span> sqm</span>
        </span>
    @endif


    <h4>
        {{ $data->displayname }} <br /><span>{{ $data->property_type }} </span>
    </h4>




    <div class="half">
        <h3 class="mb-3">Description</h3>
        {!! $data->displaydescription !!}
    </div>


    <div class="half">
        <h3 class="mb-3">Location</h3>
        <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/pin-l+000000({{ $data->longitude }},{{ $data->latitude }})/{{ $data->longitude }},{{ $data->latitude }},13,0/350x200?access_token={{ env('MAPBOX_API') }}"
            alt="">
    </div>

    <div class="half">
        <!-- title -->
        <h3 class="mb-3">Property Details</h3>
        <ul style="  list-style-type: none;
        margin: 0;
        padding: 0;">
            @if ($data->property_type != '' && $data->property_type != 0)
                <li id="ListingPropertyTypeDiv" class="">
                    <span class="font-weight-bold mr-1">Property Type:</span>
                    <span class="det" id="ListingPropertyType">{{ $data->property_type }}</span>
                </li>
            @endif
            @if ($data->price != '' && $data->price != 0)
                <li id="ListingPropertyPriceDiv" class="">
                    <span class="font-weight-bold mr-1">Property Price:</span>
                    <span class="det" id="ListingPropertyPrice">€{{ $data->price }}</span>
                </li>
            @endif
            @if ($data->area_size != '' && $data->area_size != 0)
                <li id="ListingAreaDiv" class="">
                    <span class="font-weight-bold mr-1">Area:</span>
                    <span class="det" id="ListingArea">{{ $data->area_size }}</span>
                </li>
            @endif
            @if ($data->number_of_bedrooms != '' && $data->number_of_bedrooms != 0)
                <li id="ListingBedroomsDiv" class="">
                    <span class="font-weight-bold mr-1">Bedrooms:</span>
                    <span class="det" id="ListingBedrooms">{{ $data->number_of_bedrooms }}</span>
                </li>
            @endif
            @if ($data->number_of_bathrooms != '' && $data->number_of_bathrooms != 0)
                <li id="ListingBathDiv" class="">
                    <span class="font-weight-bold mr-1">Bath:</span>
                    <span class="det" id="ListingBath">{{ $data->number_of_bathrooms }}</span>
                </li>
            @endif
            @if ($data->number_of_garages_or_parkingpaces != '' && $data->number_of_garages_or_parkingpaces != 0)
                <li id="ListingGaragesDiv" class="">
                    <span class="font-weight-bold mr-1">Garages:</span>
                    <span class="det" id="ListingGarages">{{ $data->number_of_garages_or_parkingpaces }}</span>
                </li>
            @endif
            @if ($data->year_built != '' && $data->year_built != 0)
                <li id="ListingYearBuiltDiv" class="">
                    <span class="font-weight-bold mr-1">Year Built:</span>
                    <span class="det" id="ListingYearBuilt">{{ $data->year_built }}</span>
                </li>
            @endif
        </ul>
    </div>
    <div class="half">
        <!-- title -->
        <h3 class="mb-3">Amenities</h3>
        <!-- cars List -->
        <ul class="homes-list clearfix" id="amenities">
            @foreach ($data->features as $f)
                <li style="display: flex;width:100%;">
                    <img style="height: 15px;"
                        src="https://sabbianco.fosetico.com/theme/sabbiancowebsite/assets/images/checkbox.png">&nbsp;<span>{{ $f }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    </div>


    @if (isset($data->floor_plans[0]))
        <div>
            <h3 class="mb-3">Floor Plans</h3>
            <img alt="image" id="floorPlans" src="{{ $data->floor_plans[0]->image }}">
        </div>
    @endif
    <div>
        <h3 class="mb-3">Images</h3>
        <img src="{{ $data->image }}" alt="" class="imgs col-sm-4 m-0 p-0">


        @foreach ($data->images as $m)
            <img src="{{ $m }}" alt="" class="imgs col-sm-4 m-0 p-0">
        @endforeach
    </div>




    </div>
    </div>
</body>

</html>
