@extends('layouts.main')

@section('breadcrumb')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">            
            <li class="breadcrumb-item active"><span>Beranda</span></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <string>Widgets</string>
                </div>
                <div class="card-body">
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1000"
                                    role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card mb-4 text-white bg-primary">
                                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                                </use>
                                                            </svg>)</span></div>
                                                    <div>Users</div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent text-white p-0" type="button"
                                                        data-coreui-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <svg class="icon">
                                                            <use
                                                                xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                            href="#">Action</a><a class="dropdown-item"
                                                            href="#">Another action</a><a class="dropdown-item"
                                                            href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card mb-4 text-white bg-info">
                                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                                                </use>
                                                            </svg>)</span></div>
                                                    <div>Income</div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent text-white p-0" type="button"
                                                        data-coreui-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <svg class="icon">
                                                            <use
                                                                xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                            href="#">Action</a><a class="dropdown-item"
                                                            href="#">Another action</a><a class="dropdown-item"
                                                            href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                                <canvas class="chart" id="card-chart2" height="70"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card mb-4 text-white bg-warning">
                                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                                                </use>
                                                            </svg>)</span></div>
                                                    <div>Conversion Rate</div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent text-white p-0" type="button"
                                                        data-coreui-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <svg class="icon">
                                                            <use
                                                                xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                            href="#">Action</a><a class="dropdown-item"
                                                            href="#">Another action</a><a class="dropdown-item"
                                                            href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                                                <canvas class="chart" id="card-chart3" height="70"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card mb-4 text-white bg-danger">
                                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                                </use>
                                                            </svg>)</span></div>
                                                    <div>Sessions</div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent text-white p-0" type="button"
                                                        data-coreui-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <svg class="icon">
                                                            <use
                                                                xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                            href="#">Action</a><a class="dropdown-item"
                                                            href="#">Another action</a><a class="dropdown-item"
                                                            href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                                <canvas class="chart" id="card-chart4" height="70"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1001" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">89.9%</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-thin my-2">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis">Widget helper text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">12.124</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-thin my-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis">Widget helper text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">$98.111,00</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-thin my-2">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis">Widget helper text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">2 TB</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-thin my-2">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis">Widget helper text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1002" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1002">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-white bg-primary">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">89.9%</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-white progress-thin my-2">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis-inverse">Widget helper
                                                    text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-white bg-warning">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">12.124</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-white progress-thin my-2">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis-inverse">Widget helper
                                                    text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-white bg-danger">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">$98.111,00</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-white progress-thin my-2">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis-inverse">Widget helper
                                                    text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-white bg-info">
                                            <div class="card-body">
                                                <div class="fs-4 fw-semibold">2 TB</div>
                                                <div>Widget title</div>
                                                <div class="progress progress-white progress-thin my-2">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div><small class="text-medium-emphasis-inverse">Widget helper
                                                    text</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1003" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-bar" id="sparkline-chart-1" height="40"
                                                        width="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-bar" id="sparkline-chart-2" height="40"
                                                        width="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-bar" id="sparkline-chart-3" height="40"
                                                        width="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-line" id="sparkline-chart-4"
                                                        height="40" width="100"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-line" id="sparkline-chart-5"
                                                        height="40" width="100"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-md-2 col-sm-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Title
                                                </div>
                                                <div class="fs-6 fw-semibold py-3">1,123</div>
                                                <div class="c-chart-wrapper mx-auto" style="height:40px;width:80px">
                                                    <canvas class="chart chart-line" id="sparkline-chart-6"
                                                        height="40" width="100"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1004" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-primary text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-info text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-info">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-warning text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-warning">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-danger text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-danger">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1005" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-primary text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                            <div class="card-footer px-3 py-2"><a
                                                    class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                                    href="#"><span class="small fw-semibold">View More</span>
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chevron-right">
                                                        </use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-info text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-info">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                            <div class="card-footer px-3 py-2"><a
                                                    class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                                    href="#"><span class="small fw-semibold">View More</span>
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chevron-right">
                                                        </use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-warning text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-warning">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                            <div class="card-footer px-3 py-2"><a
                                                    class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                                    href="#"><span class="small fw-semibold">View More</span>
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chevron-right">
                                                        </use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-3 d-flex align-items-center">
                                                <div class="bg-danger text-white p-3 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-danger">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                            <div class="card-footer px-3 py-2"><a
                                                    class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                                                    href="#"><span class="small fw-semibold">View More</span>
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chevron-right">
                                                        </use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1006" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1006">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-primary text-white p-4 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-info text-white p-4 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-info">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-warning text-white p-4 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-warning">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-danger text-white p-4 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-danger">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1007" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1007">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-primary text-white py-4 px-5 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-primary">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-info text-white py-4 px-5 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-info">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-warning text-white py-4 px-5 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-warning">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-6 col-lg-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body p-0 d-flex align-items-center">
                                                <div class="bg-danger text-white py-4 px-5 me-3">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fs-6 fw-semibold text-danger">$1.999,50</div>
                                                    <div class="text-medium-emphasis text-uppercase fw-semibold small">
                                                        Widget title</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1008" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1008">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card" style="--cui-card-cap-bg: #3b5998">
                                            <div
                                                class="card-header position-relative d-flex justify-content-center align-items-center">
                                                <svg class="icon icon-3xl text-white my-4">
                                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f">
                                                    </use>
                                                </svg>
                                                <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                                                    <canvas id="social-box-chart-1" height="90"></canvas>
                                                </div>
                                            </div>
                                            <div class="card-body row text-center">
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">89k</div>
                                                    <div class="text-uppercase text-medium-emphasis small">friends</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">459</div>
                                                    <div class="text-uppercase text-medium-emphasis small">feeds</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card" style="--cui-card-cap-bg: #00aced">
                                            <div
                                                class="card-header position-relative d-flex justify-content-center align-items-center">
                                                <svg class="icon icon-3xl text-white my-4">
                                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter">
                                                    </use>
                                                </svg>
                                                <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                                                    <canvas id="social-box-chart-2" height="90"></canvas>
                                                </div>
                                            </div>
                                            <div class="card-body row text-center">
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">973k</div>
                                                    <div class="text-uppercase text-medium-emphasis small">followers</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">1.792</div>
                                                    <div class="text-uppercase text-medium-emphasis small">tweets</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card" style="--cui-card-cap-bg: #4875b4">
                                            <div
                                                class="card-header position-relative d-flex justify-content-center align-items-center">
                                                <svg class="icon icon-3xl text-white my-4">
                                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin">
                                                    </use>
                                                </svg>
                                                <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                                                    <canvas id="social-box-chart-3" height="90"></canvas>
                                                </div>
                                            </div>
                                            <div class="card-body row text-center">
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">500+</div>
                                                    <div class="text-uppercase text-medium-emphasis small">contacts</div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="col">
                                                    <div class="fs-5 fw-semibold">292</div>
                                                    <div class="text-uppercase text-medium-emphasis small">feeds</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1009" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1009">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-medium-emphasis text-end mb-4">
                                                <svg class="icon icon-xxl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                                                </svg>
                                            </div>
                                            <div class="fs-4 fw-semibold">87.500</div><small
                                                class="text-medium-emphasis text-uppercase fw-semibold">Visitors</small>
                                            <div class="progress progress-thin mt-3 mb-0">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-medium-emphasis text-end mb-4">
                                                <svg class="icon icon-xxl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow">
                                                    </use>
                                                </svg>
                                            </div>
                                            <div class="fs-4 fw-semibold">385</div><small
                                                class="text-medium-emphasis text-uppercase fw-semibold">New Clients</small>
                                            <div class="progress progress-thin mt-3 mb-0">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-medium-emphasis text-end mb-4">
                                                <svg class="icon icon-xxl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                                                </svg>
                                            </div>
                                            <div class="fs-4 fw-semibold">1238</div><small
                                                class="text-medium-emphasis text-uppercase fw-semibold">Products
                                                sold</small>
                                            <div class="progress progress-thin mt-3 mb-0">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-medium-emphasis text-end mb-4">
                                                <svg class="icon icon-xxl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie">
                                                    </use>
                                                </svg>
                                            </div>
                                            <div class="fs-4 fw-semibold">28%</div><small
                                                class="text-medium-emphasis text-uppercase fw-semibold">Returning
                                                Visitors</small>
                                            <div class="progress progress-thin mt-3 mb-0">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-medium-emphasis text-end mb-4">
                                                <svg class="icon icon-xxl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer">
                                                    </use>
                                                </svg>
                                            </div>
                                            <div class="fs-4 fw-semibold">5:34:11</div><small
                                                class="text-medium-emphasis text-uppercase fw-semibold">Avg. Time</small>
                                            <div class="progress progress-thin mt-3 mb-0">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1010" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1010">
                                <div class="row">
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">87.500</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">Visitors</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">385</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">New
                                                    Clients</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">1238</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">Products
                                                    sold</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">28%</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">Returning
                                                    Visitors</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">5:34:11</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">Avg.
                                                    Time</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speech">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">972</div><small
                                                    class="text-medium-emphasis text-uppercase fw-semibold">Comments</small>
                                                <div class="progress progress-thin mt-3 mb-0">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1011" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1011">
                                <div class="row">
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-info">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">87.500</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">Visitors</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-success">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">385</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">New
                                                    Clients</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-warning">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">1238</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">Products
                                                    sold</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-primary">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">28%</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">Returning
                                                    Visitors</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-danger">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">5:34:11</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">Avg.
                                                    Time</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6 col-md-2">
                                        <div class="card text-white bg-info">
                                            <div class="card-body">
                                                <div class="text-medium-emphasis-inverse text-end mb-4">
                                                    <svg class="icon icon-xxl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speech">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <div class="fs-4 fw-semibold">972</div><small
                                                    class="text-medium-emphasis-inverse text-uppercase fw-semibold">Comments</small>
                                                <div class="progress progress-white progress-thin mt-3">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
