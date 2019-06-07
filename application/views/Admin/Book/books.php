<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>
<?php $this->load->view('template/include_head.php') ?>

<div class="container-fluid">

</div>

<main class="">
	<div class="container container-application">
		<div class="main-content position-relative">

			<div class="r">
				<header class="page-title-bar">
					<div class="d-flex flex-column flex-md-row">
						<p class="lead">
							<span class="font-weight-bold">Books List</span>

						</p>
						<div class="ml-auto">
							<!-- Button trigger modal -->
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
								data-target="#modal-change-username">Add Book</button>

							<!-- Modal -->
							<div class="modal fade" id="modal-change-username" tabindex="-1" role="dialog"
								aria-labelledby="modal-change-username" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<?php echo form_open('',array('class' => 'frmbook')) ?>
									<div class="modal-content">
										<div class="modal-header">
											<div class="modal-title d-flex align-items-center"
												id="modal-title-change-username">
												<div>
													<div
														class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
														<i class="far fa-user"></i>
													</div>
												</div>
												<div>
													<h6 class="mb-0">Change username</h6>
												</div>
											</div>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="px-5 pt-4 mt-4 delimiter-top text-center">
												<p class="text-muted text-sm">You will receive an email where you
													will be asked to confirm this action in order to be completed.
												</p>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<label class="form-control-label">Title</label>
													<input type="text" class="form-control form-control-sm"
														name="title">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-control-label">Author</label>
														<input class="form-control form-control-sm" name="author"
															type="text">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-control-label">ISBN</label>
														<input class="form-control form-control-sm" name="isbn"
															type="text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-control-label">Quantity</label>
														<input class="form-control form-control-sm" name="qty"
															type="text">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-control-label">Category</label>

														<select class="custom-select custom-select-sm "
															id="select_category" name="category">
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
												</div>
												<div class="col-sm-6">
													<div class="form-group subcategory ">
														<div class="">
															<label class="form-control-label">Subcategory</label>
															<select class="custom-select custom-select-sm"
																id="sub_category" name="subcategory">

															</select>
														</div>
													</div>
													<a href="<?php echo base_url("admin/book/category")?>"
														class="mt-2 cat">Add Category</a>
												</div>
											</div>

											<label class="form-control-label">Description</label>
											<textarea class="form-control" name="description"
												id="exampleFormControlTextarea1" rows="3"></textarea>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-add-book btn-sm btn-secondary"
												data-dismiss="modal">Add Book</button>
										</div>
									</div>
									</form>
								</div>
							</div>



						</div>
					</div>
				</header>
				<div class="container">
					<div class="row">
						<table class="display table table-striped table-hover " id="bookTable">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">ISBN</th>
									<th scope="col">Book Name</th>
									<th scope="col" style="width: 30px">Description</th>
									<th scope="col">Author(s)</th>
									<th scope="col">Category</th>
									<th scope="col">Subcategory</th>
									<th scope="col">Available</th>
									<th scope="col">Borrowed Qty</th>
									<th scope="col"></th>
								</tr>
							</thead>

						</table>
					</div>
				</div>

				<div class="modal fade modal-danger modal-error" tabindex="-1" role="dialog"
					aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title h6 " id="mySmallModalLabel">Small modal</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p class=" err"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/book/modal') ?>

	</div>

</main>
<?php $this->load->view('template/include_footer.php') ?>