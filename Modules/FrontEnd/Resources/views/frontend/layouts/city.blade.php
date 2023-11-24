@php
    $cities = \Modules\Geo\Entities\City::where('status', 'Active')->get();
@endphp

<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end mb-3" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="form-group input-group-outline mb-2 is-filled">
                    <label class="form-label">
                        <span class="required"><b>Select City</b></span>
                    </label>

                    <select name="city_id" id="city_id" class="form-control">
                        <option readonly="" disabled="" selected=""></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if (Session::has('city') && $city->id == Session::get('city')->id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $("#city_id").change(function() {
            $.ajax({
                type:"GET",
                url: `{{ route('frontend.set_city') }}`,
                data: 'id='+$(this).val(),
                success: function() {
                    $("#cityModal").modal('hide');
                    window.location.reload();
                },
                error: function() {
                    alert('Error occured');
                }
            });
        });

        @if (Session::has('city'))
            $(document).ready(function() {
                $("#cityModal").modal('hide');
            });
        @else
            $(document).ready(function() {
                $("#cityModal").modal('show');
            });
        @endif

    </script>
@endpush
