@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="page-container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 text-uppercase fw-bold m-0">Dashboard</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row row-cols-xxl-3 row-cols-md-2 row-cols-1 text-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Subscribtions
                                        Active</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:account-check"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$user_subscription_active}}</h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 9.19%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Subscribtions
                                        Expired</h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:account-off"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$user_subscription_inactive}}</h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 26.87%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Streamers
                                    </h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:video-account"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$user_streamers}} </h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ti ti-caret-up-filled"></i> 3.51%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Number of Channels
                                    </h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:youtube-tv"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$channels_count}}</h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 1.05%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Paid Users
                                    </h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:account-cash"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$user_subscriptions}}</h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 1.05%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">Total Users
                                    </h5>
                                    <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                        <div class="user-img fs-42 flex-shrink-0">
                                            <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                <iconify-icon icon="mdi:account-group"></iconify-icon>
                                            </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">{{$users}}</h3>
                                    </div>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 1.05%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->

                    {{-- <div class="row">
                        <div class="col-xxl-4">
                            <div class="card">
                                <div
                                    class="card-header d-flex justify-content-between align-items-center border-bottom border-dashed">
                                    <h4 class="header-title">Top Traffic by Source</h4>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop p-0"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div id="multiple-radialbar" class="apex-charts"
                                        data-colors="#6ac75a,#313a46,#ce7e7e,#669776"></div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="d-flex justify-content-between align-items-center p-1">
                                                <div>
                                                    <i class="ti ti-circle-filled fs-12 align-middle me-1 text-primary"></i>
                                                    <span class="align-middle fw-semibold">Direct</span>
                                                </div>
                                                <span class="fw-semibold text-muted float-end"><i
                                                        class="ti ti-arrow-badge-down text-danger"></i> 965</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center p-1">
                                                <div>
                                                    <i class="ti ti-circle-filled fs-12 text-success align-middle me-1"></i>
                                                    <span class="align-middle fw-semibold">Social</span>
                                                </div>
                                                <span class="fw-semibold text-muted float-end"><i
                                                        class="ti ti-arrow-badge-up text-success"></i> 75</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between align-items-center p-1">
                                                <div>
                                                    <i
                                                        class="ti ti-circle-filled fs-12 text-secondary align-middle me-1"></i>
                                                    <span class="align-middle fw-semibold"> Marketing</span>
                                                </div>
                                                <span class="fw-semibold text-muted float-end"><i
                                                        class="ti ti-arrow-badge-up text-success"></i> 102</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center p-1">
                                                <div>
                                                    <i class="ti ti-circle-filled fs-12 text-danger align-middle me-1"></i>
                                                    <span class="align-middle fw-semibold">Affiliates</span>
                                                </div>
                                                <span class="fw-semibold text-muted float-end"><i
                                                        class="ti ti-arrow-badge-down text-danger"></i> 96</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col--> --}}

                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="header-title">Monthly Revenue Chart</h4>
                                    {{-- <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export</a>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="card-body pt-0">
                                    <div dir="ltr">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <select id="filter-month" class="form-select w-auto">
                                                <option value="">All Months</option>
                                                @foreach(range(1, 12) as $m)
                                                    <option value="{{ $m }}" {{ now()->month == $m ? 'selected' : '' }}>
                                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            <select id="filter-year" class="form-select w-auto">
                                                <option value="">All Years</option>
                                                @for ($y = now()->year; $y >= 2020; $y--)
                                                    <option value="{{ $y }}" {{ now()->year == $y ? 'selected' : '' }}>{{ $y }}
                                                    </option>
                                                @endfor
                                            </select>

                                            <button id="filter-btn" class="btn btn-primary">Filter</button>
                                            <button id="reset-btn" class="btn btn-dark">Reset</button>
                                        </div>
                                        <div id="monthly-revenue-chart" style="min-height: 350px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div> <!-- end row-->

        </div>

    </div>
    <script>
        let chart;

        function loadChartData(month = '', year = '') {
            fetch(`{{ route('admin.dashboard.chart-data') }}?month=${month}&year=${year}`)
                .then(response => response.json())
                .then(data => {
                    const options = {
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        series: [{
                            name: 'Revenue',
                            data: data.totals
                        }],
                        xaxis: {
                            categories: data.labels
                        },
                        colors: ['#f0dcb1'],
                        dataLabels: {
                            enabled: true,
                            formatter: val => "$" + parseFloat(val).toFixed(2),
                            style: { colors: ['#000'] }
                        },
                        tooltip: {
                            y: {
                                formatter: val => "$" + parseFloat(val).toFixed(2)
                            }
                        }
                    };

                    if (chart) {
                        chart.updateOptions(options);
                    } else {
                        chart = new ApexCharts(document.querySelector("#monthly-revenue-chart"), options);
                        chart.render();
                    }
                });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const month = document.getElementById('filter-month').value;
            const year = document.getElementById('filter-year').value;
            loadChartData(month, year); // 👈 load default current month/year

            document.getElementById('filter-btn').addEventListener('click', function () {
                const month = document.getElementById('filter-month').value;
                const year = document.getElementById('filter-year').value;
                loadChartData(month, year);
            });

            document.getElementById('reset-btn').addEventListener('click', function () {
                document.getElementById('filter-month').value = '{{ now()->month }}';
                document.getElementById('filter-year').value = '{{ now()->year }}';
                loadChartData({{ now()->month }}, {{ now()->year }});
            });
        });

    </script>
@endsection