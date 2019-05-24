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
								<a class="dropdown-item"
									href="<?php echo base_url("/index.php/admin/book/category")?>">Category</a>
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
							<span class="font-weight-bold">Books List</span>
						</p>
						<div class="ml-auto">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" id="show-bookModal" data-toggle="modal"
								data-target="#exampleModal">
								Add Book
							</button>

							<!-- BOOK MODAL  -->
							<div class="modal fade modal_book" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-md" role="document">
									<div class="modal-content ">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												Modal title
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<!-- <form class="frmbook"> -->
											<?php echo form_open('',array('class' => 'frmbook')) ?>
											<div class="form-group 6">
												<label for="inputPassword4">Title</label>
												<input type="text" class="form-control" name="title" id="inputPassword4"
													placeholder="" />
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="inputEmail4">ISBN</label>
													<input type="text" class="form-control" name="isbn"
														id="inputEmail4" />
												</div>
												<div class="form-group col-md-6">
													<label for="inputPassword4">Author</label>
													<input type="text" class="form-control" name="author"
														id="inputPassword4" placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="exampleFormControlTextarea1">Description</label>
												<textarea class="form-control" name="description"
													id="exampleFormControlTextarea1" rows="3"></textarea>
											</div>
											<input type="hidden" class="form-control" id="id" name="id"
												placeholder="" />
											<div class="form-group">
												<label for="inputState">Category</label>
												<select id="select_category" name="category" class="form-control">
													<option selected>Choose...</option>
													<?php
																foreach($categories as $category):
															?>
													<option data-id="<?php echo $category['id'] ?>">
														<?php echo $category['category'] ?></option>
													<?php
																endforeach
															?>
												</select>
											</div>
											<div class="form-group subcategory">
												<label for="inputState">Sub Category</label>
												<select id="sub_category" name="subcategory" class="form-control">

												</select>
											</div>
											<div class="form-group 6">
												<label for="inputPassword4">Quantity</label>
												<input type="text" class="form-control" name="qty" placeholder="" />
											</div>
											<!-- <div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputCity">City</label>
														<input
															type="text"
															class="form-control"
															id="inputCity"
														/>
													</div>
													<div class="form-group col-md-4">
														<label for="inputState">State</label>
														<select id="inputState" class="form-control">
															<option selected>Choose...</option>
															<option>...</option>
														</select>
													</div>
													<div class="form-group col-md-2">
														<label for="inputZip">Zip</label>
														<input
															type="text"
															class="form-control"
															id="inputZip"
														/>
													</div>
												</div> -->
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">
													Close
												</button>
												<button type="button" class="btn btn-primary btn-add-book">
													Save changes
												</button>
											</div>
											</form>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</header>
				<table class="display table table-striped table-hover " id="bookTable">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">ISBN</th>
							<th scope="col">Book Name</th>
							<th scope="col">Description</th>
							<th scope="col">Author(s)</th>
							<th scope="col">Category</th>
							<th scope="col">Subcategory</th>
							<th scope="col">Qty</th>
							<th scope="col">Borrowed Qty</th>
							<th scope="col"></th>
						</tr>
					</thead>

				</table>
			</div>
		</div>
		<?php $this->load->view('admin/book/modal') ?>

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