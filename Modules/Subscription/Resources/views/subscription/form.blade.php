@push('css')
    <style>
        #map {
            height: 400px;
            width: 600px;
        }

        .tag {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 5px;
            margin: 5px;
            border-radius: 3px;
        }

        .removeTag {
            margin-left: 5px;
            cursor: pointer;
            color: #ff0000;
            text-decoration: none;
        }
    </style>
@endpush

{{-- <div class="row mb-4">
    <div class="col-md-10">
        <input type="text" name="youtube_link" id="youtube_link" class="form-control px-3" placeholder="Youtube Link" required>
    </div>

    <div class="col-md-2">
        <button type="button" id="fetch_youtube_data" class="btn btn-primary btn-lg w-100">Fetch</button>
    </div>
</div>
<hr class="horizontal dark"> --}}



<div class="row">

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.title') }}</span></label>
                    <input type="text" name="title" id="title" class="form-control" value="@if(isset($subscription)){{ $subscription->title }}@else{{ old('title') }}@endif">
                    @error('title')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.description') }}</span></label>
                    <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($subscription)){{ $subscription->description }}@else{{ old('description') }}@endif</textarea>
                    @error('description')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>



            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group input-group-outline mt-3 is-filled @error('duration') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.duration') }}</span></label>
                            <input type="number" name="duration" id="duration" class="form-control" value="@if(isset($subscription)){{ $subscription->duration }}@else{{ old('duration') }}@endif">
                            @error('duration')
                                <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline mt-3 is-filled @error('duration_type') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.duration_type') }}</span></label>
                            <select name="duration_type" id="duration_type" class="form-control">
                                <option value="Day(s)" @if(isset($subscription) && $subscriotion->duration_type=="Day(s)") selected @endif>Day(s)</option>
                                <option value="Month(s) @if(isset($subscription) && $subscriotion->duration_type=="Month(s)") selected @endif">Month(s)</option>
                                <option value="Year(s) @if(isset($subscription) && $subscriotion->duration_type=="Year(s)") selected @endif">Year(s)</option>
                            </select>
                            @error('duration_type')
                                <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline mt-3 is-filled @error('price') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.price') }}</span></label>
                            <input type="number" name="price" id="price" class="form-control" value="@if(isset($subscription)){{ $subscription->price }}@else{{ old('price') }}@endif">
                            @error('price')
                                <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr class="horizontal light my-4">

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_title') is-invalid @enderror">
                    <label class="form-label">{{ __('subscription::subscription.subscription.form.seo_title') }}</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control" value="@if(isset($subscription)){{ $subscription->seo_title }}@else{{ old('seo_title') }}@endif">
                    @error('seo_title')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_description') is-invalid @enderror">
                    <label class="form-label">{{ __('subscription::subscription.subscription.form.seo_description') }}</label>
                    <textarea rows="2" id="seo_description" name="seo_description" class="form-control">@if(isset($subscription)){{ $subscription->seo_description }}@else{{ old('seo_description') }}@endif</textarea>
                    @error('seo_description')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                    <label class="form-label">{{ __('subscription::subscription.subscription.form.seo_keyword') }}</label>
                    <textarea rows="4" id="seo_keyword" name="seo_keyword" class="form-control">@if(isset($subscription)){{ $subscription->seo_keyword }}@else{{ old('seo_keyword') }}@endif</textarea>
                    @error('seo_keyword')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

        </div>
    </div>
</div>


@push('js')


@endpush
