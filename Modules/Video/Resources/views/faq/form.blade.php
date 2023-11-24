@push('css')
    <style>
        #map {
            height: 400px;
            width: 600px;
        }
    </style>
@endpush

<div class="row">

    <div class="col-md-12">
        <div class="input-group input-group-outline my-2 is-filled @error('title') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('faq::faq.faq.form.title') }}</span></label>
            <input type="text" name="title" id="title" class="form-control"
                value="@if (isset($faq)) {{ $faq->title }}@else{{ old('title') }} @endif">
            @error('title')
                <em class="error invalid-faq" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
            <label class="form-label" for="category_id"><span class="required">{{ __('faq::faq.faq.form.category_id') }}</span></label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                {{-- <option value="">{{ __('faq::faq.faq.form.select_category') }}</option> --}}
                @foreach (\Modules\Faq\Entities\FaqCategory::where('status','Active')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <em class="error invalid-faq" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline my-2 is-filled @error('description') is-invalid @enderror">
            <label class="form-label">{{ __('faq::faq.faq.form.description') }}</label>
            <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($faq)){{ $faq->description }}@else{{ old('description') }}@endif</textarea>
            @error('description')
                <em class="error invalid-faq" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>
    
</div>


@push('js')

@endpush
