{{-- Dropzone --}}
<script>
    if(typeof dropzone_maxFilesize !== 'undefined' || typeof dropzone_maxFiles !== 'undefined' || typeof dropzone_acceptedFiles !== 'undefined' || typeof dropzone_paramName !== 'undefined'){
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#myDropzone", {
            maxFilesize: dropzone_maxFilesize,
            maxFiles: dropzone_maxFiles,
            acceptedFiles: dropzone_acceptedFiles,
            paramName: dropzone_paramName,
            addRemoveLinks: true,

            // Image Thumbnail
            createImageThumbnails: true, // Whether thumbnails for images should be generated
            maxThumbnailFilesize: 1, //In MB. When the filename exceeds this limit, the thumbnail will not be generated.
            thumbnailWidth: 120,
            thumbnailMethod: "contain", // How the images should be scaled down in case both, `thumbnailWidth` and `thumbnailHeight` are provided. Can be either `contain` or `crop`.

            resizeWidth: null, // If set, images will be resized to these dimensions before being **uploaded**. If only one, `resizeWidth` **or** `resizeHeight` is provided, the original aspect ratio of the file will be preserved.
            resizeHeight: null,
            resizeMimeType: null, // The mime type of the resized image (before it gets uploaded to the server). If `null` the original mime type will be used. To force jpeg, for example, use `image/jpeg`. See `resizeWidth` for more information.
            resizeQuality: 1, // The quality of the resized images. See `resizeWidth`.
            resizeMethod: "contain",

            success: function(file, response) {
                var id = response.id;
                if ($("#files").val().length === 0) {
                    $("#files").val(id);
                } else {
                    $("#files").val($('#files').val() + ','+id);
                }
                file.previewElement.id = id;
                $(".create-button").attr('disabled',false);
            },

            removedfile: function(file) {
                var id = file.previewElement.id;
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("admin.files.destroy") }}',
                    data: {
                        id: id,
                    },
                    success: function(result) {
                        if ($("#files").val().indexOf(id+',') > -1) {
                            var str = $('#files').val().replace(id+',', '');
                        } else if($("#files").val().indexOf(','+id) > -1) {
                            var str = $('#files').val().replace(','+id, '');
                        } else {
                            var str = $('#files').val().replace(id, '');
                        }
                        $('#files').val(str);
                        @include('admin::layouts.includes.js.json_response')
                    },
                });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
        });

        if(typeof dropzone_maxFilesize !== 'undefined'){
            myDropzone.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }

        myDropzone.on("sending", function (file, xhr, formData) {
            $(":submit").prop("disabled", true);
        });

        myDropzone.on("queuecomplete", function ( ) {
            $(":submit").prop("disabled", false);
        });
    }
</script>
