@if (isset($settings->preloader_status) && $settings->preloader_status == 'Active')

    <style>
        #overlay{
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height:100%;
            background: rgba(0,0,0,0.6);
            z-index: 10000;
        }
        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #004884 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }
        @keyframes sp-anime {
            100% {
            transform: rotate(360deg);
            }
        }
    </style>

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    @push('js')
        <script>
            var $loading = $('#overlay');
            $(document)
            .ajaxStart(function () {
                $loading.fadeIn();
            })
            .ajaxStop(function () {
                $loading.fadeOut();
            });


            $(window).on('load', function () {
                $loading.fadeOut();
            })

        </script>
    @endpush

@endif
