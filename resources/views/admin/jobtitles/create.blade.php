<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Job Title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('jobtitles.store') }}" method="post" id="form" class="form-horizontal">
            @csrf
            <div class="modal-body form">


                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Job Title</label>
                        <div class="col-md-9">
                            <input name="title" class="form-control autocomplete_off" type="text" required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Job Description</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control autocomplete_off"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>


            </div>


            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>