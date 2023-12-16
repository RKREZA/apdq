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

    <div class="row my-2 mt-4">

        <div class="col-md-3 mb-2 ps-md-0">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-play-alt"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">{{ __('core::core.total') }} {{ __('video::video.video.names') }}</p>
                            <h4 class="mb-0">{{ $videos }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('video::video.video.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-money-check-edit"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">{{ __('core::core.total') }} {{ __('subscription::subscription.subscription.names') }}</p>
                            <h4 class="mb-0">{{ $subscriptions }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('subscription::subscription.subscription.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-envelope-download"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">{{ __('core::core.total') }} {{ __('core::core.emails') }}</p>
                            <h4 class="mb-0">{{ $newsletters }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('newsletter::newsletter.newsletter.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2 pe-md-0">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-message-dollar"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">{{ __('core::core.total') }} {{ __('core::core.amount') }}</p>
                            <h4 class="mb-0">{{ $transactions->sum('payment_amount') }}$</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('transaction::transaction.transaction.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-2 mb-md-2 ps-md-0">
            <div class="card rounded-3">
                <div class="card-header p-3">
                    <h5 class="mb-0">{{ __('transaction::transaction.transaction.transaction_amount_by_month') }}</h5>
                </div>

                <div class="card-body p-3">
                    <canvas id="transactionChart" height="540"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-2 mb-md-2 pe-md-0">
            <div class="card rounded-3">
                <div class="card-header p-3">
                    <h5 class="mb-0">{{ __('transaction::transaction.transaction.transaction_count_by_month') }}</h5>
                </div>

                <div class="card-body p-3">
                    <canvas id="transactionCountChartByMonth" height="540"></canvas>
                </div>
            </div>
        </div>

    </div>


@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var transactions = @json($transactions);

    initializeView();

    function initializeView() {
        // Prepare the data for the bar chart
        var barChartData = prepareBarChartData(transactions);

        // Prepare the data for the line chart
        var lineChartData = prepareLineChartData(transactions);

        // Create the bar chart
        createBarChart(barChartData);

        // Create the line chart
        createLineChart(lineChartData);
    }

    function prepareBarChartData(data) {
        var monthsMap = new Map();

        data.forEach(transaction => {
            // Check if created_at exists and is a non-null value
            if (transaction.created_at) {
                var month = transaction.created_at.slice(0, 7);

                if (!monthsMap.has(month)) {
                    monthsMap.set(month, 0);
                }

                monthsMap.set(month, monthsMap.get(month) + parseFloat(transaction.payment_amount));
            }
        });

        var labels = Array.from(monthsMap.keys());
        var data = Array.from(monthsMap.values());

        return { labels: labels, data: data };
    }

    function createBarChart(data) {
        var ctx = document.getElementById('transactionChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: `{{ __('core::core.total') }} {{ __('core::core.amount') }}`,
                    data: data.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            color: '#eee'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        bodyColor: '#333',
                        titleColor: '#555',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyFont: {
                            weight: 'bold'
                        },
                        displayColors: false
                    }
                }
            }
        });
    }

    function prepareLineChartData(data) {
        var monthsMap = new Map();

        data.forEach(transaction => {
            // Check if created_at exists and is a non-null value
            if (transaction.created_at) {
                var month = transaction.created_at.slice(0, 7);

                if (!monthsMap.has(month)) {
                    monthsMap.set(month, 0);
                }

                monthsMap.set(month, monthsMap.get(month) + 1);
            }
        });

        var labels = Array.from(monthsMap.keys());
        var data = Array.from(monthsMap.values());

        return { labels: labels, data: data };
    }

    function createLineChart(data) {

        var ctx = document.getElementById('transactionCountChartByMonth').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Transaction Count',
                    data: data.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            color: '#eee'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        bodyColor: '#333',
                        titleColor: '#555',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyFont: {
                            weight: 'bold'
                        },
                        displayColors: false
                    }
                }
            }
        });
    }
</script>
@endpush
