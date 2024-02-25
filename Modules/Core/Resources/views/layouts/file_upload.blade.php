<div class="row">
    <div class="col-md-12 position-relative">
        <form action="{{ route('admin.files.store') }}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="myDropzone">
            @csrf
            <div class="dz-message" data-dz-message>
                <i class="material-icons" style="font-size: 60px;">cloud_upload</i>
                <h6 class="m-0">@if(isset($file_upload_name)) {{ $file_upload_name }} @else {{ __('core::core.form.photo') }}@endif</h6>
                <p class="text-xs mt-2">
                    {{ __('core::core.form.supported_format', [ 'formats' => $file_upload_format]) }} <br>
                    {{ __('core::core.form.supported_size', [ 'size' => $file_upload_size]) }}
                </p>
            </div>
            <input type="text" name="uploaded_from" value="{{ ($file_uploaded_from) ? $file_uploaded_from : 'files' ; }}" hidden>
        </form>
    </div>

    @if (isset($model) && count($model->files)>0)
        <div class="col-md-12">
            <div class="my-2" id="file_wrapper">
                <table class="table table-bordered table-sm">
                    @foreach ($model->files as $file)
                        <tr>
                            <td class="w-10 text-center">
                                @if ($file->type == 'png' || $file->type == 'jpg' || $file->type == 'gif' || $file->type == 'JPG' || $file->type == 'webp' || $file->type == 'avif')
                                    <i class="fi fi-ss-picture"></i>
                                @elseif($file->type == 'pdf')
                                    <i class="fi fi-ss-file-pdf"></i>
                                @else
                                    <i class="fi fi-ss-clip"></i>
                                @endif
                            </td>
                            <td><a href="/{{ $file->path }}" title="{{ $file->name }}" target="_blank">{{ Str::substr($file->name, 0, 20) }}</a></td>
                            <td class="text-left">
                                <a href="#" id="delete_file" data-id="{{ $file->id }}" data-action="{{ route('admin.files.destroy') }}">
                                    <i class="material-icons mt-2">delete</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
</div>


@push('js')

    <script>
        // Dropzone Data
        var dropzone_acceptedFiles      = "{{ $dropzone_acceptedFiles }}";
        var dropzone_paramName          = "{{ $dropzone_paramName }}";
        var dropzone_maxFilesize        = "{{ $dropzone_maxFilesize }}";
        var dropzone_maxFiles           = "{{ $dropzone_maxFiles }}";
    </script>
@endpush
