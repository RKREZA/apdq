@extends('admin::layouts.main')

@section('page_title')
{{ $feedback->title }}
@endsection

@push('css')
    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.feedbacks.index'),
        // 'include_button'       => [
        //     '1'       => [
        //         'url'                   => route('admin.feedbackcategories.index'),
        //         'text'                  => __('feedback::feedback.category.name'),
        //         'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
        //         'permission'            => 'feedbackcategory-list',
        //     ],
        // ],
        'include_header'        => $feedback->title,
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.feedbacks.index')      => __('feedback::feedback.feedback.name'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.feedbacks.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
        //     'permission'            => 'feedback-trash',
        // ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
                        <p class="mb-0 text-sm">{{ date('h:i A', strtotime($feedback->created_at)) }} <span class="badge badge-secondary float-end">{{ $feedback->category->name }}</span></p>
                        <p class="mb-0 text-sm">{{ date('jS F, Y', strtotime($feedback->created_at)) }}</p>
                        <hr>
                        <p class="mb-4 text-lg text-justify">{{ $feedback->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@push('js')

@endpush
