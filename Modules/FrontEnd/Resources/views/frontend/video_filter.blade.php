<div class="row">
    <div class="col-md-12 mb-3">
        @if (isset(request()->code))
            <span class="badge bg-dark text-light badge-sm">
                <i class="fi fi-ss-label" style="transform: rotate(90deg); display:inline-block;"></i> &nbsp;
                {{ request()->code }}
            </span>
        @endif
        @if (isset(request()->tag))
            <span class="badge bg-dark text-light badge-sm">
                <i class="fi fi-ss-label" style="transform: rotate(90deg); display:inline-block;"></i> &nbsp;
                {{ request()->tag }}
            </span>
        @endif
        @if (isset(request()->year))
            <span class="badge bg-dark text-light badge-sm">
                <i class="fi fi-ss-label" style="transform: rotate(90deg); display:inline-block;"></i> &nbsp;
                {{ request()->year }}
            </span>
        @endif

        @if (isset(request()->month))
            <span class="badge bg-dark text-light badge-sm">
                <i class="fi fi-ss-label" style="transform: rotate(90deg); display:inline-block;"></i> &nbsp;
                {{ request()->month }}
            </span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-2">
        <a href="{{ route('frontend.video.latest') }}" class="btn btn-dark m-1 ms-0 {{ request()->is('video/latest*') ? 'active' : '' }}">Les plus récentes</a>
        <a href="{{ route('frontend.video.popular') }}" class="btn btn-dark m-1 ms-0 {{ request()->is('video/popular*') ? 'active' : '' }}">Populaires</a>
        <a href="{{ route('frontend.video.oldest') }}" class="btn btn-dark m-1 ms-0 {{ request()->is('video/oldest*') ? 'active' : '' }}">Les plus anciennes</a>
        <a href="{{ route('frontend.video.playlist') }}" class="btn btn-dark m-1 ms-0 {{ request()->is('playlist*') ? 'active' : '' }}">Playlist</a>
    </div>

    <div class="col-md-6 mb-2 text-end">

        <select name="year" class="btn btn-dark m-1 ms-0 text-start" id="year">
            <option readonly selected disabled> -- Année -- </option>
            @foreach ($yearsMonths as $year=>$month)
                <option value="{{ $year }}" @if(request()->year == $year ) selected @endif>{{ $year }}</option>
            @endforeach
        </select>

        <select name="month" class="btn btn-dark m-1 ms-0 text-start" id="month">
            <option readonly selected disabled> -- Mois -- </option>
            <option value="January" @if(request()->month == 'January' ) selected @endif>Janvier</option>
            <option value="February" @if(request()->month == 'February' ) selected @endif>Février</option>
            <option value="March" @if(request()->month == 'March') selected @endif>Mars</option>
            <option value="April" @if(request()->month == 'April') selected @endif>Avril</option>
            <option value="May" @if(request()->month == 'May') selected @endif>Mai</option>
            <option value="June" @if(request()->month == 'June') selected @endif>Juin</option>
            <option value="July" @if(request()->month == 'July') selected @endif>Juillet</option>
            <option value="August" @if(request()->month == 'August') selected @endif>Août</option>
            <option value="September" @if(request()->month == 'September') selected @endif>Septembre</option>
            <option value="October" @if(request()->month == 'October') selected @endif>Octobre</option>
            <option value="November" @if(request()->month == 'November') selected @endif>Novembre</option>
            <option value="December" @if(request()->month == 'December') selected @endif>Décembre</option>


        </select>

        <select name="code" class="btn btn-dark m-1 ms-0 text-start" id="code">
            <option readonly selected disabled> -- Catégorie -- </option>
            @foreach ($video_categories as $category)
                <option value="{{ $category->code }}" @if(request()->code == $category->code ) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

</div>


@push('js')

<script>
    $(document).ready(function(){
        $('#code').change(function(){
            var categoryCode = $(this).val(); // Get selected category ID
            var currentUrl = window.location.href; // Get current URL
            var newUrl;

            if(currentUrl.indexOf('?') > -1) { // Check if URL already has query parameters
                if(currentUrl.indexOf('code=') > -1) { // Check if code is already in URL
                    // Replace the existing code value
                    newUrl = currentUrl.replace(/(code=)[^\&]+/, '$1' + categoryCode);
                } else {
                    // Add code as a new parameter
                    newUrl = currentUrl + '&code=' + categoryCode;
                }
            } else {
                // Add code as the first query parameter
                newUrl = currentUrl + '?code=' + categoryCode;
            }

            // Redirect to the new URL
            window.location.href = newUrl;
        });

        $('#year').change(function(){
            var year = $(this).val(); // Get selected category ID
            var currentUrl = window.location.href; // Get current URL
            var newUrl;

            if(currentUrl.indexOf('?') > -1) { // Check if URL already has query parameters
                if(currentUrl.indexOf('year=') > -1) { // Check if year is already in URL
                    // Replace the existing year value
                    newUrl = currentUrl.replace(/(year=)[^\&]+/, '$1' + year);
                } else {
                    // Add year as a new parameter
                    newUrl = currentUrl + '&year=' + year;
                }
            } else {
                // Add year as the first query parameter
                newUrl = currentUrl + '?year=' + year;
            }

            // Redirect to the new URL
            window.location.href = newUrl;
        });

        $('#month').change(function(){
            var month = $(this).val(); // Get selected category ID
            var currentUrl = window.location.href; // Get current URL
            var newUrl;

            if(currentUrl.indexOf('?') > -1) { // Check if URL already has query parameters
                if(currentUrl.indexOf('month=') > -1) { // Check if month is already in URL
                    // Replace the existing month value
                    newUrl = currentUrl.replace(/(month=)[^\&]+/, '$1' + month);
                } else {
                    // Add month as a new parameter
                    newUrl = currentUrl + '&month=' + month;
                }
            } else {
                // Add month as the first query parameter
                newUrl = currentUrl + '?month=' + month;
            }

            // Redirect to the new URL
            window.location.href = newUrl;
        });
    });
</script>

@endpush
