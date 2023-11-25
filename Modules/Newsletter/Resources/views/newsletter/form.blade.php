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

            <div class="col-md-12 mb-3">
                <div class="input-group input-group-outline mt-3 is-filled @error('email') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('newsletter::newsletter.newsletter.form.email') }}</span></label>
                    <input type="email" name="email" id="email" class="form-control" value="@if(isset($newsletter)){{ $newsletter->email }}@else{{ old('email') }}@endif">
                    @error('email')
                        <em class="error invalid-newsletter" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

        </div>
    </div>
</div>


@push('js')

@endpush
