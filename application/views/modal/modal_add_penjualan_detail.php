
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
        
        $( "#kode_barang" ).combogrid({
    		debug:true,
    		resetButton:true,
            resetFields: ['#stock_barang','#harga_jual_barang','#item_id'],
    		searchButton:true,
    		colModel: [{'columnName':'Barang_ID','width':'10','label':'Id', 'hidden':true},
                        {'columnName':'Kode_Barang','width':'20','label':'Kode Barang'}, 
                        {'columnName':'Barang_Name','width':'40','label':'Name'},
                        {'columnName':'Harga_Jual','width':'30','label':'Harga Jual'},
                        {'columnName':'Qty','width':'10','label':'Stok'}],
    		url: 'getBarangData',    
    		select: function( event, ui ) {
                $( "#item_id" ).val( ui.item.Barang_ID );           
    			$( "#kode_barang" ).val( ui.item.Kode_Barang );
    			$( "#stock_barang" ).val( ui.item.Qty );
                var harga = ui.item.Harga_Jual;
                $("#harga_jual_barang").maskMoney('mask', parseInt(harga));
                return false;
    		}
	   });
              
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

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Add Item</a></li>
            <li><a href="#0"></a></li>
        </ul>
    
    <div id=""> <!-- log in form -->
        <form class="form-horizontal cd-form" id="detail-form">
            <div class="form-group" id="lbl-kode">
					<label class="col-sm-4 control-label heading-label">Kode Barang</label>
					<div class="col-xs-2">
						<input type="text" class="form-control combo-grid" id="kode_barang" name="kode_barang" 
                            placeholder="Kode Barang" maxlength="15">  
					</div><span id='err_kode_1' class="err_span"></span><span id='pesan_kode'></span>
            </div>
            
            <div class="form-group" id="lbl-stock">
					<label class="col-sm-4 control-label heading-label">Stock</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="stock_barang" name="stock" 
                            placeholder="xx" maxlength="15" disabled="disabled">  
					</div><span id='err_stock' class="err_span"></span><span id='pesan_kode'></span>
            </div>
            
            <div class="form-group" id="lbl-hj">
					<label class="col-sm-4 control-label heading-label">Harga Jual Sekarang</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_jual_barang" name="harga_jual" 
                            placeholder="Rp. xxx" maxlength="20" disabled="disabled">  
					</div><span id='err_harga_jual' class="err_span"></span><span id='pesan_kode'></span>
            </div>
            
            <div class="form-group" id="lbl-hjc">
					<label class="col-sm-4 control-label heading-label">Harga Jual</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_jual_curr_barang" name="harga_jual_curr" 
                            placeholder="Rp. xxx" maxlength="20" onkeyup='cek_kode()'>  
					</div><span id='err_harga_jual_curr' class="err_span"></span><span id='pesan_kode'></span>
			</div>
            
            <div class="form-group" id="lbl-qty">
					<label class="col-sm-4 control-label heading-label">Quantity</label>
					<div class="col-sm-6">
						<input type="number" step="0.01" class="form-control" id="qty_barang" name="qty" 
                            placeholder="xx" maxlength="15" onkeyup='cek_qty()'>  
					</div><span id='err_qty' class="err_span"></span><span id='pesan_kode'></span>
            </div>
            
            <p class="fieldset">
                <button class="full-width cd-btn-save btn btn-primary" id="add-detail-item" >Add</button>
            </p>
            
            <p id="created"></p>
            <p id="last_modified"></p>
            <input type="hidden" id="item_id" />
        </form>
                    
    <!-- <a href="#0" class="cd-close-form">Close</a> -->
    </div> <!-- cd-login -->

    <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->