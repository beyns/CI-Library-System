<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>
<?php $this->load->view('template/include_head.php') ?>


<main class="page-content">
	<div class="wrapper">
		<div class="page">
			<!-- <nav class="navbar navbar-expand-lg navbar-light bg-white"
				style="padding-right: 2rem;padding-left:2rem;height: 3.5rem">
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item ">
							<a class="nav-link active" href="<?php echo base_url('admin/dashboard')?>">Home <span
									class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item  dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Books
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo base_url("admin/book/books")?>">Book List</a>
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
								<a class="dropdown-item"
									href="<?php echo base_url("admin/user/borrowers")?>">Borrowers</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Transactions
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"
									href="<?php echo base_url('admin/transaction/borrowedbooks')?>">Borrowed Books</a>
								<a class="dropdown-item"
									href="<?php echo base_url('admin/transaction/returnedbooks')?>">Returnd Books</a>
							</div>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="#">Reports <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
			</nav> -->
			<div class="page-inner container">

				<div class="container">
					<div class="page-inner">
						<?php  if($this->session->userdata('username') != '')  
							{  
								echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
							}  
						?>
						<header class="page-title-bar">
							<div class="d-flex flex-column flex-md-row">
								<p class="lead">
									<span class="d-block text-muted">Here’s
										what’s happening with your business today.</span>
								</p>

								<div class="ml-auto">
									<?php echo form_open('',array("class" =>'datefrm')) ?>
									<input type="hidden" class="date_borrowed" name="d_borrowed">
									<input type="text" name="date_borrowed" id="date_borrowed"
										class="form-control datepicker has-feedback-left" placeholder="Date To"
										aria-describedby="inputSuccess2Status4" required="">
									</form>
								</div>
							</div>
						</header><!-- /.page-title-bar -->
						<!-- .page-section -->
						<div class="page-section">
							<!-- .section-block -->

							<div class="card">
								<div class="card-body">

									<h5 class="mb-3">
										List of Borrowed Books
									</h5>
									<table class="display table table-striped table-hover " id="borrowedBookTable">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Barcode</th>
												<th scope="col">Title</th>
												<th scope="col">Name</th>
												<th scope="col">Date Borrowed</th>

											</tr>
										</thead>

									</table>
								</div>
							</div>

							<div class="card">
								<div class="card-body">

									<h5 class="mb-3">
										Unreturned Books
									</h5>
									<table class="display table table-striped table-hover " id="unreturnedBookTable">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Title</th>
												<th scope="col">Name</th>
												<th scope="col">Address</th>
												<th scope="col">Contact</th>
												<th scope="col">Date Borrowed</th>

											</tr>
										</thead>

									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
</main>
<?php $this->load->view('template/include_footer.php') ?>