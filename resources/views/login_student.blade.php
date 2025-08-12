<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Student Portal</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN core-css ================== -->
	<link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/apple/app.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/plugins/ionicons/dist/ionicons/ionicons.js') }}"></script>
	<!-- ================== END core-css ================== -->

	<style>
		.coming-soon .coming-soon-header {
			background: url({{ asset('assets/img/login-bg/emil_wallpaper.png') }}) 0% 0% / cover no-repeat !important;
		}
		#loadingOverlay {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.5);
			color: white;
			z-index: 9999;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
		.spinner-border {
			width: 3rem;
			height: 3rem;
		}
	</style>
</head>

<body class="pace-top">

	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>

	<div id="loadingOverlay">
	<div class="spinner-border text-light" role="status">
		<span class="visually-hidden">Loading...</span>
	</div>
	<p id="loadingText" class="mt-3">Please wait...</p>
</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN coming-soon -->
		<div class="coming-soon">

			<!-- BEGIN coming-soon-header -->
			<div class="coming-soon-header">
				<div class="bg-cover"></div>
				<div class="brand">
					<span class="logo">
						<img src="{{ asset('assets/img/ccs_logo.png') }}" alt="Logo" style="height: 150px;" />
					</span>
					<b>Student</b> Login
				</div>

			</div>
			<!-- END coming-soon-header -->

			<!-- BEGIN coming-soon-content -->
			<div class="coming-soon-content">

				<form class="lockscreen-credentials">
					<div class="input-group input-group-lg mx-auto mb-2">
						<span class="input-group-text border-0 bg-light">
							<i class="fa fa-user"></i>
						</span>
						<input type="text" class="form-control fs-13px border-0 shadow-none ps-0 bg-light"
							placeholder="ID-Number" />
						<button type="button" class="btn fs-13px btn-dark">
							<i class="fas fa-arrow-alt-circle-right fa-flip-vertical fa-2x"></i>
						</button>
					</div>
				</form>

				<p class="text-gray-500 mb-5">Format: 12-000001</p>
				<p>
					<span class="me-2">Follow us on</span>
					<a href="javascript:;" class="mx-1 text-decoration-none text-dark">
						<i class="fab fa-twitter fa-lg fa-fw text-info"></i> Twitter
					</a>
					<a href="javascript:;" class="mx-1 text-decoration-none text-dark">
						<i class="fab fa-facebook-square fa-lg fa-fw text-blue"></i> Facebook
					</a>
				</p>
			</div>
			<!-- END coming-soon-content -->

		</div>
		<!-- END coming-soon -->
	</div>
	<!-- END #app -->

	<!-- ================== BEGIN core-js ================== -->
	<script src="{{ asset('assets/js/vendor.min.js')}}"></script>
	<script src="{{ asset('assets/js/app.min.js')}}"></script>
	<!-- ================== END core-js ================== -->

	<script>
		$(document).ready(function () {

			// Format input as: 12-000001
			$('.lockscreen-credentials input').on('input', function () {
				let val = $(this).val();

				// Remove non-digits
				val = val.replace(/\D/g, '');

				// Limit to max of 8 digits (2 + 6)
				if (val.length > 8) {
					val = val.substring(0, 8);
				}

				// Add dash after 2 digits
				if (val.length > 2) {
					val = val.substring(0, 2) + '-' + val.substring(2);
				}

				$(this).val(val);
			});

			// Prevent pasting non-numeric characters
			$('.lockscreen-credentials input').on('paste', function (e) {
				let pasted = (e.originalEvent || e).clipboardData.getData('text');
				if (!/^\d+$/.test(pasted.replace(/-/g, ''))) {
					e.preventDefault();
				}
			});

			// IP and Geo Logic
			async function getMyIp() {
				try {
					const response = await fetch('https://api.ipify.org?format=json');
					const data = await response.json();
					return data.ip;
				} catch (error) {
					console.error('Error getting IP:', error);
					return '0.0.0.0';
				}
			}

			// function getLatLong() {
			// 	return new Promise((resolve) => {
			// 		if (navigator.geolocation) {
			// 			navigator.geolocation.getCurrentPosition(
			// 				(position) => {
			// 					const lat = position.coords.latitude.toFixed(8);
			// 					const long = position.coords.longitude.toFixed(8);
			// 					resolve(`${lat}, ${long}`);
			// 				},
			// 				(error) => {
			// 					console.warn('Geolocation error:', error);
			// 					resolve(null);
			// 				},
			// 				{
			// 					enableHighAccuracy: true,
			// 					timeout: 10000,
			// 					maximumAge: 0
			// 				}
			// 			);
			// 		} else {
			// 			console.warn('Geolocation not supported');
			// 			resolve(null);
			// 		}
			// 	});
			// }

			$('.lockscreen-credentials button').click(async function (e) {
				e.preventDefault();

				$('#loadingOverlay').show();

				const idNumber = $('.lockscreen-credentials input').val();
				const publicIp = await getMyIp();
				const latLong = "10.081072253977672, 124.34310083957727";

				// Show overlay with spinner
			$('#loadingText').text('Please wait...');
			$('#loadingOverlay').css('display', 'flex');


				
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
					success: function (response) {
					if (response.status == "success") {
						$('#loadingText').text('Login successful!');
						setTimeout(() => {
							location.href = "/student_updates";
						}, 1000);
					} else {
						$('#loadingText').text('Error saving profile log.');
						setTimeout(() => {
							$('#loadingOverlay').hide();
						}, 1500);
					}
				},
				error: function () {
					$('#loadingText').text('Error saving profile log.');
					setTimeout(() => {
						$('#loadingOverlay').hide();
					}, 1500);
				}
				});
			});
		});
	</script>

</body>

</html>