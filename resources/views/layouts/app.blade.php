<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Tambahkan link CSS SB Admin 2 -->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @if(Auth::user()->role == 'admin')
    @include('layouts.sidebar-admin')
@else
    @include('layouts.sidebar')
@endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>

    </div>

    <!-- Tambahkan script JS SB Admin 2 -->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
    <script>
    setInterval(() => {
        fetch("{{ route('user.update.activity') }}")
            .then(response => response.json())
            .then(data => console.log(data.message))
            .catch(error => console.error('Error:', error));
    }, 60000); // Setiap 60 detik
</script>
</body>
</html>
