
<div class="modal fade" id="modal_dels" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <?php echo form_open('' ,array('class' => 'removebook'))?>
                    <input type="hidden" id="book_id" name="id" />
                    <p>Are you sure you want to delete this book?</p>
                <button type="button" class="btn btn-danger" id="btn-remove-book" data-dismiss="modal">Remove</button>
				</form>
            </div><!-- /.modal-body -->
            <!-- .modal-footer -->
            <div class="modal-footer">
               
            </div><!-- /.modal-footer -->
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
                <?php echo form_open('' ,array('class' => 'removebook'))?>
                <input type="TEXT" id="book_id" name="id" />
                <p>Are you sure you want to deleteS this book?</p>
                <button type="button" class="btn btn-danger" id="btn-remove-book" data-dismiss="modal">Remove</button> 
                 <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                </form>
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


