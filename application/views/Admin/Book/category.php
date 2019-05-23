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
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item active dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Books
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"
									href="<?php echo base_url("/index.php/admin/book/books")?>">Book List</a>
								<a class="dropdown-item" href="#">Category</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Users
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Members</a>
								<a class="dropdown-item" href="#">Borrowers</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Transactions
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Borrowed Books</a>
								<a class="dropdown-item" href="#">Returnd Books</a>
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
							<span class="font-weight-bold">Book Category</span>
						</p>
						<div class="ml-auto">
							<!-- Button trigger modal -->
							<button type="button" id="btn_show_category" class="btn btn-primary" data-toggle="modal">

								Add Book Category
							</button>

							<!-- Modal -->

						</div>
					</div>
				</header>

				<table class="display table table-striped table-hover" id="categoryTable">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Category</th>
							<th scope="col">Action</th>
						</tr>
					</thead>

				</table>
			</div>
		</div>
		<div class="modal fade modal_category" id="exampleModal" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Category
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="frm-category">
							<div class="form-group ">
								<label for="inputPassword4">Category</label>
								<input type="text" class="form-control" id="category" , name="category"
									placeholder="" />
							</div>
							<!-- <div class="hey">
													<div class="form-group ">
														<label for="inputPassword4">Sub-category</label>
														<input type="text" class="form-control" id="category" ,
															name="sub_category" placeholder="" />
													</div>
												</div>
												<div class="form-group">
													<div class="custom-control custom-control-inline custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="ckb1"
															value="checked" />
														<label class="custom-control-label" for="ckb1">Add
															Sub-category</label>
													</div>
												</div> -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">
									Close
								</button>
								<button type="button" id="btn-category" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<div class="modal fade modal_subCat" id="exampleModal" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Sub-Category
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<form class="frm_sub_category">
							<input type="hidden" name="id" id="id" />
							<div class="form-group-input">
								<div class="form-group ">
									<input type="text" class="form-control" id="sub_category" name="sub_category[]"
										placeholder="" />
								</div>
							</div>

							<button class="btn btn-primary btn-xs" id="btn-fields" type="button"><i
									class="fas fa-plus"></i> </button>
							<!-- <div class="hey">
								
							</div>
							<div class="form-group">
								<div class="custom-control custom-control-inline custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="ckb1" value="checked" />
									<label class="custom-control-label" for="ckb1">Add
										Sub-category</label>
								</div>
							</div> -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">
									Close
								</button>
								<button type="button" id="btn-sub_category" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</form>
					</div>

				</div>
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