<div class="modal fade" id="borrowed_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title category"> </h5>
            </div>

            <div class="modal-body">
          <?php echo form_open('', array("class" =>"br_form"))?>
                <input type="hidden" class="bid" id="idi" name="id">
                <input type="hidden" class="bdate"  name="date">
                <input type="hidden" class="abook"  name="abook">
                <input type="hidden" class="bbqty"  name="bbqty">
                <!-- <input type="text" class="bname" id="id" name="id"> -->

                <blockquote>
                    <small class="mb-0 bbooktitle">The Accidental Billionaires : The Founding of Facebook - A Tale of Sex, Money, Genius and Betrayal </small>
                    <footer class="author">

                    </footer>
                </blockquote>
                <p class="description"> </p>
                <div class="form-group">
                          <div class="form-label-group">
                            <select class="custom-select fls1" id="fls1" name="b_status" required="">
                              <option selected>.... </option>
                              <option> Returned </option>
                            </select> <label for="fls1">Status</label>
                          </div>
                        </div>
                      
                        <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-update" >Update Status</button>
            </div>
                </form>
            </div>
           
        </div>
    </div>
</div>