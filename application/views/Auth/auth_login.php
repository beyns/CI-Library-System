<?php $this->load->view('template/include_head.php') ?>
<main class="auth">
	<header
		id="auth-header"
		class="auth-header"
		style="background-image: url(assets/images/illustration/img-1.png);"
	>
		<h1>
			<img src="assets/images/brand-inverse.png" alt="" height="72" />
			<span class="sr-only">Sign In</span>
		</h1>
		<p>Don't have a account? <a href="<?php echo base_url('/index.php/register') ?>">Create One</a></p>
		<canvas
			class="particles-js-canvas-el"
			width="1600"
			height="261"
			style="width: 100%; height: 100%;"
		></canvas>
	</header>
	<!-- form -->
	<form class="auth-form frm-login">
		<div class="form-group">
			<div class="form-label-group">
				<input
					type="text"
					id="inputUser"
					class="form-control placeholder-shown"
					placeholder="Username"
					required=""
					autofocus=""
					name="uname"
				/>
				<label for="inputUser">Usernasme</label>
			</div>
		</div>

		<div class="form-group">
			<div class="form-label-group">
				<input
					type="password"
					id="inputPassword"
					class="form-control placeholder-shown"
					placeholder="Password"
					required=""
					name="upass"
				/>
				<label for="inputPassword">Password</label>
			</div>
		</div>

		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" id="btn-login" type="button">
				Sign In
			</button>
		</div>

		<div class="form-group text-center">
			<div class="custom-control custom-control-inline custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="remember-me" />
				<label class="custom-control-label" for="remember-me"
					>Keep me sign in</label
				>
			</div>
		</div>

		<div class="text-center pt-3">
			<a href="auth-recovery-username.html" class="link">Forgot Username?</a>
			<span class="mx-2">·</span>
			<a href="auth-recovery-password.html" class="link">Forgot Password?</a>
		</div>
	</form>
</main>
<?php $this->load->view('template/include_footer.php') ?>
