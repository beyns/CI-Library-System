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
            <?php echo form_open('',array("class" =>'studentfrm'))?>
                
               <input type="text" class="br_id" name="id">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="student_num" class="form-control br_snum  " required="" autofocus="">

                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="fullname" class="form-control br_sname " required="" autofocus="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="address" class="form-control br_saddress " required="" autofocus="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="contact" class="form-control br_contact " required="" autofocus="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn  btn-primary btn-br-update " id="" type="button">Update Changes</button>
                </div><!-- /.modal-body -->
                <!-- .modal-footer -->
                </form>
            </div>

        </div>
    </div>
</div>