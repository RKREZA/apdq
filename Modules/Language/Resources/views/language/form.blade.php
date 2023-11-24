<div class="col-md-12">
    <div class="input-group input-group-outline my-3 @error('name') is-invalid @enderror is-filled">
        <label class="form-label"><span class="required">{{ __('language::language.form.name') }}</span></label>
        <input type="text" name="name" class="form-control" value="@if (isset($language)){{ $language->name }}@else{{ old('name') }}@endif">
        @error('name')
            <em class="error invalid-language" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="input-group input-group-outline my-3 @error('code') is-invalid @enderror is-filled">
        <label class="form-label" @if(isset($language)) class="code" @endif>{{ __('language::language.form.code') }}</label>
        <input type="text" class="form-control" @if(isset($language)) disabled readonly (isset($language)) @else name="code" @endif value="@if (isset($language)){{ $language->code }}@else{{ old('code') }}@endif">
        @error('code')
            <em class="error invalid-language" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-check form-switch">
        <input class="form-check-input @error('default') is-invalid @enderror" name="default" type="checkbox" id="flexSwitchCheckDefault" @if(isset($language) && $language->default == 'Active') checked @endif>
        <label class="form-check-label"  for="flexSwitchCheckDefault"> {{ __('language::language.form.default') }}</label>
    </div>
</div>
