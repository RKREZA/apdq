@push('css')
    <style>

    </style>
@endpush


<div class="row mb-3">

    <div class="col-md-8">
        <div class="input-group input-group-outline mt-3 is-filled @error('name') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('paymentgateway::paymentgateway.paymentgateway.form.name') }}</span></label>
            <input type="text" name="name" id="name" class="form-control" value="@if(isset($paymentgateway)){{ $paymentgateway->name }}@else{{ old('name') }}@endif">
            @error('name')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-outline mt-3 is-filled @error('code') is-invalid @enderror">
            <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.code') }}</label>
            <input type="text" name="code" id="code" class="form-control" value="@if(isset($paymentgateway)){{ $paymentgateway->code }}@else{{ old('code') }}@endif">
            @error('code')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>



    <div class="col-md-6">
        <div class="input-group input-group-outline mt-3 is-filled @error('currency') is-invalid @enderror">
            <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.currency') }}</label>
            <input type="text" name="currency" id="currency" class="form-control" value="@if(isset($info)){{ $info->currency }}@else{{ old('currency') }}@endif">
            @error('currency')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline mt-3 is-filled @error('mode') is-invalid @enderror is-filled">
            <label class="form-label" for="payment_mode"><span class="required">{{ __('paymentgateway::paymentgateway.paymentgateway.form.mode') }}</span></label>
            <select name="mode" id="payment_mode" class="form-control @error('category_id') is-invalid @enderror">
                <option value="sandbox" @if(isset($info) && $info->mode == 'sandbox') selected @endif>Sandbox</option>
                <option value="live" @if(isset($info) && $info->mode == 'live') selected @endif>Live</option>
            </select>
            @error('mode')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>


    @if($paymentgateway->code == 'paypal')

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('sandbox_paypal_client_id') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.sandbox_paypal_client_id') }}</label>
                <input type="text" name="sandbox_paypal_client_id" id="sandbox_paypal_client_id" class="form-control" value="@if(isset($info)){{ $info->sandbox_paypal_client_id }}@else{{ old('sandbox_paypal_client_id') }}@endif">
                @error('sandbox_paypal_client_id')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('sandbox_paypal_secret') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.sandbox_paypal_secret') }}</label>
                <input type="text" name="sandbox_paypal_secret" id="sandbox_paypal_secret" class="form-control" value="@if(isset($info)){{ $info->sandbox_paypal_secret }}@else{{ old('sandbox_paypal_secret') }}@endif">
                @error('sandbox_paypal_secret')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('live_paypal_client_id') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.live_paypal_client_id') }}</label>
                <input type="text" name="live_paypal_client_id" id="live_paypal_client_id" class="form-control" value="@if(isset($info)){{ $info->live_paypal_client_id }}@else{{ old('live_paypal_client_id') }}@endif">
                @error('live_paypal_client_id')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('live_paypal_secret') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.live_paypal_secret') }}</label>
                <input type="text" name="live_paypal_secret" id="live_paypal_secret" class="form-control" value="@if(isset($info)){{ $info->live_paypal_secret }}@else{{ old('live_paypal_secret') }}@endif">
                @error('live_paypal_secret')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

    @endif




    @if($paymentgateway->code == 'stripe')

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('sandbox_stripe_key') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.sandbox_stripe_key') }}</label>
                <input type="text" name="sandbox_stripe_key" id="sandbox_stripe_key" class="form-control" value="@if(isset($info)){{ $info->sandbox_stripe_key }}@else{{ old('sandbox_stripe_key') }}@endif">
                @error('sandbox_stripe_key')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('sandbox_stripe_secret') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.sandbox_stripe_secret') }}</label>
                <input type="text" name="sandbox_stripe_secret" id="sandbox_stripe_secret" class="form-control" value="@if(isset($info)){{ $info->sandbox_stripe_secret }}@else{{ old('sandbox_stripe_secret') }}@endif">
                @error('sandbox_stripe_secret')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('live_stripe_key') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.live_stripe_key') }}</label>
                <input type="text" name="live_stripe_key" id="live_stripe_key" class="form-control" value="@if(isset($info)){{ $info->live_stripe_key }}@else{{ old('live_stripe_key') }}@endif">
                @error('live_stripe_key')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group input-group-outline mt-3 is-filled @error('live_stripe_secret') is-invalid @enderror">
                <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.live_stripe_secret') }}</label>
                <input type="text" name="live_stripe_secret" id="live_stripe_secret" class="form-control" value="@if(isset($info)){{ $info->live_stripe_secret }}@else{{ old('live_stripe_secret') }}@endif">
                @error('live_stripe_secret')
                    <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

    @endif

</div>


@push('js')


@endpush
