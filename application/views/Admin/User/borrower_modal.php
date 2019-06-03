<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 381px;" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Borrowers
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('',array("class" =>'br_form'))?>
                <input type="hidden" name="id" class="br_id">

                <div class="card-header card-header-fluid mb-3">
                    <a href="#" class="btn-account" role="button">

                        <div class="account-summary">
                            <p class="borrower-name"> Vincent Ferrer </p>
                            <p class="account-description"> 20151994 </p>
                        </div>
                    </a> <!-- .dropdown -->

                </div>

                <ul class="timeline timeline-fluid">
                    <p class="font-weight-bold">Books Borrowed</p>
                    <li class="timeline-item">
                        <div class="timeline-figure">
                            <span class="tile tile-circle tile-sm"><i class="far fa-calendar-alt fa-lg"></i></span>
                        </div>
                        <div class="timeline-body">
                            <div class="media">
                                <div class="media-body">

                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="modal-footer">
                    <button class="btn btn-secondary " id="btn-cancel" type="button">
                        Close
                    </button> <button type="button" class="btn btn-primary" id="btn-br-info" data-dismiss="modal">
                        Update Borrower Info
                    </button>
                </div>
            </div>
</form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_borrower_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
        <!-- .modal-content -->
        <div class="modal-content">
            <!-- .modal-header -->
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title "></h5>
            </div>

            <div class="modal-body">
            <?php echo form_open('',array("class" =>'student_form'))?>
                
                <input type="text" class="br_id" name="id">
            
                <div class="form-group ">
                        <label for="inputEmail4">Student Number</label>
                        <input type="text" name="student_num" class="form-control student_num  ">

                    </div>
                    <div class="form-group ">
                        <label for="inputEmail4">Fullname</label>
                        <input type="text" name="fullname" class="form-control fullname ">

                    </div>
                    <div class="form-group ">
                        <label for="inputEmail4">Address</label>
                        <input type="text" name="address" class="form-control address ">

                    </div>
                    <div class="form-group ">
                        <label for="inputEmail4">Contact</label>
                        <input type="text" name="contact" class="form-control contact ">

                    </div>
                <div class="modal-footer">
                    <button class="btn  btn-primary btn-br-update " id="" type="button">Update Changes</button>
                </div><!-- /.modal-body -->
                <!-- .modal-footer -->
            </div>

        </div>
    </div>
</div>