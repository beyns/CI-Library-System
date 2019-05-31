<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>
<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>

<main class="app-main">
	<div class="wrapper">
		<div class="page">
		<nav class="navbar navbar-expand-lg navbar-light bg-white"
				style="padding-right: 2rem;padding-left:2rem;height: 3.5rem">
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('admin/dashboard')?>">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Books
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"
									href="<?php echo base_url("admin/book/books")?>">Book List</a>
								<a class="dropdown-item"
									href="<?php echo base_url("admin/book/category")?>">Category</a>
							</div>
						</li>
						<li class="nav-item active dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Users
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo base_url("admin/user/members")?>">Members</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/user/borrowers")?>">Borrowers</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Transactions
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo base_url('admin/transaction/borrowedbooks')?>">Borrowed Books</a>
								<a class="dropdown-item" href="<?php echo base_url('admin/transaction/returnedbooks')?>">Returnd Books</a>
							</div>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="#">Reports <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="page-inner container">
				<header class="page-title-bar">
					<div class="d-flex flex-column flex-md-row">
						<p class="lead">
							<span class="font-weight-bold">Hi, Beni.</span>
							<span class="d-block text-muted">Here’s what’s happening with your business today.</span>
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
	<footer class="app-footer">
		<ul class="list-inline">
			<li class="list-inline-item">
				<a class="text-muted" href="#">Support</a>
			</li>
			<li class="list-inline-item">
				<a class="text-muted" href="#">Help Center</a>
			</li>
			<li class="list-inline-item">
				<a class="text-muted" href="#">Privacy</a>
			</li>
			<li class="list-inline-item">
				<a class="text-muted" href="#">Terms of Service</a>
			</li>
		</ul>
		<div class="copyright">Copyright © 2018. All right reserved.</div>
	</footer>
	<!-- /.app-footer -->
</main>
<?php $this->load->view('template/include_footer.php') ?>