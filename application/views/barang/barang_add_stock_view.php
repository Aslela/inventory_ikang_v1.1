<?php $this->load->helper('HTML');
    echo link_tag('css/form-transaction.css');
?>
<script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-editable.min.js" type="text/javascript"></script>

<div class="content-container" >
    <h2>Add Stock Barang</h2>
    <div class="form-add-stock">
        <!-- general form elements -->
            <fieldset>
                <legend>
                   <button type="button" id="btn-save" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp Save</button>
                </legend>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Barang Identity</label>
                        <span id='err_identity' class=""></span>
                        <div class="row">
                            <div class="col-xs-4 col-identity">
                                <a href="#" class="" id="kode-barang" data-value="" data-type="text" data-pk="1"></a>
                            </div>
                            <div class="col-xs-4 col-identity">
                                <a href="#" id="discount" data-value="0">0</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label">Supplier</label>
                        <span id='err_supplier' class=""></span>
                        <div class="row">
                            <div class="col-xs-4">
                                <select id="select_supplier" tabindex="5" class="chzn-select form-control"
                                        name="select_supplier" data-placeholder="Select Supplier">
                                    <option value=""></option>
                                    <?php
                                    if(isset($data_supplier)){
                                        foreach($data_supplier as $row){
                                            ?>
                                            <option value="<?=$row['Supplier_ID']?>"><?=$row['Supplier_Name']?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Quantity</label>
                        <span id='err_qty' class=""></span>
                        <div class="row">
                            <div class="col-xs-2">
                                <input type="text" class="form-control" id="qty" name="qty"
                                       placeholder="Qty" maxlength="10" onkeypress='validate_number(event)'>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    <br>
    <div class="container-data-barang">

    </div>

    </div><!-- div form-add-new -->
</div><!-- div container  -->

<script>
    $(function(){
        var base_url = $("#base_url").val();
        $.fn.editable.defaults.mode = 'inline';
        $('#kode-barang').editable({
            url: base_url+"index.php/barang/getBarangStock",
            emptytext: 'Enter Kode Barang',
            placeholder: 'Enter Kode Barang',
            ajaxOptions: {
                type: 'post',
                dataType: 'json'
            },
            success: function(response, newValue) {
                if(response.status=="error"){
                    return response.status;
                }
                else{
                   $(this).attr("data-value",response.barangID);
                   $('.container-data-barang').html(response.msg);
                }
            },
            error: function(response, newValue) {
                if(response.status === 500) {
                    return 'Service unavailable. Please try later.';
                } else {
                    return response.responseText;
                }
            }

        });

        //SAVE
        $('#btn-save').click(function(){
            if(validateInput()){
                var barang = $('#kode-barang').attr("data-value");
                var supplier = $('#select_supplier').val();
                var qty = $('#qty').val();
                var base_url = $("#base_url").val();

                var data_post = {
                    barang: barang,
                    supplier: supplier,
                    qty: qty
                };

                // ajax mulai disini
                $.ajax({
                    url: base_url+"index.php/barang/addStockBarang", //arahkan pada proses_tambah di controller nasabah
                    data: data_post,
                    type: "POST",
                    success: function(msg){
                        if(msg==1){
                            // hapus data
                            alertify.success("Tambah Stok Barang Sukses");
                            window.location.assign(base_url+"/index.php/barang");
                        }else{
                            alertify.error("Tambah Stok Barang Gagal");
                        }
                    },
                    error: function(msg){
                        alertify.error("Failed to response server!");
                    }
                });
            }
        });

        function validateInput(){
            var err = 0;
            var kode = $('#kode-barang').attr("data-value");
            var supplier = $('#select_supplier').val();
            var qty = $('#qty').val();
            $(".label-danger").remove();

            if(kode == ""){
                $('<span class="label label-danger">Must be filled</span>').appendTo("#err_identity");
                err++;
            }

            if(supplier == "" || supplier == null){
                $('<span class="label label-danger">Must be filled</span>').appendTo("#err_supplier");
                err++;
            }

            if(qty == 0 || qty == ""){
                $('<span class="label label-danger">Must be filled</span>').appendTo("#err_qty");
                err++;
            }
            if(err==0){
                return true;
            }else{
                return false;
            }
        }
    });
</script>