<div class="col-md-12">
    <div class="input-group input-group-outline my-3 is-filled @error('name') is-invalid @enderror">
        <label class="form-label"><span class="required">{{ __('user::permission.form.name') }}</span></label>
        <input type="text" name="name" class="form-control" autofocus value="@if(isset($permission)){{ $permission->name }}@else{{ old('name') }}@endif">
        @error('name')
            <em class="error" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="input-group input-group-outline my-3 is-filled @error('nice_name') is-invalid @enderror">
        <label class="form-label"><span class="required">{{ __('user::permission.form.nice_name') }}</span></label>
        <input type="text" name="nice_name" class="form-control" autofocus value="@if(isset($permission)){{ $permission->nice_name }}@else{{ old('nice_name') }}@endif">
        @error('nice_name')
            <em class="error" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="input-group input-group-outline my-3 is-filled @error('permissiongroup_id') is-invalid @enderror">
        <label class="form-label"><span class="required">{{ __('user::permission.form.permissiongroup_id') }}</span></label>
        <select name="permissiongroup_id" id="permissiongroup_id" class="form-control">
            @foreach ($permissiongroups as $permissiongroup)
                <option value="{{ $permissiongroup->id }}" @if(isset($permission) && $permissiongroup->id == $permission->permissiongroup_id) selected @endif>{{ $permissiongroup->name }}</option>
            @endforeach
        </select>
        @error('permissiongroup_id')
            <em class="error" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>
