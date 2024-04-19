<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="subject" content="Website PTSP Kantor Kementerian Agama Kab.Tanah Datar">
    <meta name="google-site-verification" content="eA5vWNqCfogT0bO_jGCuJrUwkt1bzfvbYUGlRguZWY" />
    <meta name="language" content="Indonesia">
    <meta name="robots" content="index,follow" />
    <meta name="Classification" content="Layanan">
    <meta name="author" content="Ridho Saputra@KEMENAG Kab.Tanah Datar">
    <meta name="developer" content="Ridho Saputra@KEMENAG Kab.Tanah Datar">
    <meta name="owner" content="Kementerian Agama Kab.Tanah Datar">
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name='copyright' content='Kementerian Agama Kab.Tanah Datar | KEMENAGTD'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{asset('assets/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('backend.layout.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= date('Y') ?> &copy; Website PTSP | Kementerian Agama Kab.Tanah Datar</p>
                    </div>
                    <div class="float-end">
                        <p>Copyright<span class="text-danger"></span> by <a
                                href="https://steamcommunity.com/id/trojan01" target=_blank >Ridho Saputra@KEMENAG Kab.Tanah Datar</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/fontawesome/all.min.js') }}"></script>

    <script src="{{ asset('backend/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{ asset('backend/js/main.js') }}"></script>
</body>

</html>