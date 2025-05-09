
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('/myhr/images/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/myhr/images/logo.png') }}" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.css') }}" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.js') }}" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="{{ url('clock/dist/bootstrap-clockpicker.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 45px;
            line-height: 45px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px;
        }

        .select2-results__option {
            line-height: 45px;
        }

        .select2-selection__choice {
            line-height: 45px;
        }
    </style>
    @stack('style')
</head>

<body>
     <div class="preload preload-container">
        <div class="preload-logo"></div>
    </div>

    @yield('container')

    @php
        $settings = App\Models\settings::first();
    @endphp

    <div class="tf-panel left">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-left panel-sidebar">
            <div class="header-sidebar bg_white_color is-fixed">
                <div class="tf-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url('/') }}" class="sidebar-logo">
                            <img src="{{ asset('/storage/'.$settings->logo) }}" alt="logo">
                            <h5>Absensi</h5>
                        </a>
                        <a href="javascript:void(0);" class="clear-panel"> <i class="icon-close1"></i> </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="tf-container">
                    <div class="box-content">

                        <ul class="box-nav">
                            <li class="nav-title">MENU</li>
                            <li>
                                <a href="{{ url('/dashboard') }}" class="nav-link" >
                                    <i class="fas fa-home" style="{{ Request::is('dashboard*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('dashboard*') ? 'color: blue' : '' }}">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-profile') }}" class="nav-link">
                                    <i class="fas fa-user" style="{{ Request::is('my-profile*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-profile*') ? 'color: blue' : '' }}">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/pegawai') }}" class="nav-link">
                                    <i class="fas fa-users" style="{{ Request::is('pegawai*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('pegawai*') ? 'color: blue' : '' }}">Pegawai</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/payroll') }}" class="nav-link">
                                    <i class="fa fa-file-invoice-dollar" style="{{ Request::is('payroll*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('payroll*') ? 'color: blue' : '' }}">Payroll</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-dokumen') }}" class="nav-link">
                                    <i class="fa fa-folder-open" style="{{ Request::is('my-dokumen*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-dokumen*') ? 'color: blue' : '' }}">Dokumen</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/kasbon') }}" class="nav-link">
                                    <i class="fa fa-comments-dollar" style="{{ Request::is('kasbon*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('kasbon*') ? 'color: blue' : '' }}">Kasbon</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/cuti') }}" class="nav-link">
                                    <i class="fa fa-hourglass-half" style="{{ Request::is('cuti*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('cuti*') ? 'color: blue' : '' }}">Cuti / Izin</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/absen') }}" class="nav-link">
                                    <i class="fa fa-camera" style="{{ Request::is('absen*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('absen*') ? 'color: blue' : '' }}">Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-absen') }}" class="nav-link">
                                    <i class="fa fa-table" style="{{ Request::is('my-absen*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-absen*') ? 'color: blue' : '' }}">My Absen</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/dinas-luar') }}" class="nav-link">
                                    <i class="fa fa-stopwatch" style="{{ Request::is('dinas-luar*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('dinas-luar*') ? 'color: blue' : '' }}">Dinas Luar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-dinas-luar') }}" class="nav-link">
                                    <i class="fa fa-user-secret" style="{{ Request::is('my-dinas-luar*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-dinas-luar*') ? 'color: blue' : '' }}">My Dinas Luar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/lembur') }}" class="nav-link">
                                    <i class="fa fa-user-clock" style="{{ Request::is('lembur*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('lembur*') ? 'color: blue' : '' }}">Lembur</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-lembur') }}" class="nav-link">
                                    <i class="fa fa-business-time" style="{{ Request::is('my-lembur*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-lembur*') ? 'color: blue' : '' }}">My Lembur</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/request-location') }}" class="nav-link">
                                    <i class="fa fa-holly-berry" style="{{ Request::is('request-location*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('request-location*') ? 'color: blue' : '' }}">Request Location</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/euforia') }}" class="nav-link">
                                    <i class="fa fa-baby" style="{{ Request::is('euforia*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('euforia*') ? 'color: blue' : '' }}">Euforia</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/pengajuan-absensi') }}" class="nav-link">
                                    <i class="fas fa-envelope-open-text" style="{{ Request::is('pengajuan-absensi*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('pengajuan-absensi*') ? 'color: blue' : '' }}">Pengajuan Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/notifications') }}" class="nav-link">
                                    <i class="fas fa-bell" style="{{ Request::is('notifications*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('notifications*') ? 'color: blue' : '' }}">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" class="nav-link" onclick="return confirm('Are You Sure?')">
                                    <i class="fas fa-sign-out-alt" style="{{ Request::is('logout*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('logout*') ? 'color: blue' : '' }}">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/clock/dist/bootstrap-clockpicker.min.js') }}"></script>
    <script>
        config = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        }

        flatpickr("input[type=datetime-local]", config)
        flatpickr("input[type=datetime]", {})

        $(function () {

            $('#tablePayroll').DataTable( {
                "responsive": true,
                "paging": false,
                "info": false,
                "scrollCollapse": true,
                "autoWidth": false,
                'searching': false
            });
             $("#tableprint").DataTable({
                "responsive": true, "autoWidth": false,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: 'flrtip'
                // "buttons": ["excel", "pdf", "print"]
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tableprint_wrapper .col-md-6:eq(0)');


        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('/push/bin/push.js') }}"></script>
    <script src="{{ url('/js/app.js') }}"></script>
    <script>
        window.Echo.channel("messages").listen("NotifApproval", (event) => {
            var user_id = {{ auth()->user()->id }};
            if (event.user_id == user_id) {
                if (event.type == "Approved") {
                    Swal.fire({
                        icon: "success",
                        title: "Approved",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                } else if (event.type == "Approval") {
                    Swal.fire({
                        icon: "info",
                        title: "",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Rejected",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                }
                Push.create(event.notif);
            }
        });
    </script>
    @include('sweetalert::alert')
    @stack('script')


</body>

</html>
