 <?php $this->load->helper('HTML');	
    echo link_tag('css/form-transaction.css'); 
    echo link_tag('css/chosen.css'); 
    echo link_tag('css/datepicker.css');
 ?>
    <script src="<?php echo base_url(); ?>js/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-editable.min.js" type="text/javascript"></script>
     
    <script type="text/javascript">
        $(function(){

            var count_index = 0;
            var base_url = "<?=base_url()?>";
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
                
                var kode_bon = $("#kode_bon").val();
                var nama_customer = $("#nama_customer").val();
                var tgl_penjualan = $("#tgl_penjualan").val();
                
                var status = $('#stat option:selected').val();
                var tgl_jth_tempo = $("#tgl_jth_tmp").val();
                
                var error_list_msg = new Array();
                
                if(kode_bon == null || kode_bon==""){
                    error_list_msg.push("Kode bon harus di isi");
                }
                if(nama_customer == null || nama_customer==""){
                    error_list_msg.push("Nama Customer harus di isi");
                }
                if(tgl_penjualan == null || tgl_penjualan==""){
                    error_list_msg.push("Tanggal Penjualan harus di isi");
                }
                if(status == 2){
                     if(tgl_jth_tempo == null || tgl_jth_tempo==""){
                        error_list_msg.push("Tanggal Jatuh Tempo harus di isi");
                     }
                }
                
                if(detailArray.length == 0){
                    error_list_msg.push("Barang yand di jual harus di isi");
                }
                
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
            
            $(".btn-closed" ).click(function(){
                $('#error-msg').addClass("hidden");
                $('.error-box').children().remove();
            });

            $('#add-detail').click(function(){
                var tr = $("<tr>", {id: "item-"+count_index});

                // Kode Barang
                var td1 = $("<td>", {class: "kode-item"});
                var a1 = $("<a>", {class: "kode-item-input","data-value": "","data-type":"text","data-pk":count_index});
                a1.appendTo(td1);

                // Nama barang, Harga barang current
                var td2 = $("<td>", {class: "name-item"});
                var td3 = $("<td>", {class: "harga-curr-item td-right"});

                // Qty Barang
                var td4 = $("<td>", {class: "qty-item td-right"});
                var a4 = $("<a>", {class: "qty-item-input","data-value": "0","data-type":"number","data-pk":count_index});
                a4.appendTo(td4);

                // Harga jual
                var td5 = $("<td>", {class: "harga-item td-right"});
                var a5 = $("<a>", {class: "harga-item-input","data-value": "0","data-type":"number","data-pk":count_index});
                a5.appendTo(td5);

                //Harga total
                var td6 = $("<td>", { class: "harga-total-item td-right","data-value": "0"});

                //Option
                var td7 = $("<td>", { class: "option td-center"});
                var button_del = $("<button>", {id: "del", class: "btn btn-danger btn-xs", type: "button", "data-index-id":count_index});
                var span_del = $("<span>", {class: "glyphicon glyphicon-trash"});
                span_del.appendTo(button_del);
                button_del.appendTo(td7);


                //Set data to table
                td1.appendTo(tr);
                td2.appendTo(tr);
                td3.appendTo(tr);
                td4.appendTo(tr);
                td5.appendTo(tr);
                td6.appendTo(tr);
                td7.appendTo(tr);
                $('#detail-content').append(tr);

                count_index++;
                //Editable Kode
                $('.kode-item-input').editable({
                    url: base_url+"/index.php/barang/getBarangPenjualan",
                    ajaxOptions: {
                        type: 'post',
                        dataType: 'json'
                    },
                    success: function(response, newValue) {
                        if(response.status=="error"){
                            return response.msg;
                        }
                        else{
                            $(this).attr("data-value",response.barangID);
                            var $row =  $(this).closest("tr");
                            var harga = parseInt(response.harga).format(0, 3, '.', ',');
                            $row.find(".name-item").text(response.namaBarang);
                            $row.find(".harga-curr-item").text(harga);
                            $('.harga-item-input').editable('setValue', response.harga, true);
                            //return response.msg;
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
                //Editable qty
                $('.qty-item-input').editable({
                    step: 'any', // <-- added this line
                    title : 'Enter New Value',
                    display: function(value) {
                        $(this).attr("data-value",value);
                        $(this).text(value);
                    }
                });
                //Editable harga Jual
                $('.harga-item-input').editable({
                    title : 'Enter New Value',
                    display: function(value) {
                        $(this).attr("data-value",value);
                        var k = parseFloat(value).format(0, 3, '.', ',');
                        $(this).text(k);
                    }
                });

                //Delete Action
                //DELETE BUTTON CLICK
                button_del.click(function(event){
                    var element  = $(this).closest("tr");
                    element.remove();
                });

                $(".kode-item-input,.qty-item-input,.harga-item-input").bind("DOMSubtreeModified", function() {
                    var $row =  $(this).closest("tr");
                    var qty = $row.find(".qty-item-input").attr("data-value");
                    var price = $row.find(".harga-item-input").attr("data-value");
                    var total = parseInt(qty)*parseInt(price);
                    $row.find(".harga-total-item").attr("data-value",total)
                    $row.find(".harga-total-item").text(total.format(0, 3, '.', ','));
                    //alert("tree changed");
                });

//                $('.kode-item-input,.qty-item-input,.harga-item-input').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
//                    if (event.type == 'DOMNodeInserted') {
//                        alert('Content added! Current content:' + '\n\n' + this.innerHTML);
//                    } else {
//                        alert('Content removed! Current content:' + '\n\n' + this.innerHTML);
//                    }
//                });
            });

            $.fn.editable.defaults.mode = 'inline';
            $('.kode-item').editable();
            $('.qty-item').editable({
                step: 'any', // <-- added this line
                title : 'Enter New Value'
            });

            Number.prototype.format = function(n, x, s, c) {
                var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                    num = this.toFixed(Math.max(0, ~~n));

                return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
            };


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
                    <button type="button" class="btn btn-success btn-sm" id="hd-btn-save">
                        <span class="glyphicon glyphicon-floppy-save"></span>&nbsp Save Penjualan
                    </button>
                    <a class="main-nav" href="#">
                        <button type="button" class="btn btn-primary btn-sm" id="add-detail" data-toggle="modal" data-target="#penjualan-modal">
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
                    <div class="col-lg-5 float-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" aria-label="Bold">
                                    <span class="glyphicon glyphicon-gift"></span> Discount
                                </button>
                            </div>
                           <span class="form-control"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 float-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" aria-label="Bold">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Total
                                    &nbsp&nbsp&nbsp&nbsp&nbsp
                                </button>
                            </div>
                            <span class="form-control"></span>
                        </div>
                    </div>
                </div>
            </div>
		</div><!-- div form-add-new -->   
	

</div><!-- div container -->   