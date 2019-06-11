<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>
<?php $this->load->view('template/include_head.php') ?>

<main class="app-main">
	<div class="wrapper">
		<div class="page">
			<div class="page-inner container">
				<header class="page-title-bar">
					<div class="d-flex flex-column flex-md-row">
						<p class="lead">
							<span class="font-weight-bold">Member List</span>
						</p>
						<div class="ml-auto">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" id ="member_show">
								Add Member
							</button>

						
						</div>
					</div>
				</header>

				<?php $this->load->view('admin/user/view_members') ?>
				<?php $this->load->view('admin/user/modal') ?>
			</div>
		</div>
	</div>
	<!-- /.app-footer -->
</main>
<?php $this->load->view('template/include_footer.php') ?>