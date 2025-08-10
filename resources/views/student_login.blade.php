<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Lockscreen</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Lockscreen" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('assets/adminlte/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/css/adminlte.css') }}" />
    <style>
        #loadingOverlay {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 1.5rem;
            text-align: center;
            padding-top: 20%;
            font-family: Arial, sans-serif;
        }
    </style>
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="lockscreen bg-body-secondary"
    style="background-image: url({{ asset('assets/img/login-bg/emil_wallpaper.png') }}) !important; ">
    <div id="loadingOverlay">please wait...</div>
    <div class="lockscreen-wrapper">

        <div class="lockscreen-name text-white">Input ID-Number</div>
        <div class="lockscreen-item">
            <div class="lockscreen-image">
                <img src="/assets/img/user/user-12.jpg" alt="User Image" />
            </div>
            <form class="lockscreen-credentials">
                <div class="input-group">
                    <input type="password" class="form-control shadow-none" placeholder="00-000000" />
                    <div class="input-group-text border-0 bg-transparent px-1">
                        <button type="button" class="btn shadow-none">
                            <i class="bi bi-box-arrow-right text-body-secondary"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmr2wlEovvkb90lAbMBzD89XUCOPM7kGw">
    </script>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('assets/adminlte/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to get public IP asynchronously
            async function getMyIp() {
                try {
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
                    // console.log('Public IP:', data.ip);
                    return data.ip;
                } catch (error) {
                    console.error('Error getting IP:', error);
                    return '0.0.0.0'; // fallback IP
                }
            }

            // Function to get lat,long as "lat, long" string, returns Promise<string>
            function getLatLong() {
                return new Promise((resolve) => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                // lat,long from browser geolocation
                                const lat = position.coords.latitude.toFixed(8);
                                const long = position.coords.longitude.toFixed(8);

                                // Optional: Initialize Google Maps LatLng object (if needed)
                                const latLng = new google.maps.LatLng(lat, long);

                                // console.log('Google Maps LatLng:', latLng.toString());

                                // Return as "lat, long" string
                                resolve(`${lat}, ${long}`);
                            },
                            (error) => {
                                console.warn('Geolocation error:', error);
                                resolve(null);
                            }, {
                                enableHighAccuracy: true,
                                timeout: 10000,
                                maximumAge: 0,
                            }
                        );
                    } else {
                        console.warn('Geolocation not supported');
                        resolve(null);
                    }
                });
            }
            $('.lockscreen-credentials button').click(async function(e) {
                e.preventDefault();

                // Show loading overlay
                $('#loadingOverlay').show();

                var idNumber = $('.lockscreen-credentials input').val();

                // Get the public IP
                var publicIp = await getMyIp();

                // Get the lat,long string (or null)
                var latLong = await getLatLong();

                // Send data to backend
                $.ajax({
                    url: '/profile-log',
                    type: 'POST',
                    data: {
                        id_number: idNumber,
                        client_ip: publicIp,
                        lat_long: latLong
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#loadingOverlay').hide();
                        alert('Profile log saved successfully!');
                        // Hide loading overlay

                        // Clear input or update UI here if needed
                    },
                    error: function(xhr) {
                        $('#loadingOverlay').hide();
                        alert('Error saving profile log.');
                        // Hide loading overlay

                    }
                });
            });

        });
    </script>


    <!--end::OverlayScrollbars Configure-->
</body>
<!--end::Body-->

</html>