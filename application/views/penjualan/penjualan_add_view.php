 <?php $this->load->helper('HTML');	
    echo link_tag('css/form-transaction.css'); 
    echo link_tag('css/chosen.css'); 
    echo link_tag('css/datepicker.css');
    echo link_tag('css/select2.css');
 ?>
    <script src="<?php echo base_url(); ?>js/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/select2.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-editable.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/penjualan.js" type="text/javascript"></script>
     
    <script type="text/javascript">
        $(function(){
            // Jquery draggable
            $('.modal-dialog').draggable({
                handle: ".modal-header"
            });

            $(".hutang").hide();  
            
            //set jquery datepicker         
            $('#tgl_penjualan').datepicker({
                dateFormat: "yy-mm-dd"
            });
            $('#tgl_jth_tmp').datepicker({
                dateFormat: "yy-mm-dd"
            });
            
            $('#tgl_penjualan').datepicker()
              .on('changeDate', function(ev){
                $('#tgl_penjualan').datepicker('hide');
            });
            
            $('#tgl_jth_tmp').datepicker()
              .on('changeDate', function(ev){
                $('#tgl_jth_tmp').datepicker('hide');
            });
    
            //show hide status hutang
            $( ".status" ).change(function() {
              
              var value = $( "#stat" ).val();
              if(value=='1'){
                $(".hutang").hide();    
              }else{
                $(".hutang").show();
              }
            });
            
            //SAVE
            $("#hd-btn-save" ).click(function(){
                

                if(error_list_msg.length != 0 ){
                    $('#error-msg').removeClass("hidden");
                    for(var i in error_list_msg ){
                         var div_msg = $("<div>", {id: "kode", class: "alert alert-danger"}).text(error_list_msg[i]);
                         $('.error-box').append(div_msg);
                         alert(tgl_penjualan);
                    }
                    
                }else{
                    $('#error-msg').addClass("hidden");
                    var header_data_penjualan = new Object();
                    header_data_penjualan.kode = kode_bon ;
                    header_data_penjualan.customer  = nama_customer;
                    header_data_penjualan.tgl_penjualan = tgl_penjualan;
                    header_data_penjualan.status = status;
                    if(status==2){
                        header_data_penjualan.tgl_jth_tempo =tgl_jth_tempo;
                    }
                    var data_penjualan = new Array();
                    data_penjualan.push(header_data_penjualan);
                    data_penjualan.push(detailArray);
                    
                    var data_post = {
                        data :data_penjualan
                    }
                    
                   	// ajax mulai disini
					$.ajax({
						url: base_url+"/index.php/penjualan/createPenjualan",
						data: data_post,
						type: "POST",
                        dataType: 'json',
						success: function(msg){
						  if(msg==0){
						      alert(msg);
						  }else{
						      alert(msg);
						  }					 
						}
					});
                }
            });

            $('#add-detail').click(function(){
                addBarangPenjualan();
            });

            $.fn.editable.defaults.mode = 'inline';
            $('#dicount').editable({
                type: 'number',
                title : 'Enter New Value',
                display: function(value) {
                    // set Total-discount
                    var old_discount =  parseInt($(this).attr("data-value"));
                    var discount  = parseInt(value);
                    var result = 0-(discount-old_discount);
                    //alert(result);
                    countResult(result);

                    // set Discount value
                    $(this).attr("data-value",value);
                    var k = discount.format(0, 3, '.', ',');
                    $(this).text(k);
                }
            });
        });
    </script>
 <style>
     .modal
     {
         overflow: hidden;
     }
     .modal-dialog{
         margin:auto;
         left: 0;
     }
     #total-result{
         font-size: 16px;
     }
 </style>

<?php //$this->load->view('modal/modal_add_edit_penjualan')?>
<div class="content-container" >
    
    <!--Error Container-->          
    <div class="error-container hidden" id="error-msg">
       <div class="btn-closed">
            <button type="button" class="btn btn-default btn-lg">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
       </div>
       
       <div class="error-box">
            <!--Error Messages here-->
       </div>  
    </div>
    
 <div class="form-add-new">
			<!-- general form elements -->
			<div class="box box-primary">
				
				<!-- form start -->

				<h3 class="">
                    Penjualan Baru
                </h3>
                <div class="well well-sm">
                    <button type="button" class="btn btn-default" id="hd-btn-save">
                        <span class="glyphicon glyphicon-floppy-save"></span>&nbsp Save
                    </button>
                    <a class="main-nav" href="#">
                        <button type="button" class="btn btn-default" id="add-detail" data-toggle="modal" data-target="#penjualan-modal">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp Add Item
                        </button>
                    </a>
                </div>
                
				<?php echo form_open('',"class='form-horizontal'"); ?>
                
                <div class="side-one"><!-- side 1 -->
				<div class="form-group" id="lbl-kode">
					<label class="col-sm-3 control-label heading-label">Kode BON</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="kode_bon" name="kode_bon" 
                            placeholder="Kode BON" maxlength="15" onkeyup='cek_kode()'>  
					</div><span id='err_kode' class="err_span"></span><span id='pesan_kode'></span>
				</div>

				<div class="form-group" id="lbl-customer"> 
					<label class="col-sm-3 control-label heading-label">Nama Pembeli</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="nama_customer" name="nama_customer" 
                            placeholder="Nama Pembeli" maxlength="150" onkeyup='cek_nama()'>
					</div><span id='err_nama' class="err_span"></span>
				</div>
                
               	<div class="form-group" id="lbl-tgl-beli"> 
					<label class="col-sm-3 control-label heading-label">Tanggal Penjualan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="tgl_penjualan" name="tgl_penjualan" 
                            placeholder="MM/dd/YYYY" maxlength="150" onkeyup='cek_nama()'>
					</div><span id='err_nama' class="err_span"></span>
				</div>
                
                </div><!-- side 1 -->
                
                <div class="side-two"><!-- side 2 -->
                    <div class="form-group">
                   	    <label class="col-sm-3 control-label heading-label">Status</label>
                          <div class="col-sm-9">
                          <select class="form-control status" id="stat" name="stat">
                            <option value="1" selected="selected">CASH</option>
                            <option value="2">LUNAS</option>
                            <option value="3">HUTANG</option>
                          </select>
                          </div>
                    </div>
                    
                    <div class="form-group hutang">
                   	    <label class="col-sm-3 control-label heading-label">Harga Hutang</label>
                          <div class="col-sm-9">
                          	<input type="text" class="form-control" id="harga_htg" name="harga_htg" 
                            placeholder="xxx" maxlength="150" onkeyup='cek_nama()'>
                          </div>
                    </div>
                    
                   	<div class="form-group hutang" id="lbl-tgl-beli"> 
    					<label class="col-sm-3 control-label heading-label">Tanggal Jatuh Tempo</label>
    					<div class="col-sm-9">
    						<input type="text" class="form-control" id="tgl_jth_tmp" name="tgl_jth_tmp" 
                                placeholder="MM/dd/YYYY" maxlength="150" onkeyup='cek_nama()'>
    					</div><span id='err_nama' class="err_span"></span>
    				</div>
                    
                </div>
               	<?php echo form_close(); ?>
                
                <div class="clear"></div>

                <table class="table table-bordered table-striped" id="tbl-detail">
                    <thead>
                    <tr>
                        <th style = "text-align:left;">Kode Barang</th>
                        <th style = "text-align:left;">Nama Barang</th>
                        <th style = "text-align:right;">Harga Jual Current </th>
                        <th style = "text-align:right;">Qty</th>
                        <th style = "text-align:right;">Harga Jual</th>
                        <th style = "text-align:right;">Harga Total</th>
                        <th style = "text-align:center;">Option</th>
                    </tr>
                    </thead>

                    <tbody id="detail-content">

                    </tbody>

                </table>

                <div class="row">
                    <div class="col-lg-5 float-right td-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" aria-label="Bold">
                                    <span class="glyphicon glyphicon-gift"></span> Discount
                                </button>
                            </div>
                           <span class="form-control"><a href="#" id="dicount" data-value="0">0</a></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 float-right td-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" aria-label="Bold">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Total
                                    &nbsp&nbsp&nbsp&nbsp&nbsp
                                </button>
                            </div>
                            <span class="form-control" id="total-result" data-value="0"></span>
                        </div>
                    </div>
                </div>
            </div>
		</div><!-- div form-add-new -->   
	

</div><!-- div container -->