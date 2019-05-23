<?php $this->load->view('template/include_head.php') ?>

<main class="auth">
<?php echo validation_errors(); ?>

	<header
		id="auth-header"
		class="auth-header"
		style="background-image: url(assets/images/illustration/img-1.png);"
	>
		<h1>
			SIGN UP
			<span class="sr-only">Sign Up</span>
		</h1>
		<p>
			Already have an account? please <a href="<?php echo base_url('/auth/login') ?>">Sign In</a>
		</p>
		<canvas
			class="particles-js-canvas-el"
			style="width: 100%; height: 100%;"
			width="1600"
			height="261"
		></canvas>
	</header>
	<!-- form -->
	<div class="page-message" role="alert">
    </div>
	<form class="auth-form">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="">Student No.</label>
				<input type="text" class="form-control" id="studnum" name="studnum" />
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail4">Firstname</label>
				<input type="text" class="form-control" id="fname" name="fname" />
			</div>
			<div class="form-group col-md-6">
				<label for="inputPassword4">Lastname</label>
				<input type="text" class="form-control" id="lname" name="lname" />
			</div>
		</div>
		<div class="form-group"></div>
		<div class="form-group">
			<label for="">Username</label>
			<input type="text" class="form-control" id="uname" name="uname" />
		</div>
		<div class="form-group">
			<label for="">Email</label>
			<input type="text" class="form-control" id="email" name="email" />
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" class="form-control" id="pass" name="pass" />
		</div>
		<div class="form-group">
			<label for="">Confirm Password</label>
			<input type="password" class="form-control" id="cpass" name="cpass" />
		</div>
		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" id="btn-create" type="button">
				Sign Up
			</button>
		</div>

		<p class="text-center text-muted mb-0">
			By creating an account you agree to the <a href="#">Terms of Use</a> and
			<a href="">Privacy Policy</a>.
		</p>
		<!-- /recovery links -->
	</form>
</main>
<?php $this->load->view('template/include_footer.php') ?>
