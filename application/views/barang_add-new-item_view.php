 <?php $this->load->helper('HTML');	
    echo link_tag('css/form-transaction.css'); 
    echo link_tag('css/chosen.css'); 
?>
    
    <script src="<?php echo base_url(); ?>js/jquery.maskMoney.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function(){
            $('.chzn-select').chosen();
            $('.chzn-select-deselect').chosen({allow_single_deselect:true});
            
            $("#harga_beli").maskMoney(
                {   
                    prefix:'Rp.  ',
                    thousands : ".",
                    decimal :","
                }
            );
            
            $("#harga_jual").maskMoney(
                {   
                    prefix:'Rp.  ',
                    thousands : ".",
                    decimal :","
                }
            );
        });

    </script>

<div class="content-container" >
    <div class="form-add-new">
			<!-- general form elements -->
			<div class="box box-primary">
				
				<!-- form start -->

				<h1 class="heading">Add New Barang</h1>
				<?php echo form_open('',"class='form-horizontal'"); ?>
                
                <div class="side-one"><!-- side 1 -->
				<div class="form-group" id="lbl-kode">
					<label class="col-sm-4 control-label heading-label">Kode Barang</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="kode_barang" name="kode_name" 
                            placeholder="Kode Barang" maxlength="15" onkeyup='cek_kode()'>  
					</div><span id='err_kode' class="err_span"></span><span id='pesan_kode'></span>
				</div>

				<div class="form-group" id="lbl-nama"> 
					<label class="col-sm-4 control-label heading-label">Nama Barang</label>
					<div class="col-sm-6"> 
						<input type="text" class="form-control" id="nama_barang" name="nama_barang" 
                            placeholder="Nama Barang" maxlength="150" onkeyup='cek_nama()'>
					</div><span id='err_nama' class="err_span"></span>
				</div>

				<div class="form-group" id="lbl-kategori" >
					<label class="col-sm-4 control-label heading-label">Kategori</label>
					<div class="col-sm-6">
                            <select id="select_kategori" tabindex="5" class="chzn-select form-control" 
                            name="select_kategori" data-placeholder="Select Kategori" onchange="cek_kategori()">
                                <option value=""></option>
                                <?php
                                 if(isset($data_kategori)){
                                    foreach($data_kategori as $row){
                                        ?>
                                        <option value="<?=$row['Kategori_ID']?>"><?=$row['Kategori_Name']?></option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
                    </div><span id='err_kategori' class="err_span_select"></span>
				</div>
				<div class="form-group" id="lbl-subkategori">
					<label class="col-sm-4 control-label heading-label">Sub Kategori</label>
					<div class="col-sm-6">
						<select id="select_subkategori" tabindex="5" class="chzn-select form-control" 
                            name="select_subkategori" value="" data-placeholder="Select Sub Kategori" onchange="cek_subkategori()">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_subkategori)){
                                    foreach($data_subkategori as $row){
                                        ?>
                                        <option value="<?=$row['SubKategori_ID']?>"><?=$row['SubKategori_Name']?></option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='err_subkategori' class="err_span_select"></span>
				</div>
				<div class="form-group" id="lbl-merk">
					<label class="col-sm-4 control-label heading-label">Merek</label>
					<div class="col-sm-6">
						<select id="select_merk" tabindex="5" class="chzn-select form-control" 
                            name="select_merk" value="" data-placeholder="Select Merek">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_merk)){
                                    foreach($data_merk as $row){
                                        ?>
                                        <option value="<?=$row['Merk_ID']?>"><?=$row['Merk_Name']?></option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='err_merk' class="err_span_select"></span>
				</div>

				<div class="form-group" id="lbl-model">
					<label class="col-sm-4 control-label heading-label">Model</label>
					<div class="col-sm-6">
						<select id="select_model" tabindex="5" class="chzn-select form-control" 
                            name="select_model" value="" data-placeholder="Select Model">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_model)){
                                    foreach($data_model as $row){
                                        ?>
                                        <option value="<?=$row['Model_ID']?>"><?=$row['Model_Name']?></option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='err_model' class="err_span_select"></span>
				</div>
                
                </div><!-- side 1 -->
                
                
                <div class="side-two"><!-- side 2 -->
				<div class="form-group" id="lbl-hb">
					<label class="col-sm-4 control-label heading-label" id="lblName">Harga Beli</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_beli" name="harga_beli" 
                            maxlength="20" placeholder="Rp. xxx" onkeyup='cek_hb()'>						
					</div><span id='err_hb' class="err_span"></span>
				</div>

				<div class="form-group" id="lbl-hj">
					<label class="col-sm-4 control-label heading-label">Harga Jual</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_jual" name="harga_jual" 
                            maxlength="20" placeholder="Rp. xxx" onkeyup='cek_hj()' >
					</div><span id='err_hj' class="err_span"></span>
				</div>

				<div class="form-group" id="lbl-satuan">
					<label class="col-sm-4 control-label heading-label"id="lblPhone">Satuan</label>
					<div class="col-sm-6">
						<select id="select_satuan" tabindex="5" class="chzn-select form-control" 
                            name="select_satuan" value="" data-placeholder="Select Satuan">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_satuan)){
                                    foreach($data_satuan as $row){
                                        ?>
                                        <option value="<?=$row['Satuan_ID']?>"><?=$row['Satuan_Name']?></option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='err_satuan' class="err_span_select"></span>
				</div>
				<div class="form-group" id="lbl-qty">
					<label class="col-sm-4 control-label heading-label">Quantity</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="qty" name="qty" 
                            placeholder="Qty" maxlength="10" onkeypress='validate_number(event)' onkeyup='cek_qty()' >
					</div><span id='err_qty' class="err_span"></span>
				</div>
                
               	<div class="form-group" id="lbl-limit">
					<label class="col-sm-4 control-label heading-label">Limit</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="limit" name="limit" 
                            placeholder="limit" maxlength="10" onkeypress='validate_number(event)' onkeyup='cek_limit()' >
					</div><span id='err_limit' class="err_span"></span>
				</div>
				
                <div class="toolbar-form well">
                    <button type="submit" id="save" name="save" class="submit btn btn-large btn-primary btn-block ">Add New Item</button>
                    <button type="reset" id="cancel" class="btn btn-large btn-block ">Back to List</button>
                </div>
				
                </div><!-- side 2 -->
                
                <div class="clear"></div>
				<?php echo form_close(); ?>

			</div>
		</div><!-- div form-add-new -->
</div><!-- div container  -->