<div class="col-md-12">
    <div class="input-group input-group-outline my-3 is-filled @error('name') is-invalid @enderror">
        <label class="form-label"><span class="required">{{ __('user::role.form.name') }}</span></label>
        <input type="text" class="form-control disabled" disabled value="@if(isset($role)){{ $role->name }}@else{{ old('name') }}@endif">
        @error('name')
            <em class="error" style="display: inline-block;">{{ $message }}</em>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                @foreach ($permissiongroups as $permissiongroup)
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permissiongroup_{{ $permissiongroup->id }}">
                            <label class="custom-control-label" for="permissiongroup_{{ $permissiongroup->id }}"><h6 class="m-0 p-0">{{ ucwords($permissiongroup->display_name) }}</h6></label>
                        </div>
                    </th>
                    @php
                        $permissions = \Modules\User\Entities\Permission::where('permissiongroup_id', $permissiongroup->id)->get();
                    @endphp
                    @foreach ($permissions as $permission)
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" @if (isset($rolePermissions) && in_array($permission->id, $rolePermissions)) checked @endif>
                                <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ ucfirst(str_replace('-',' ',$permission->name)) }}</label>
                            </div>

                            @push('js')
                                <script>
                                    $(document).ready(function() {
                                        $("body").on("click", "#permissiongroup_{{ $permissiongroup->id }}", function() {
                                            if ($(this).is(':checked', true)) {
                                                $("#permission_{{ $permission->id }}").prop('checked', true);
                                            } else {
                                                $("#permission_{{ $permission->id }}").prop('checked', false);
                                            }
                                        });
                                    });
                                </script>
                            @endpush
                        </td>
                    @endforeach

                </tr>
                @endforeach
            </table>
        </div>
        {{-- @foreach ($permissiongroups as $permissiongroup)
            <div class="col-md-4">
                <div class="card mb-3">

                    <div class="card-header">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permissiongroup_{{ $permissiongroup->id }}">
                            <label class="custom-control-label" for="permissiongroup_{{ $permissiongroup->id }}"><h6 class="m-0 p-0">{{ ucwords($permissiongroup->display_name) }}</h6></label>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $permissions = \Modules\User\Entities\Permission::where('permissiongroup_id', $permissiongroup->id)->get();
                        @endphp
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" @if (isset($rolePermissions) && in_array($permission->id, $rolePermissions)) checked @endif>
                                <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>

                            @push('js')
                                <script>
                                    $(document).ready(function() {
                                        $("body").on("click", "#permissiongroup_{{ $permissiongroup->id }}", function() {
                                            if ($(this).is(':checked', true)) {
                                                $("#permission_{{ $permission->id }}").prop('checked', true);
                                            } else {
                                                $("#permission_{{ $permission->id }}").prop('checked', false);
                                            }
                                        });
                                    });
                                </script>
                            @endpush
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
</div>
