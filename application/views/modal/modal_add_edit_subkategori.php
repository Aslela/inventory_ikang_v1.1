<!--Modal-->
<div class="modal fade" id="subkategori-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"></h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form id="subkategori-form">
                    <input type="hidden" class="form-control" id="category-id">
                    <div class="form-group">
                        <label for="nama" class="control-label cd-name">Sub Category Name :</label>
                        <span class="cd-error-message label label-danger">Must be filled!</span>
                        <input type="text" class="form-control" id="inputan" name="kategori_name"
                               placeholder="Name">
                    </div>
                    <input type="hidden" id="modul_name" value="SubKategori"/>
                    <input type="hidden" id="item_id" />
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <p id="created"></p>
                <p id="last_modified"></p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" id="btn-update">Edit</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>