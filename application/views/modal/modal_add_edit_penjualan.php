
<?php $this->load->helper('HTML');
echo link_tag('css/combogrid/jquery-ui-1.10.1.custom.css');
echo link_tag('css/combogrid/jquery.ui.combogrid.css');
?>

<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/combogrid/jquery.ui.combogrid-1.6.3.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/modal-detail.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $("#harga_jual_barang").maskMoney(
            {
                prefix:'Rp.  ',
                thousands : ".",
                decimal :","
            }
        );

        $("#harga_jual_curr_barang").maskMoney(
            {
                prefix:'Rp.  ',
                thousands : ".",
                decimal :","
            }
        );

        $("#qty_barang").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false
            }
        });

//        $( "#kode_barang" ).combogrid({
//            debug:true,
//            resetButton:true,
//            resetFields: ['#stock_barang','#harga_jual_barang','#item_id'],
//            searchButton:true,
//            colModel: [{'columnName':'Barang_ID','width':'10','label':'Id', 'hidden':true},
//                {'columnName':'Kode_Barang','width':'20','label':'Kode Barang'},
//                {'columnName':'Barang_Name','width':'40','label':'Name'},
//                {'columnName':'Harga_Jual','width':'30','label':'Harga Jual'},
//                {'columnName':'Qty','width':'10','label':'Stok'}],
//            url: 'getBarangData',
//            select: function( event, ui ) {
//                $( "#item_id" ).val( ui.item.Barang_ID );
//                $( "#kode_barang" ).val( ui.item.Kode_Barang );
//                $( "#stock_barang" ).val( ui.item.Qty );
//                var harga = ui.item.Harga_Jual;
//                $("#harga_jual_barang").maskMoney('mask', parseInt(harga));
//                return false;
//            }
//        });

    });

    //Validate
    function cek_qty(){
        var inputan = parseFloat($("#qty_barang").val());
        var stock = parseFloat($("#stock_barang").val());

        if(inputan > stock){
            alert("stock barang tinggal "+stock);
        }
    }

</script>

<!--Modal-->
<div class="modal fade" id="penjualan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form id="detail-form">
                    <input type="hidden" class="form-control" id="category-id">
                    <div class="form-group">
                        <label for="nama" class="control-label cd-name">Category Name :</label>
                        <span class="cd-error-message label label-danger">Must be filled!</span>
                        <input type="text" class="form-control" id="inputan" name="kategori_name"
                               placeholder="Name">
                    </div>
                    <div class="form-group" id="lbl-kode">
                        <label class="control-label">Kode Barang</label>
                        <span id='err_kode_1' class="err_span"></span><span id='pesan_kode'></span>
                        <div class="input-group">
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                   placeholder="Kode Barang" maxlength="15">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default btn-xl" id="hd-btn-save">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-xl" id="hd-btn-save">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="lbl-stock">
                        <label class="control-label">Stock</label>
                        <span id='err_stock' class="err_span"></span><span id='pesan_kode'></span>
                        <input type="text" class="form-control" id="stock_barang" name="stock"
                               placeholder="xx" maxlength="15" disabled="disabled">
                    </div>

                    <div class="form-group" id="lbl-hj">
                        <label class="control-label">Harga Jual Sekarang</label>
                        <span id='err_harga_jual' class="err_span"></span><span id='pesan_kode'></span>
                        <input type="text" class="form-control" id="harga_jual_barang" name="harga_jual"
                               placeholder="Rp. xxx" maxlength="20" disabled="disabled">
                    </div>

                    <div class="form-group" id="lbl-hjc">
                        <label class="control-label">Harga Jual</label>
                        <span id='err_harga_jual_curr' class="err_span"></span><span id='pesan_kode'></span>
                        <input type="text" class="form-control" id="harga_jual_curr_barang" name="harga_jual_curr"
                               placeholder="Rp. xxx" maxlength="20" onkeyup='cek_kode()'>
                    </div>

                    <div class="form-group" id="lbl-qty">
                        <label class="control-label">Quantity</label>
                        <span id='err_qty' class="err_span"></span><span id='pesan_kode'></span>
                        <input type="number" step="0.01" class="form-control" id="qty_barang" name="qty"
                               placeholder="xx" maxlength="15" onkeyup='cek_qty()'>
                    </div>

                    <input type="hidden" id="modul_name" value="Kategori"/>
                    <input type="hidden" id="item_id" />
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <p id="created"></p>
                <p id="last_modified"></p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="full-width cd-btn-save btn btn-primary" id="add-detail-item" >Add</button>
                <button type="button" class="btn btn-primary" id="btn-update">Edit</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>