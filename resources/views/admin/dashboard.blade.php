@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Selamat Datang di Dashboard Admin UMKMPlus</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="{{ route('admin.course') }}" class="btn btn-white btn-border btn-round mr-2">Data Kelas</a>
                        <a href="{{ route('admin.withdraw') }}" class="btn btn-secondary btn-round">Lihat Keuangan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                {{-- siswa --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Siswa</p>
                                        <h4 class="card-title">1,294</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- mentor --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="flaticon-customer-support"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Mentor</p>
                                        <h4 class="card-title">1303</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- kelas --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="flaticon-interface-2"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Kelas</p>
                                        <h4 class="card-title">1,345</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- blog --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="flaticon-interface-6"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Blog</p>
                                        <h4 class="card-title">576</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Kategori Kelas</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="categoryChart" style="width: 50%; height: 50%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Keuangan Tahunan (2023)</div>
                            <div class="card-category">1 Januari - 31 Desember</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>Rp 120.450.200</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="annualFinancialChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        //Notify
        $.notify({
            icon: 'flaticon-alarm-1',
            title: 'UMKMPlus Admin',
            message: 'Selamat Datang di Dashboard UMKMPlus',
        }, {
            type: 'secondary',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 2000,
        });

        const categoryData = {
            labels: ['Branding', 'Desain', 'Marketing', 'Finance', 'Technology & E-Commerce'],
            datasets: [{
                data: [10, 20, 30, 27, 63],
                backgroundColor: [
                    '#FF9F55',
                    '#6DCFF6',
                    '#FFD966',
                    '#66CC99',
                    '#B46CE8',
                ],
            }],
        }
        const categoryConfig = {
            type: 'doughnut',
            data: categoryData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        }

        const categoryChart = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryChart, categoryConfig);

        const annualFinancialData = {
            labels: ["Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            datasets: [{
                label: "Annual Financial Analytics",
                fill: !0,
                backgroundColor: "rgba(255,255,255,0.2)",
                borderColor: "#fff",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                pointBorderColor: "#fff",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 1,
                pointRadius: 1,
                pointHitRadius: 5,
                data: [65, 59, 80, 81, 56, 55, 40, 65, 40, 52, 73, 75],
            }]
        }
        const annualFinancialConfig = {
            type: 'line',
            data: annualFinancialData,
            options: {
                maintainAspectRatio: !1,
                legend: {
                    display: !1
                },
                animation: {
                    easing: "easeInOutBack"
                },
                scales: {
                    yAxes: [{
                        display: !1,
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: !0,
                            maxTicksLimit: 10,
                            padding: 0
                        },
                        gridLines: {
                            drawTicks: !1,
                            display: !1
                        }
                    }],
                    xAxes: [{
                        display: !1,
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: -20,
                            fontColor: "rgba(255,255,255,0.2)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        }

        const annualFinancialChart = document.getElementById('annualFinancialChart').getContext('2d');
        new Chart(annualFinancialChart, annualFinancialConfig);
    </script>
@endsection
