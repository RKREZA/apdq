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

            <div class="col-md-12 mt-3 p-0">
                <div class="row m-0">
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
                                <option value="Day(s)" @if(isset($subscription) && $subscription->duration_type=="Day(s)") selected @endif>Day(s)</option>
                                <option value="Month(s) @if(isset($subscription) && $subscription->duration_type=="Month(s)") selected @endif">Month(s)</option>
                                <option value="Year(s) @if(isset($subscription) && $subscription->duration_type=="Year(s)") selected @endif">Year(s)</option>
                            </select>
                            @error('duration_type')
                                <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline mt-3 is-filled @error('trial_days') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.trial_days') }}</span></label>
                            <input type="number" name="trial_days" id="trial_days" class="form-control" value="@if(isset($subscription)){{ $subscription->trial_days }}@else{{ old('trial_days') }}@endif">
                            @error('trial_days')
                                <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="input-group input-group-outline mt-3 is-filled @error('price') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('subscription::subscription.subscription.form.price') }}</span></label>
                    <input type="number" name="price" id="price" class="form-control" value="@if(isset($subscription)){{ $subscription->price }}@else{{ old('price') }}@endif">
                    @error('price')
                        <em class="error invalid-subscription" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="option_ad_free" id="option_ad_free" @if(isset($subscription) && $subscription->option_ad_free == 'Active'){{ $subscription->option_ad_free }} checked @endif>
                    <label class="form-check-label mb-0 ms-3" for="option_ad_free">{{ __('subscription::subscription.subscription.form.option_ad_free') }}</label>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="option_live_content" id="option_live_content" @if(isset($subscription) && $subscription->option_live_content == 'Active'){{ $subscription->option_live_content }} checked @endif>
                    <label class="form-check-label mb-0 ms-3" for="option_live_content">{{ __('subscription::subscription.subscription.form.option_live_content') }}</label>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="option_premium_content" id="option_premium_content" @if(isset($subscription) && $subscription->option_premium_content == 'Active'){{ $subscription->option_premium_content }} checked @endif>
                    <label class="form-check-label mb-0 ms-3" for="option_premium_content">{{ __('subscription::subscription.subscription.form.option_premium_content') }}</label>
                </div>
            </div>

            <h5 class="mt-5">SEO</h5>
            <hr class="">

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
