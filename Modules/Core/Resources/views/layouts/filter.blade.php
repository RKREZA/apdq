<div class="row">
    <div class="col-md-12 px-md-0">
        <div class="card mb-1">
            <div class="card-body">

                <form action="{{ $include_action }}" method="{{ $include_method }}" class="mt-1" >
                    @csrf
                    <div class="container-fluid px-0 px-md-1">
                        <div class="row">

                            @if (in_array('date', $include_fields))
                                <div class="col-6 col-md col-sm mb-md-0 mb-3 px-1 px-md-1 px-sm-0">
                                    <div class="input-group input-group-outline my-0 is-filled border-success">
                                        <label class="form-label">{{ __('core::core.form.date') }}</label>
                                        <input type="date" class="form-control datepicker" name="date" id="date" placeholder="{{ __('core::core.all') }}">
                                    </div>
                                </div>
                            @endif

                            @if (in_array('status', $include_fields))
                                <div class="col-6 col-md col-sm mb-md-0 mb-3 px-1 px-md-1 px-sm-0">
                                    <div class="input-group input-group-outline my-0 is-filled border-success">
                                        <label class="form-label">{{ __('core::core.form.status') }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">{{ __('core::core.all') }}</option>
                                            <option value="Active" @if(request()->status == 'Active') selected @endif>Active</option>
                                            <option value="Inactive" @if(request()->status == 'Inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            @endif


                            <input type="text" name="include_from" id="include_from" value="{{ $include_from }}" hidden>

                            <div class="col-6 col-md col-sm mb-md-0 mb-3 px-1 px-md-1 px-sm-0">
                                <button type="submit" class="create-button btn btn-dark btn-lg d-block my-0 w-100" id="result" name="result" style="">{{ __('core::core.filter') }}</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(".datepicker").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        defaultDate: ["@if (request()->date != null) {{ request()->date }} @endif"],
    });
</script>

{{-- <script>
    $(document).ready(function(){

        $('#project_type_id').on('change', function(){
            var project_type_id = $(this).val();
            if(project_type_id){
                $.ajax({
                    type:'get',
                    url:`{{ route('admin.get_services_by_type') }}`,
                    data:'project_type_id='+project_type_id,
                    success:function(html){
                        if(html != ""){
                            $('#project_service_id').html("<option value='' readonly disabled selected>সাব ক্যাটেগরি সিলেক্ট করুন</option>"+html);
                            $('#project_service_id').removeAttr("disabled");
                        }
                    }
                });
            }
        });

        $('#project_form_category_id').on('change', function(){
            var project_form_category_id = $(this).val();
            if(project_form_category_id){
                $.ajax({
                    type:'get',
                    url:`{{ route('admin.get_sub_category_by_category') }}`,
                    data:'project_form_category_id='+project_form_category_id,
                    success:function(html){
                        $('#project_form_subcategory_id').html(html);

                        if(html != ""){
                            $('#project_form_subcategory_id').html("<option value='' readonly disabled selected>সাব ক্যাটেগরি সিলেক্ট করুন</option>"+html);
                            $("#project_form_subcategory_id").removeAttr("disabled");
                        }
                    }
                });
            }
        });

    });
</script> --}}
@endpush
