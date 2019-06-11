<?php $this->load->view('template/include_head.php') ?>
<?php $this->load->view('admin/header.php') ?>
<?php $this->load->view('template/include_head.php') ?>

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <?php echo form_open('',array('class' => 'stud_frm'));?>
            <div class="form-group">
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="stud_id" name="stud_id"
                        placeholder="Type Student Id...">
                </div>
                <input type="hidden" class="s_id" name="sid">
            </div>
            <button type="button" class="btn btn-sm btn-success" id="search" data-toggle="modal">Borrow
                Book</button>
            <?php echo form_close(); ?>
        </div>

    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-*">
            <div class="card">
                <div class="card-body">
                    <table class="display table table-striped table-hover text-center " id="borrowedtable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Borrower Name</th>
                                <th scope="col">Total of Books Borrowed</th>
                                <th scope="col">Date Borrowed</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Penalty</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/book/modal') ?>

<?php $this->load->view('template/include_footer.php') ?>