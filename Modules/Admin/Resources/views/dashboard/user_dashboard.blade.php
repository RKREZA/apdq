@extends('admin::layouts.main')

@section('page_title')
    {{ __('admin::dashboard.title') }}
@endsection

@push('css')
<style>
    /* #application_chart{
        height: 500px !important;
    }
    #grant_chart{
        height: 500px !important;
        width: 500px !important;
        margin: auto;
    } */
</style>
@endpush

@section('container')
    @if (isset($announcements) && count($announcements)>0)
        @foreach ($announcements as $announcement)
            <div class="custom_alert border-3">
                <div class="alert alert-{{ strtolower($announcement->type) }} alert-dismissible fade show" role="alert">
                    {!! $announcement->description !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row my-2">

        <div class="col-md-12 mb-2 mb-md-2 px-md-0">
            <div class="card rounded-3">
                <div class="card-header p-3">
                    <h5 class="mb-0">{{ __('faq::faq.faq.name') }}</h5>
                </div>

                <div class="card-body border-0 p-3" style="min-height: 230px;">
                    <div class="accordion" id="accordionExample">
                        @foreach ($faqs as $faq)
                            <div class="accordion-item">
                                <b class="accordion-header" id="headingOne">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapseOne">
                                    {{ $faq->title }}
                                    </button>
                                </b>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! $faq->description !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                      </div>
                </div>
                <div class="card-footer p-3">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-info rounded-3">{{ __('core::core.all') }}</a>
                </div>
            </div>
        </div>

    </div>


@endsection


@push('js')

@endpush
