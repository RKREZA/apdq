@php
$setting = \Modules\Setting\Entities\Setting::find(1);
@endphp

@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endpush

<div id="feedback">

    <div class="row">
        <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-5 text-center">
            {{-- <div class="">
                <button class="btn bg-gradient-dark border-radius-lg p-2 mt-n4 mt-md-0" type="button"
                    data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#feedbackForm" data-bs-placement="left"
                    title="" data-bs-original-title="{{ __('admin::auth.feedback.index') }}">
                    <img src="{{ asset('assets/backend/img/icons/optimized/feedback-white.png') }}" style="height: 20px;">
                </button>
            </div> --}}
            @if ($setting->back_to_top_status == 'Active')
                <div class="backToTop">
                    <button class="btn bg-gradient-dark border-radius-lg p-2 mt-n4 mt-md-0" type="button"
                        data-bs-toggle="tooltip" data-bs-placement="left" title=""
                        data-bs-original-title="{{ __('admin::auth.back_to_top') }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/back_to_top-white.png') }}" style="height: 20px;">
                    </button>
                </div>
            @endif

        </div>
    </div>

</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackForm" tabindex="-1" role="dialog" aria-labelledby="feedbackFormLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="feedbackFormLabel">
                    <img src="{{ asset('assets/backend/img/icons/optimized/feedback.png') }}" class="pageicon" alt="">
                    {{ __('feedback::feedback.feedback.name') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="feedback_send_form" class="form panel-body" action="{{ route('admin.fd.store') }}" method="POST"
                role="form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
                                    <label class="form-label" for="category_id"><span class="required">{{ __('feedback::feedback.feedback.form.category_id') }}</span></label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        {{-- <option value="">{{ __('feedback::feedback.feedback.form.select_category') }}</option> --}}
                                        @foreach (\Modules\Feedback\Entities\FeedbackCategory::where('status','Active')->get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline mt-3 is-filled @error('name') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{{ __('feedback::feedback.feedback.form.name') }}</span></label>
                                    <input type="text" name="name" class="form-control" required @if (isset(auth()->user()->name)) value="{{ auth()->user()->name }}" @endif>
                                    @error('name')
                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline mt-3 is-filled @error('mobile') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{{ __('feedback::feedback.feedback.form.mobile') }}</span></label>
                                    <input type="number" name="mobile" class="form-control" required @if (isset(auth()->user()->mobile)) value="{{ auth()->user()->mobile }}" @endif>
                                    @error('mobile')
                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror ">
                                    <label class="form-label"><span class="required">{{ __('feedback::feedback.feedback.form.title') }}</span></label>
                                    <input type="text" name="title" class="form-control" required>
                                    @error('title')
                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror ">
                                    <label class="form-label"><span class="required">{{ __('feedback::feedback.feedback.form.description') }}</span></label>
                                    <textarea class="form-control" name="description" rows="5" spellcheck="false" required></textarea>
                                    @error('description')
                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-dark btn-rounded pull-right" type="submit">
                        <img src="{{ asset('assets/backend/img/icons/optimized/send-white.png') }}" class="pageicon" alt="">
                        {{ __('core::core.send') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@push('js')

    <script>
        $(document).ready(function() {
            $("#feedback_send_form").validate({

                rules: {
                    category_id: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    mobile: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    captcha: {
                        required: true
                    },
                },


                messages: {
                    category_id: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    name: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    mobile: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    title: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    category_id: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    description: {
                        required: "{{ __('core::core.form.validation.required') }}",
                    },
                    captcha: {
                        required: "",
                    },
                },

                errorElement: "em",

                errorPlacement: function(error, element) {
                    console.log(element.closest('.input-group'));
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element, errorClass, validClass) {
                    // $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );

                    $(element).closest('.input-group').addClass("is-invalid").removeClass("is-valid");
                    $(element).closest('.input-group').addClass("focused");
                    $(element).closest('.input-group').addClass("is-focused");
                    $('button[type="submit"]').removeAttr('disabled');
                },
                unhighlight: function(element, errorClass, validClass) {
                    // $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );

                    $(element).closest('.input-group').addClass("is-valid").removeClass("is-invalid")
                }

            });
        });
    </script>

<script>
    $("#feedback_send_form").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        $("#feedback_send_form").validate({

            rules: {
                category_id: {
                    required: true
                },
                name: {
                    required: true
                },
                mobile: {
                    required: true
                },
                title: {
                    required: true
                },
                category_id: {
                    required: true
                },
                description: {
                    required: true
                },
                captcha: {
                    required: true
                },
            },

            messages: {
                category_id: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                name: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                mobile: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                title: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                category_id: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                description: {
                    required: "{{ __('core::core.form.validation.required') }}",
                },
                captcha: {
                    required: "",
                },
            },

            errorElement: "em",

            errorPlacement: function(error, element) {
                console.log(element.closest('.input-group'));
                error.addClass("invalid-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.next("label"));
                } else {
                    error.insertAfter(element);
                }
            },

            highlight: function(element, errorClass, validClass) {
                $(element).closest('.input-group').addClass("is-invalid").removeClass("is-valid");
                $(element).closest('.input-group').addClass("focused");
                $(element).closest('.input-group').addClass("is-focused");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.input-group').addClass("is-valid").removeClass("is-invalid")
            }

        });

        if ($("#feedback_send_form").valid()) {
            var form = $(this);
            var url = form.attr('action');
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.

                success: function(result, xhr) {
                    if (xhr == 'success') {
                        $("#feedback_send_form")[0].reset();
                        @include('admin::layouts.includes.js.json_response')

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });
                        window.location.reload();
                    }
                },
            });
        }
    });
</script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endpush
