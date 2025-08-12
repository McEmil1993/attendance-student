<!-- ITO NA ANG PINAG-ISANG FILE -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Page without Sidebar</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/apple/app.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/plugins/ionicons/dist/ionicons/ionicons.js') }}"></script>
</head>
<body>
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>

	<div id="app" class="app app-header-fixed" style="margin: 0px !important; padding: 0px !important;">

		<div id="content" class="app-content p-0">
			<div class="profile">
				<div class="profile-header">
					<div class="profile-header-cover"></div>
					<div class="profile-header-content">
						<div class="profile-header-img">
							<img id="previewProfileImage" src="{{ $student->student_profile_path ? asset($student->student_profile_path) : asset('assets/img/tmc.png') }}" alt="Profile" />
						</div>
						<div class="profile-header-info">
							<h4 class="mt-0 mb-1">{{ $student->firstname ?? 'Student Name' }}</h4>
							<p class="mb-2">{{ $student->course .' - '.$student->year .' | Block '.$student->block}}</p>
							<a href="#" class="btn btn-xs btn-yellow" id="editProfileBtn">Edit Profile</a>
						</div>
						<form action="{{ route('student.logout') }}" method="POST">
							@csrf

							<button class="btn btn-default btn-xs me-1 mb-1" style="margin-left: 40px;" type="submit"><i class="fas fa-lg fa-fw me-10px fa-arrow-right"></i>Logout</button>
						</form>
					</div>
					<ul class="profile-header-tab nav nav-tabs" style="display: none;">
						<li class="nav-item"><a href="#profile-about" class="nav-link active" data-bs-toggle="tab">ABOUT</a></li>
					</ul>
				</div>
			</div>

			<div class="profile-content" style="margin: 0px !important; padding: 0px !important;">
				<div class="tab-content p-0">
					<div class="tab-pane fade show active" id="profile-about">
						
						<form id="updateProfileForm" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="student_id" value="{{ $student->id }}">
							<input type="file" id="profileImageInput" name="image" accept="image/*" style="display:none;" />

							<div class="table-responsive form-inline">
								<table class="table table-profile align-middle">
									<tbody>
										<tr class="divider"><td colspan="2"></td></tr>
										<tr>
											<td class="field">First name</td>
											<td><input name="firstname" class="form-control form-control-sm" type="text" value="{{ $student->firstname }}" placeholder="First name"></td>
										</tr>
										<tr>
											<td class="field">Middle Initial</td>
											<td><input name="middle_initial" class="form-control form-control-sm" type="text" value="{{ $student->middle_initial }}" placeholder="Middle Initial"></td>
										</tr>
										<tr>
											<td class="field">Last name</td>
											<td><input name="lastname" class="form-control form-control-sm" type="text" value="{{ $student->lastname }}" placeholder="Last name"></td>
										</tr>
										<tr>
											<td class="field">Gender</td>
											<td>
												<select name="gender" class="form-control form-control-sm">
													<option value="">-- Select Gender --</option>
													<option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
													<option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
												</select>
											</td>
										</tr>
										<tr>
											<td class="field">Address</td>
											<td><input name="address" class="form-control form-control-sm" type="text" value="{{ $student->address }}" placeholder="Address"></td>
										</tr>
										<tr class="divider"><td colspan="2"></td></tr>
										<tr class="highlight">
											<td class="field">&nbsp;</td>
											<td><button type="submit" class="btn btn-primary bg-gradient-purple-indigo w-150px">Update</button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- core-js -->
	<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
	<script src="{{ asset('assets/js/app.min.js') }}"></script>

	<!-- page-js -->
	<script src="{{ asset('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
	<script src="{{ asset('assets/js/demo/render.highlight.js') }}"></script>

	<!-- ✅ Custom jQuery -->
	<script>
	$(document).ready(function() {
		$('#editProfileBtn').click(function(e) {
			e.preventDefault();
			$('#profileImageInput').click();
		});

		$('#profileImageInput').on('change', function(event) {
			const [file] = event.target.files;
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					$('#previewProfileImage').attr('src', e.target.result);
				};
				reader.readAsDataURL(file);
			}
		});

		$('#updateProfileForm').submit(function(e) {
			e.preventDefault();
			let formData = new FormData(this);

			$.ajax({
				url: '/students-ups',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
				success: function(response) {
					// alert('Profile updated successfully!');
					location.reload();
				},
				error: function(xhr) {
					alert('Failed to update profile.');
				}
			});
		});
	});
	</script>
</body>
</html>
