@if ($frontend_setting->preloader_status == 'Active')
    <div class="preloader">
        <img src="{{ asset('assets/frontend/img/logo.webp') }}" class="preloader_image" alt="">
        <div class="loader">
            <div class="loading">
            </div>
        </div>
    </div>
@endif
