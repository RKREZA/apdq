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

    <div class="col-md-12">
        <div class="input-group input-group-outline my-2 is-filled @error('description') is-invalid @enderror">
            <label class="form-label">{{ __('guardfile::guardfile.guardfile.form.description') }}</label>
            <textarea rows="6" id="description" name="description" class="form-control tiny"></textarea>
            @error('description')
                <em class="error invalid-guardfile" style="display: inline-block;">{{ $message }}</em>
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

@endpush
