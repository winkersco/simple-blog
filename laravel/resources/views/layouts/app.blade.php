<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @yield('title')
    @yield('pre-styles')
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    @yield('styles')
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    @yield('pre-scripts')
</head>

<body class="sb-nav-fixed">
    @include('inc.topnav')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('inc.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('header')
                    @yield('breadcrumb')
                    @include('inc.messages')
                    @include('inc.errors')
                    @yield('content')
                </div>
            </main>
            @include('inc.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>
