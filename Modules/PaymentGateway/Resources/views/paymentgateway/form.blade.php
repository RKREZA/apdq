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
            <input type="text" name="code" id="code" class="form-control" disabled value="@if(isset($paymentgateway)){{ $paymentgateway->code }}@else{{ old('code') }}@endif">
            @error('code')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    @if($paymentgateway->code == 'paypal')

    <div class="col-md-12">
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

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('paypal_client_id') is-invalid @enderror">
            <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.paypal_client_id') }}</label>
            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="@if(isset($info)){{ $info->paypal_client_id }}@else{{ old('paypal_client_id') }}@endif">
            @error('paypal_client_id')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('paypal_secret') is-invalid @enderror">
            <label class="form-label">{{ __('paymentgateway::paymentgateway.paymentgateway.form.paypal_secret') }}</label>
            <input type="text" name="paypal_secret" id="paypal_secret" class="form-control" value="@if(isset($info)){{ $info->paypal_secret }}@else{{ old('paypal_secret') }}@endif">
            @error('paypal_secret')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    @endif

    {{-- <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('paymentgateway::paymentgateway.paymentgateway.form.description') }}</span></label>
            <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($paymentgateway)){{ $paymentgateway->description }}@else{{ old('description') }}@endif</textarea>
            @error('description')
                <em class="error invalid-paymentgateway" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div> --}}

</div>


@push('js')


@endpush
