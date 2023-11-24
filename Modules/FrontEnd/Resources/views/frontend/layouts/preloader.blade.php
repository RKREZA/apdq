@if ($frontend_setting->preloader_status == 'Active')

    {{-- <div class="preloader" style="    background: #fff;
    height: 100vh;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 9999;">
        <div class="dl">
            <div class="dl__container">
              <div class="dl__corner--top"></div>
              <div class="dl__corner--bottom"></div>
            </div>
            <div class="dl__square">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" class="pulse" alt="" style="width: 100px;">
            </div>
        </div>
    </div> --}}

    <div class="preloader">
        <img src="{{ asset('assets/frontend/img/logo.png') }}" class="preloader_image" alt="">
        <div class="loader">
            <div class="loading">
            </div>
        </div>
    </div>

@endif
