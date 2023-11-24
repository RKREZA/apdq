{{-- <div class="row my-3" style="border: 1px solid #ccc; padding: 8px 1px;background: #ecf2f4;">
    <div class="col-9">
        <span class="captcha_img"></span>
    </div>
    <div class="col-3 ps-0 text-end">
        <button type="button" class="btn btn-md btn-refresh text-end" style="">
            <i class="material-icons">refresh</i>
        </button>
    </div>
    <div class="col-sm-12">
        <div class="form-group form-group-outline mt-1 is-filled @error('captcha') is-invalid @enderror">
            <input type="text" name="captcha" style="border-radius: 0" class="form-control px-2 bg-white" id="captcha" placeholder="{{ __('admin::auth.form.captcha') }}" required>
            @error('captcha')
                <em class="error" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>
</div>


@push('js')
<script type="text/javascript">

    $(document).ready(function() {
        $.ajax({
            type:'GET',
            url:`{{ route("refresh_captcha") }}`,
            context: document.body,
            success:function(data){
                $(".captcha_img").html(data.captcha);
            }
        });
    });


    $(".btn-refresh").click(function(){
        $.ajax({
            type:'GET',
            url:'{{ route("refresh_captcha") }}',
            success:function(data){
                $(".captcha_img").html(data.captcha);
            }
        });
    });
</script>
@endpush --}}