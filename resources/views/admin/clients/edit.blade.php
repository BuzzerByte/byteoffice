
<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="form-client" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                        <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Client Name<span class="required" aria-required="true">*</span></label>
                                        <input id='inp_name' type="text" name="name" value="" class="form-control input-md inp_client_name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Company Name</label>
                                        <input id='inp_company' type="text" name="company_name" class="form-control input-md inp_company_name"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Phone</label>
                                        <input id='inp_phone' type="text" name="phone" class="form-control input-md inp_phone"
                                            value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Fax</label>
                                        <input id='inp_fax' type="text" name="fax" class="form-control input-md inp_fax" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Email</label>
                                        <input id='inp_email' type="text" name="email" class="form-control input-md inp_email"
                                            value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Website</label>
                                        <input id='inp_website' type="text" name="website" class="form-control input-md inp_website"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Billing Address</label>
                                        <textarea id='inp_b_address' class="form-control inp_b_address" name="b_address"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Shipping Address</label>
                                        <textarea id='inp_s_address' class="form-control inp_s_address" name="s_address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Note</label>
                                        <textarea id='inp_note' class="form-control inp_customer_note" name="note"></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                        Update Client</button>
                </div>
            </form>
        </div>
    </div>