<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title category"> </h5>
            </div>

            <div class="modal-body">
                <blockquote>
                    <p class="mb-0 booktitle"> </p>
                    <footer class="author">

                    </footer>
                </blockquote>
                <p class="description"> </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_borrow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title category"> </h5>
            </div>

            <div class="modal-body">
                <?php echo form_open('', array('class' => 'borrowForm'))?>
                <input type="hidden" class="book_ids" name="b_id">
                <input type="hidden" class="bbook_qty" name="b_qty">
                <input type="hidden" class="br_qty" name="br_qty">
                <input type="hidden" class="stud_id" name="s_id">
                <!-- <input type="text" class="bk-title" name="title"> -->

                <blockquote>
                    <p class="mb-0 book_title"> </p>
                    <footer class="author">

                    </footer>
                </blockquote>
                <select class="js-select form-control" name="state">
                    <option selected value=""></option>
                </select>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-borrow" id="btn-borrow">Borrow Book</button>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title book_title"></h5>
            </div>

            <div class="modal-body">
                <?php echo form_open('' ,array('class' => 'rembook'))?>
                <input type="hidden" id="bbid" name="bbid" />
                <p>Are you sure you want to deletes this book?</p>
                <button type="button" class="btn btn-danger btn-rembook" id="btn-rembook"
                    data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <?php echo form_close(); ?>
            </div><!-- /.modal-body -->
            <!-- .modal-footer -->
            <div class="modal-footer">

            </div><!-- /.modal-footer -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-centered  " role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"> Modal title </h5>
            </div>

            <div class="modal-body">
                <!-- <form class="frmbook"> -->
                <?php echo form_open('',array('class' => 'editfrmbook')) ?>
                <div class="form-group 6">
                    <label for="inputPassword4">Title</label>
                    <input type="text" class="form-control" id="b_title" name="title" placeholder="" />
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ISBN</label>
                        <input type="text" class="form-control" id="b_isbn" name="isbn" id="inputEmail4" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Author</label>
                        <input type="text" class="form-control" id="b_author" name="author" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="b_description" rows="3"></textarea>
                </div>
                <input type="hidden" class="form-control" id="b_id" name="id" placeholder="" />
                <div class="form-group">
                    <label for="inputState">Categosry</label>
                    <select id="update_category" name="category" class="form-control">
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
                    <select id="update_sub_category" name="subcategory" class="form-control">

                    </select>
                </div>
                <div class="form-group 6">
                    <label for="inputPassword4">Quantity</label>
                    <input type="text" id="b_qty" class="form-control" name="qty" placeholder="" />
                    <input type="hidden" id="b_borrowed" class="form-control" name="borrowed_qty" placeholder="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary btn-update-book">
                        Save changes
                    </button>
                </div>
                </form>
            </div><!-- /.modal-body -->

        </div>
    </div>
</div>


<div class="modal fade borrow-modal" id="borrow-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <?php echo form_open('',array('class' => 'borrow_form')); ?>

            <div class="modal-header border-0">
                <h5 id="myLargeModalLabel" class="modal-title h6 mt-1">Borrow Books</h5>
                <button type="button" class="btn btn-primary btn-sm" id="borrow_save" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">Save</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <input type="text" class="bid" name="bid">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>Student Number</label>
                        <input type="text" class="form-control bsn form-control-sm" id="validationDefault01"
                            placeholder="First name" name="studnet_num" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault02">Borrower Name</label>
                        <input type="text" class="form-control bfn form-control-sm" id="validationDefault02"
                            placeholder="Last name" name="fullname" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="validationDefaultUsername">Contact</label>
                        <input type="text" class="form-control bcnt form-control-sm" id="validationDefaultUsername"
                            placeholder="Username" name="contact" aria-describedby="inputGroupPrepend2" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefaultUsername">Address</label>
                        <input type="text" class="form-control badd form-control-sm" id="validationDefaultUsername"
                            placeholder="Username" name="address" aria-describedby="inputGroupPrepend2" required>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <div class="row booksborrowed">

                </div>

            </div>

            <div class="border p-3 mb-4">
                <table class=" table table-striped table-hover " id="books">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Book Name</th>
                            <th scope="col" style="width: 30px">Description</th>
                            <th scope="col">Author(s)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>

    </div>
</div>


<div class="modal fade borrowinfo-modal" id="borrow-modal" tabindex="-1" role="dialog" data-focus-on="input:first"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">
            <?php echo form_open('',array('class' => 'borrow_form')); ?>

            <div class="modal-header border-0">
                <h5 id="myLargeModalLabel" class="modal-title h6 mt-1">Borrowed Books</h5>
                <div>
                    <button type="button" class="btn btn-primary btn-sm" id="borrow_save" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">Save</span>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" id="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">Close</span>
                    </button>
                </div>
            </div>
            <div class="modal-body table-responsive">
                <input type="hidden" class="bid" name="bid">

                <?php echo form_close(); ?>

                <div class="row justify-content-center">
                    <table class="display table table-striped table-hover " id="borrowedbookstable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date Borrowed</th>
                                <th scope="col">Due Date</th>
                                <th scope="col"> Status</th>
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

<div class="modal fade" id="modal-change-status" tabindex="-1" role="dialog" data-focus-on="input:first"
    aria-labelledby="modal-change-username" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex align-items-center" id="modal-title-change-username">
                        <div>
                            <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="custom-select">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>


                            </div>
                        </div>
                    </div>
                    <div class="px-5 pt-4 mt-4 delimiter-top text-center">
                        <p class="text-muted text-sm">You will receive an email where you will be asked to confirm this
                            action in order to be completed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Change my
                        username</button>
                </div>
            </div>
        </form>
    </div>
</div>