@extends('main')

@section('custom-css')
@endsection

@section('content')
    {{-- Page header --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Halaman
                    </div>
                    <h2 class="page-title">
                        Statistik
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-indigo text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrows-transfer-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M17 3v6"></path>
                                                    <path d="M10 18l-3 3l-3 -3"></path>
                                                    <path d="M7 21v-18"></path>
                                                    <path d="M20 6l-3 -3l-3 3"></path>
                                                    <path d="M17 21v-2"></path>
                                                    <path d="M17 15v-2"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="fw-bold">
                                                {{ $totalTransaction }}
                                            </div>
                                            <div class="text-muted">
                                                transaksi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-teal text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <circle cx="6" cy="19" r="2" />
                                                    <circle cx="17" cy="19" r="2" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="fw-bold">
                                                {{ $totalItemSold }}
                                            </div>
                                            <div class="text-muted">
                                                item terjual
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-lime text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-brand-cashapp" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M17.1 8.648a.568 .568 0 0 1 -.761 .011a5.682 5.682 0 0 0 -3.659 -1.34c-1.102 0 -2.205 .363 -2.205 1.374c0 1.023 1.182 1.364 2.546 1.875c2.386 .796 4.363 1.796 4.363 4.137c0 2.545 -1.977 4.295 -5.204 4.488l-.295 1.364a.557 .557 0 0 1 -.546 .443h-2.034l-.102 -.011a.568 .568 0 0 1 -.432 -.67l.318 -1.444a7.432 7.432 0 0 1 -3.273 -1.784v-.011a.545 .545 0 0 1 0 -.773l1.137 -1.102c.214 -.2 .547 -.2 .761 0a5.495 5.495 0 0 0 3.852 1.5c1.478 0 2.466 -.625 2.466 -1.614c0 -.989 -1 -1.25 -2.886 -1.954c-2 -.716 -3.898 -1.728 -3.898 -4.091c0 -2.75 2.284 -4.091 4.989 -4.216l.284 -1.398a.545 .545 0 0 1 .545 -.432h2.023l.114 .012a.544 .544 0 0 1 .42 .647l-.307 1.557a8.528 8.528 0 0 1 2.818 1.58l.023 .022c.216 .228 .216 .569 0 .773l-1.057 1.057z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="fw-bold">
                                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                            </div>
                                            <div class="text-muted">
                                                total pendapatan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-cyan text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-coffee" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M3 14c.83 .642 2.077 1.017 3.5 1c1.423 .017 2.67 -.358 3.5 -1c.83 -.642 2.077 -1.017 3.5 -1c1.423 -.017 2.67 .358 3.5 1">
                                                    </path>
                                                    <path d="M8 3a2.4 2.4 0 0 0 -1 2a2.4 2.4 0 0 0 1 2"></path>
                                                    <path d="M12 3a2.4 2.4 0 0 0 -1 2a2.4 2.4 0 0 0 1 2"></path>
                                                    <path d="M3 10h14v5a6 6 0 0 1 -6 6h-2a6 6 0 0 1 -6 -6v-5z"></path>
                                                    <path d="M16.746 16.726a3 3 0 1 0 .252 -5.555"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="fw-bold">
                                                {{ $totalMenu }}
                                            </div>
                                            <div class="text-muted">
                                                total menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Transaksi <span class="text-muted fs-5">(sebulan terakhir)</span></h3>
                            <div id="transactionChart" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Pendapatan <span class="text-muted fs-5">(sebulan terakhir)</span></h3>
                            <div id="revenueChart" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="card-title">Menu terjual <span class="text-muted fs-5">(sebulan terakhir)</span></h3>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="menuChart"></div>
                                </div>
                                <div class="col-md-auto mt-3 mt-sm-0">
                                    <div class="divide-y divide-y-fill">
                                        <div class="px-3">
                                            <div class="text-muted">
                                                <span class="status-dot bg-primary"></span> Minuman
                                            </div>
                                            <div class="h2">{{ array_sum($menuChart['totalDrinkSold']) }}</div>
                                        </div>
                                        <div class="px-3">
                                            <div class="text-muted">
                                                <span class="status-dot bg-azure"></span> Makanan
                                            </div>
                                            <div class="h2">{{ array_sum($menuChart['totalFoodSold']) }}</div>
                                        </div>
                                        <div class="px-3">
                                            <div class="text-muted">
                                                <span class="status-dot bg-green"></span> Camilan
                                            </div>
                                            <div class="h2">{{ array_sum($menuChart['totalSnackSold']) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kasir dengan transaksi terbanyak <span class="text-muted fs-5">(7 teratas)</span></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Total Transaksi</th>
                                        <th>Total Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bestCashier as $cashier)
                                        <tr>
                                            <td>{{ $cashier->name }}</td>
                                            <td>{{ $cashier->total_transaction }}</td>
                                            <td>Rp {{ number_format($cashier->total_revenue, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menu terlaris <span class="text-muted fs-5">(7 teratas)</span></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostSelling as $menu)
                                        <tr>
                                            <td>{{ $menu->name }}</td>
                                            <td>
                                                <span class="badge badge-outline {{ $menu->category_name == 'Minuman' ? 'text-indigo' : ($menu->category_name == 'Makanan' ? 'text-purple' : 'text-pink')}} fs-6">{{ $menu->category_name }}</span>
                                            </td>
                                            <td>{{ $menu->total_sold }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menu kurang laris <span class="text-muted fs-5">(7 teratas)</span></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leastSelling as $menu)
                                        <tr>
                                            <td>{{ $menu->name }}</td>
                                            <td>
                                                <span class="badge badge-outline {{ $menu->category_name == 'Minuman' ? 'text-indigo' : ($menu->category_name == 'Makanan' ? 'text-purple' : 'text-pink')}} fs-6">{{ $menu->category_name }}</span>
                                            </td>
                                            <td>{{ $menu->total_sold }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-js')
    <script src="{{ asset('plugins/tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1669759017') }}" defer></script>
@endsection

@section('custom-js')
    <script>
        const transactionChartData = {!! json_encode($transactionChart) !!}
        const menuChartData = {!! json_encode($menuChart) !!}

        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('transactionChart'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 290,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: -40,
                    },
                    animations: {
                        enabled: true
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Total transaksi",
                    data: transactionChartData.totalTransaction
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: transactionChartData.labels,
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();

            window.ApexCharts && (new ApexCharts(document.getElementById('revenueChart'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 290,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: -40,
                    },
                    animations: {
                        enabled: true
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Total pendapatan",
                    data: transactionChartData.totalRevenue
                }],
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function (value) {
                            return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).split(',')[0]
                        }
                    }
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4,
                        formatter: function (value) {
                            value = (value / 1000000).toFixed(2).toString().replaceAll('.', ',')
                            return `Rp ${value} jt`
                        }
                    },
                },
                labels: transactionChartData.labels,
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();

            window.ApexCharts && (new ApexCharts(document.getElementById('menuChart'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 320,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: -40,
                    },
                    animations: {
                        enabled: true
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Minuman",
                    data: menuChartData.totalDrinkSold
                }, {
                    name: "Makanan",
                    data: menuChartData.totalFoodSold
                }, {
                    name: "Camilan",
                    data: menuChartData.totalSnackSold
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: menuChartData.labels,
                colors: [tabler.getColor("primary"), tabler.getColor("azure"), tabler.getColor(
                    "green")],
                legend: {
                    show: false,
                },
            })).render();
        });
    </script>
@endsection
