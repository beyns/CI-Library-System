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
							<span class="font-weight-bold">Books Borrowed</span>
						</p>

					</div>
				</header>

				<div class="card">
					<div class="card-body">
						<table class="display table table-striped table-hover " id="borrowedtable">
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
			</div>
		</div>
		<?php $this->load->view('admin/transactions/borrowed_modal') ?>

	</div>

</main>
<?php $this->load->view('template/include_footer.php') ?>