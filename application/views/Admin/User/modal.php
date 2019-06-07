<!-- Modal -->
<div class="modal fade" id="modal_borrow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title category"> </h5>
            </div>

            <div class="modal-body">
            <?php echo form_open('', array('class' => 'borrow_form'))?>
            <label for="">Book Id</label>
                <input type="text" class="bk-id" name="book_id">
                <input type="text" class="form-control" id="bk-qty" name="qty">

                <!-- <input type="text" class="bk-title" name="title"> -->
                <blockquote>
                    <p class="mb-0 booktitle"> </p>
                    <footer class="author">

                    </footer>
                </blockquote>
                <p class="description"> </p>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn-borrow" >Borrow Book</button>
            </div>
        </form>
            </div>
           
        </div>
    </div>
</div>


<div class="modal fade" id="member_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 381px;" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Members
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="err_message"></div>
                <?php echo form_open('', array("class" => 'mmform')) ?>

                <div class="form-row">
                    <div class="form-group  col-md-6 ">
                        <label for="inputEmail4">Firstname</label>
                        <input type="text" class="form-control" id="fname" name="fname">

                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="inputPassword4">Lastname</label>
                        <input type="text" class="form-control" id="lname" name="lname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname">
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="cpass" name="cpass">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role</label>
                    <select class="form-control" name="role" id="exampleFormControlSelect1">
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" id="btn-member" type="button">
                        Add Member
                    </button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

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



<div class="modal fade" id="modal_mdel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title mm"></h5>
            </div>

            <div class="modal-body">
                <?php echo form_open('' ,array('class' => 'removeMem'))?>
                <input type="hidden" id="mid" name="id" />
                <p>Are you sure you want to remove this user?</p>
                <button type="button" class="btn btn-danger" id="btn-remove-mem" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
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
    <div class="modal-dialog modal-dialog-centered " role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"> Modal stitle </h5>
            </div>

            <div class="modal-body">
                <!-- <form class="frmbook"> -->
                <?php echo form_open('',array('class' => 'editMmbrForm')) ?>
                <input type="hidden" class="form-control id" name="id">

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Firstname</label>
                    <div class="col-sm-6">
                        <input type="text" disabled class="form-control fname" name="fname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lastname</label>
                    <div class="col-sm-6">
                        <input type="text" disabled class="form-control lname" name="lname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" disabled class="form-control uname"  name="uname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" disabled class="form-control email" name="email">
                    </div>
                </div>
               <div class="cpassword">
               <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" disabled class="form-control pass" name="pass">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password:</label>
                    <div class="col-sm-6">
                        <input type="password" disabled class="form-control cpass" name="cpass">
                    </div>
                </div>
               </div>
                <div class="form-group chkc">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="changepass" value="" id="ckb7"> <label class="custom-control-label" for="ckb7">Change Password</label>
                          </div>
                        </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Role:</label>
                    <div class="col-sm-6">
                        <select class="form-control role" disabled name="role">
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-group  col-md-6 ">
                        <label for="inputEmail4">Firstname</label>
                        <input type="text" class="form-control fname" disabled name="fname">
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="inputPassword4">Lastname</label>
                        <input type="text" class="form-control lname" disabled name="lname">
                    </div>
                </div> -->
                <!-- <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="">Username</label>
                        <input type="text" class="form-control uname" disabled name="uname">
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="">Email</label>
                        <input type="text" class="form-control email" disabled name="email">
                    </div>
                </div> -->
                <!-- <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control pass" disabled name="pass">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control cpass" disabled name="cpass">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role</label>
                  
                </div> -->
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block edit-btn" id="btn-edit" type="button">
                        Edit Member Info
                    </button>
                    <button class="btn btn-lg btn-primary btn-block update-btn" id="btn-update" type="button">
                        Update Member Info
                    </button>
                    <button class="btn cancel-btn btn-lg btn-secondary btn-block" id="btn-cancel" type="button">
                        Cancel
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-body -->

    </div>
</div>
</div>