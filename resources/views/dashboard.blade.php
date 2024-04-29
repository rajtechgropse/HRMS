@extends('header')
@section('title', 'Dashboard')

@section('content')
    <div class="layout-px-spacing">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-sales">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Total Number of Leads</p>
                                <p class="widget-numeric-value">1,700</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">+16% this week</p>
                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu left" aria-labelledby="statistics"
                                        style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-orders">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-globe">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Total Number Of Invoice</p>
                                <p class="widget-numeric-value">1,560</p>
                            </div>
                        </div>
                        <div class="d-flex w-bottom">
                            <p class="widget-total-stats">-10% this week</p>
                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu left" aria-labelledby="statistics"
                                        style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget widget-seven">
                        <div class="widget-heading">
                            <h6 class="">Statistics</h6>
                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu left" aria-labelledby="statistics"
                                        style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-chart">
                            <div class="w-chart-section t-visits">
                                <div class="w-chart-render-one">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bar-chart-2">
                                            <line x1="18" y1="20" x2="18" y2="10"></line>
                                            <line x1="12" y1="20" x2="12" y2="4"></line>
                                            <line x1="6" y1="20" x2="6" y2="14"></line>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-detail">
                                    <p class="w-title">Total Visits</p>
                                    <p class="w-stats">423,964</p>
                                </div>
                            </div>
                            <div class="w-chart-section p-visits">
                                <div class="w-chart-render-one">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-detail">
                                    <p class="w-title">Paid Visits</p>
                                    <p class="w-stats">7,929</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">Expenses</h6>
                                </div>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="expenses"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="expenses"
                                            style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value">$ 45,141 <span>this week</span> <svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trending-up">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg></p>
                                </div>
                            </div>
                            <div class="w-progress-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%"
                                        aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <p>57%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-five">
                        <div class="widget-content">
                            <div class="account-box">
                                <div class="info-box">
                                    <div class="icon">
                                        <span>
                                            <img src="../src/assets/img/coin.png" alt="money-bag">
                                        </span>
                                    </div>
                                    <div class="balance-info">
                                        <h6>Total Balance</h6>
                                        <p>$50,820.77</p>
                                    </div>
                                </div>
                                <div class="card-bottom-section">
                                    <div><span class="badge badge-light-success">+ 13.6% <svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trending-up">
                                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                <polyline points="17 6 23 6 23 12"></polyline>
                                            </svg></span></div>
                                    <a href="javascript:void(0);" class="">View Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
