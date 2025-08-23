<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Login v2</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN core-css ================== -->
	<link href="/assets/css/vendor.min.css" rel="stylesheet" />
	<link href="/assets/css/apple/app.min.css" rel="stylesheet" />
	<script src="/assets/plugins/ionicons/dist/ionicons/ionicons.js"></script>
	<!-- ================== END core-css ================== -->
</head>
<body class='pace-top'>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->


	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN login -->
		<div class="login login-v2 fw-bold">
			<!-- BEGIN login-cover -->
			<div class="login-cover">
				<div class="login-cover-img" style="background-image: url(/assets/img/login-bg/emil_wallpaper.png)" data-id="login-cover-image"></div>
				<div class="login-cover-bg"></div>
			</div>
			<!-- END login-cover -->

			<!-- BEGIN login-container -->
			<div class="login-container">
				<!-- BEGIN login-header -->
				<div class="login-header">
					<div class="brand">
						<div class="d-flex align-items-center">
							<span class="logo"><ion-icon name="cloud"></ion-icon></span> <b>Register </b> Admin
						</div>
						{{-- <small>Bootstrap 5 Responsive Admin Template</small> --}}
					</div>
					<div class="icon">
						<i class="fa fa-lock"></i>
					</div>
				</div>
				<!-- END login-header -->

				<!-- BEGIN login-content -->
				<div class="login-content">
					<form action="/register" method="POST" class="fs-13px">
                        @csrf
						<div class="mb-3">
							<label class="mb-2">Fullname <span class="text-danger">*</span></label>
							<input type="text" class="form-control fs-13px" placeholder="Email Fullname" name="name" value="{{ old('name') }}"/>
						</div>
                        <div class="mb-3">
							<label class="mb-2">Position <span class="text-danger">*</span></label>
							<input type="text" class="form-control fs-13px" placeholder="Email position" name="position" value="instructor"/>
						</div>
                        <div class="mb-3">
							<label class="mb-2">Department <span class="text-danger">*</span></label>
							<input type="text" class="form-control fs-13px" placeholder="Email Department" name="department" value="{{ old('department') }}"/>
						</div>
						<div class="mb-3">
							<label class="mb-2">Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control fs-13px" placeholder="Email address" name="email" value="{{ old('email') }}"/>
						</div>
                        <div class="mb-4">
							<label class="mb-2">Password <span class="text-danger">*</span></label>
							<input type="password" class="form-control fs-13px" placeholder="Password" name="password"/>
						</div>
						<div class="mb-3">
							<label class="mb-2">Re-enter Password <span class="text-danger">*</span></label>
							<input type="password" class="form-control fs-13px" placeholder="Re-enter Password" name="password_confirmation"/>
						</div>


						<div class="mb-4 mt-5">
							<button type="submit" class="btn btn-theme d-block w-100 btn-lg h-45px fs-13px">Sign Up</button>
						</div>
						<div class="mb-4 pb-5">
							Already a member? Click <a href="/login">here</a> to login.
						</div>
						<hr class="bg-gray-600 opacity-2" />
						<p class="text-center text-gray-600">
							&copy; Color Admin All Right Reserved 2025
						</p>
					</form>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-container -->
		</div>
		<!-- END login -->




	</div>
	<!-- END #app -->

	<!-- ================== BEGIN core-js ================== -->
	<script src="/assets/js/vendor.min.js"></script>
	<script src="/assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->

	<!-- ================== BEGIN page-js ================== -->
	<script src="/assets/js/demo/login-v2.demo.js"></script>
	<!-- ================== END page-js ================== -->
</body>
</html>
