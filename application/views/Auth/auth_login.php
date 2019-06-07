<?php $this->load->view('template/include_head.php') ?>
<div class="container-fluid container-application">
	<!-- Sidenav -->
	<!-- Content -->
	<div class="main-content position-relative">
		<!-- Main nav -->
		<!-- Omnisearch -->
		<div id="omnisearch" class="omnisearch">
			<div class="container">
				<!-- Search form -->
				<form class="omnisearch-form">
					<div class="form-group">
						<div class="input-group input-group-merge input-group-flush">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="far fa-search"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Type and hit enter ...">
						</div>
					</div>
				</form>
				<div class="omnisearch-suggestions">
					<h6 class="heading">Search Suggestions</h6>
					<div class="row">
						<div class="col-sm-6">
							<ul class="list-unstyled mb-0">
								<li>
									<a class="list-link" href="#">
										<i class="far fa-search"></i>
										<span>macbook pro</span> in Laptops
									</a>
								</li>
								<li>
									<a class="list-link" href="#">
										<i class="far fa-search"></i>
										<span>iphone 8</span> in Smartphones
									</a>
								</li>
								<li>
									<a class="list-link" href="#">
										<i class="far fa-search"></i>
										<span>macbook pro</span> in Laptops
									</a>
								</li>
								<li>
									<a class="list-link" href="#">
										<i class="far fa-search"></i>
										<span>beats pro solo 3</span> in Headphones
									</a>
								</li>
								<li>
									<a class="list-link" href="#">
										<i class="far fa-search"></i>
										<span>smasung galaxy 10</span> in Phones
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Page content -->
		<div class="page-content">
			<div class="min-vh-100 py-5 d-flex align-items-center">
				<div class="w-100">
					<div class="row justify-content-center">
						<div class="col-sm-8 col-lg-4">
							<div class="card shadow zindex-100 mb-0">
								<div class="card-body px-md-5 py-5">
									<div class="mb-5">
										<h6 class="h3">Login</h6>
										<p class="text-muted mb-0">Sign in to your account to continue.</p>
									</div>
									<span class="clearfix"></span>
									<?php echo form_open("", array("class" => "auth-form frm-login")) ?>
									<div class="form-group">
										<label class="form-control-label">Email address</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-user"></i></span>
											</div>
											<input type="text" class="form-control" name="uname" id="input-email"
												placeholder="name@example.com">
										</div>
									</div>
									<div class="form-group mb-4">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<label class="form-control-label">Password</label>
											</div>
											<div class="mb-2">
												<a href="#!"
													class="small text-muted text-underline--dashed border-primary"
													>Lost
													password?</a>
											</div>
										</div>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-key"></i></span>
											</div>
											<input type="password" name="upass" class="form-control" id="input-password"
												placeholder="Password">
											<div class="input-group-append">
												<span class="input-group-text">
													<a href="#" data-toggle="password-text"
														data-target="#input-password">
														<i class="far fa-eye"></i>
													</a>
												</span>
											</div>
										</div>
									</div>
									<div class="mt-4"><button type="button" id="btn-login"
											class="btn btn-sm btn-primary btn-icon rounded-pill">
											<span class="btn-inner--text">Sign in</span>
											<span class="btn-inner--icon"><i
													class="far fa-long-arrow-alt-right"></i></span>
										</button></div>
									<?php echo form_close() ?>
								</div>
								<div class="card-footer px-md-5"><small>Not registered?</small>
									<a href="#" class="small font-weight-bold">Create account</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<div class="sidenav-mask mask-body d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>
	</div>
</div>
<!-- <main class="auth">
	<header id="auth-header" class="auth-header">
		<h1>
			<span class="sr-only">Sign In</span>
		</h1>
		<canvas class="particles-js-canvas-el" width="1600" height="261" style="width: 100%; height: 100%;"></canvas>
	</header>
	<?php //echo form_open("", array("class" => "auth-form frm-login")) ?>
 <div class="form-group">
		<div class="form-label-group">
			<input type="text" id="inputUser" class="form-control placeholder-shown" placeholder="Username" required=""
				autofocus="" name="uname" />
			<label for="inputUser">Username</label>
		</div>
	</div>

	<div class="form-group">
		<div class="form-label-group">
			<input type="password" id="inputPassword" class="form-control placeholder-shown" placeholder="Password"
				required="" name="upass" />
			<label for="inputPassword">Password</label>
		</div>
	</div>

	<button class="btn btn-lg btn-primary btn-block" id="btn-login" type="button">
		Sign In
	</button> -->



<div class="text-center pt-3">
	<a href="#" class="link">Username: <i>username</i></a>
	<span class="mx-2">·</span>
	<a href="#" class="link">Password: <i>password</i></a>
</div>
</main> -->
<?php $this->load->view('template/include_footer.php') ?>