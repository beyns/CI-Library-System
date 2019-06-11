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
						<li class="nav-item active dropdown">
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
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Users
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo base_url("admin/user/members")?>">Members</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/user/borrowers")?>">Borrowers</a>
							</div>
						</li>
						<li class="nav-item active dropdown">
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
							<span class="font-weight-bold">Transaction Logs</span>
						</p>
					
					</div>
				</header>
			
				<table class="display table table-striped table-hover " id="returnedBookTable">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Title</th>
							<th scope="col">Address</th>
							<th scope="col">Contact</th>
							<th scope="col">Status</th>
							<th scope="col">Date Returned</th>
							<th scope="col">Penalty</th>

						</tr>
					</thead>

				</table>
			</div>
		</div>
		<?php $this->load->view('admin/transactions/borrowed_modal') ?>

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