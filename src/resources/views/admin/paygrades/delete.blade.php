<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-d-payGrade" enctype="multipart/form-data" method="post">
            @csrf
        <div class="modal-body">
                Are you sure?
        </div>
        <div class="modal-footer">
                <button class="btn btn-danger" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Delete Pay Grade</button>
        </div>
    </form>
    </div>
</div>

