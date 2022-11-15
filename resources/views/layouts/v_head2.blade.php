<head>
    <meta charset="utf-8" />
    {{-- <title>{{ $title }}</title> --}}
    <title>LAPORAN PENDAPATAN ASLI DAERAH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template') }}/assets/images/logo/logo-ayam.png">

    <!-- third party css -->
    <link href="{{ asset('template') }}/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('template') }}/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('template') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('template') }}/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    {{-- Vue --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs/jqc-1.12.4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs/jqc-1.12.4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.js">
    </script>

    <!-- Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
</head>
