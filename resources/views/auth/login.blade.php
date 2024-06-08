<!DOCTYPE html><!--
    * CoreUI - Free Bootstrap Admin Template
    * @version v4.2.2
    * @link https://coreui.io/product/free-bootstrap-admin-template/
    * Copyright (c) 2023 creativeLabs Łukasz Holeczek
    * Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
    -->
<html lang="en">

<head>
    <base href="{{ URL::to('/') }}/./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Monit Universitas Hasyim Asy'ari">
    <meta name="author" content="Universitas Hasyim Asy'ari">
    <meta name="keyword" content="university, education, monitoring">
    <title>Monit Universitas Hasyim Asy'ari</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::to('/') }}/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::to('/') }}/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::to('/') }}/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to('/') }}/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::to('/') }}/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::to('/') }}/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::to('/') }}/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::to('/') }}/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to('/') }}/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ URL::to('/') }}/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to('/') }}/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::to('/') }}/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('/') }}/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{ URL::to('/') }}/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="{{ URL::to('/') }}/css/examples.css" rel="stylesheet">
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <form action="{{ URL::to('login') }}" method="POST">
                              @csrf
                                <div class="card-body">
                                    <h1>Login</h1>
                                    <p class="text-medium-emphasis">Sign In to your account</p>
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ URL::to('/') }}/vendors/@coreui/icons/svg/free.svg#cil-user">
                                                </use>
                                            </svg></span>

                                        <input class="form-control" type="text" placeholder="NIM/NIP"
                                            name="no_induk">
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ URL::to('/') }}/vendors/@coreui/icons/svg/free.svg#cil-lock-locked">
                                                </use>
                                            </svg></span>
                                        <input class="form-control" type="password" placeholder="Password"
                                            name="password">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Login</button>
                                        </div>                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>MONIT UNHASY</h2>
                                    <p>Sistem Monitoring Tugas Akhir/Skripsi/Tesis</p>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ URL::to('/') }}/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="{{ URL::to('/') }}/vendors/simplebar/js/simplebar.min.js"></script>
    <script></script>

</body>

</html>
