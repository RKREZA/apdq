<div class="row">


    <div class="col-md-12">
        <div class="input-group input-group-outline my-2 is-filled  @error('role') is-invalid @enderror">
            <label for="roles" class="form-label"> <span class="required z-index-1">{{ __('user::user.form.role') }}</span></label>
            @php
                if(!isset($roles)){
                    $roles = [];
                }
                if(!isset($userRole)){
                    $userRole = [];
                }
            @endphp
            {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control', 'id' => 'roles','required' => 'required')) !!}
            @error('roles')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline my-2 is-filled @error('name') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('user::user.form.name') }}</span></label>
            <input type="text" name="name" class="form-control" value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif">
            @error('name')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    {{-- <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('designation') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('user::user.form.designation') }}</span></label>
            <input type="text" name="designation" class="form-control" value="@if(isset($user)){{ $user->designation }}@else{{ old('designation') }}@endif">
            @error('designation')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div> --}}

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('mobile') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('user::user.form.mobile') }} </span></label>
            <input type="number" name="mobile" class="form-control" value="@if(isset($user)){{ $user->mobile }}@else{{ old('mobile') }}@endif">
            @error('mobile')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('email') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('user::user.form.email') }} </span></label>
            <input type="email" name="email" class="form-control" value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif">
            @error('email')
                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('password') is-invalid @enderror">
            <label class="form-label"><span class="@if(isset($user)) @else required @endif">{{ __('user::user.form.password') }}</span></label>
            <input type="password" name="password" class="form-control password_hide_show" id="password">
            <span style="height: 36px;" class="input-group-text password_hide_show" id="password_hide_show">
                <i class="material-icons" id="password_hide_show_icon">visibility_off</i>
            </span>
            @error('password')
                <em class="error invalid-password" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline my-2 is-filled @error('password_confirmation') is-invalid @enderror">
            <label class="form-label"><span class="">{{ __('user::user.form.password_confirmation') }}</span></label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" data-rule-password="true" data-rule-equalTo="#password">
            <span style="height: 36px;" class="input-group-text password_hide_show" id="password_hide_show_confirmation">
                <i class="material-icons" id="password_hide_show_confirmation_icon">visibility_off</i>
            </span>
            @error('password_confirmation')
                <em class="error invalid-password_confirmation" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>
</div>
