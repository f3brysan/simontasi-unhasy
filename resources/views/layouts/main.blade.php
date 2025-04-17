<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ URL::to('/') }}/./">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Tracking Aktivitas Laporan dan Evaluasi Naskah Tugas Akhir">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>TALENTA - Universitas Hasyim Asy'ari</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
    <link rel="manifest" href="{{ URL::to('/') }}/assets/icons/favicon-talenta.png">
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
    <link href="{{ URL::to('/') }}/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- TOAST JS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('css')
</head>

<body>
    @include('layouts.navbar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('layouts.header')

        {{-- START CONTENT --}}
        @yield('content')
        {{-- END CONTENT --}}

        <footer class="footer">
            <div><a href="{{ URL::to('/') }}/https://coreui.io">CoreUI </a><a
                    href="{{ URL::to('/') }}/https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.
            </div>
            <div class="ms-auto">Powered by&nbsp;<a href="{{ URL::to('/') }}/https://coreui.io/docs/">CoreUI UI
                    Components</a></div>
        </footer>
    </div>
    <!-- CoreUI and necessary plugins-->

    <script src="{{ URL::to('/') }}/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="{{ URL::to('/') }}/vendors/simplebar/js/simplebar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                iziToast.success({
                    title: 'Berhasil !',
                    message: "{{ session('success') }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                iziToast.warning({
                    title: 'Perhatian !',
                    message: "{{ session('error') }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif
    @stack('js')
</body>

</html>
