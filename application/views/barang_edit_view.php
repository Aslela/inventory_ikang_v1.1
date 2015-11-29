 <?php $this->load->helper('HTML');	
    echo link_tag('css/form-transaction.css'); 
    echo link_tag('css/chosen.css'); 
?>
    
    <script src="<?php echo base_url(); ?>js/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/chosen.jquery.js" type="text/javascript"></script>
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
        
        function setHarga(var1, var2){
                $('#harga_beli').maskMoney('mask', var1);
                $('#harga_jual').maskMoney('mask', var2);
            }
        
    </script>
<body onload="setHarga(<?=$data['Harga_Beli'];?>, <?=$data['Harga_Jual'];?> )">
<div class="content-container"  >
    <div class="form-add-new">
			<!-- general form elements -->
			<div class="box box-primary">
				
				<!-- form start -->

				<h1 class="heading">Edit Barang</h1>
				<?php echo form_open('',"class='form-horizontal'"); ?>
               
                <input type="hidden" id="item_id" value="<?=$data['Barang_ID'];?>"/>
               
                <div class="side-one">
				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Kode Barang</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="kode_barang" name="kode_name" 
                            placeholder="Kode Barang" maxlength="15" value="<?=$data['Kode_Barang'];?>" onkeyup='cek_kode()'>
                        <span id='err_kode'></span>
					</div><span id='pesan_kode'></span>
				</div>

				<div class="form-group"> 
					<label class="col-sm-4 control-label heading-label">Nama Barang</label>
					<div class="col-sm-6"> 
						<input type="text" class="form-control" id="nama_barang" name="nama_barang" 
                        placeholder="Nama Barang" maxlength="150" value="<?=$data['Barang_Name'];?>" onkeyup='cek_nama()'>
                        <span id='err_nama'></span>
					</div><span id='pesan_nama'></span>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Kategori</label>
					<div class="col-sm-6">
                            <select id="select_kategori" tabindex="5" class="chzn-select form-control" 
                            name="select_kategori" data-placeholder="Select Kategori">
                                <option value=""></option>
                                <?php
                                 if(isset($data_kategori)){
                                    foreach($data_kategori as $row){
                                        ?>
                                        <option value="<?=$row['Kategori_ID']?>" <?php if($row['Kategori_ID']==$data['Kategori_ID']){echo "selected";} ?>>
                                            <?=$row['Kategori_Name']?>
                                        </option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
                    </div><span id='pesan_kategori'></span>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Sub Kategori</label>
					<div class="col-sm-6">
						<select id="select_subkategori" tabindex="5" class="chzn-select form-control" 
                            name="select_subkategori" value="" data-placeholder="Select Sub Kategori">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_subkategori)){
                                    foreach($data_subkategori as $row){
                                        ?>
                                        <option value="<?=$row['SubKategori_ID']?>" <?php if($row['SubKategori_ID']==$data['SubKategori_ID']){echo "selected";} ?>>
                                            <?=$row['SubKategori_Name']?>
                                        </option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='pesan_subkategori'></span>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Merek</label>
					<div class="col-sm-6">
						<select id="select_merk" tabindex="5" class="chzn-select form-control" 
                            name="select_merk" value="" data-placeholder="Select Merek">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_merk)){
                                    foreach($data_merk as $row){
                                        ?>
                                        <option value="<?=$row['Merk_ID']?>" <?php if($row['Merk_ID']==$data['Merk_ID']){echo "selected";} ?>>
                                            <?=$row['Merk_Name']?>
                                        </option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
					</div><span id='pesan_merk'></span>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Model</label>
					<div class="col-sm-6">
						<select id="select_model" tabindex="5" class="chzn-select form-control" 
                            name="select_model" value="" data-placeholder="Select Model">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_model)){
                                    foreach($data_model as $row){
                                        ?>
                                        <option value="<?=$row['Model_ID']?>" <?php if($row['Model_ID']==$data['Model_ID']){echo "selected";} ?>>
                                            <?=$row['Model_Name']?>
                                        </option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
						<span id='err_model'></span>
					</div><span id='pesan_model'></span>
				</div>
                
                </div><!-- side 1 -->
                
                <div class="side-two">
				<div class="form-group">
					<label class="col-sm-4 control-label heading-label" id="lblName">Harga Beli</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_beli" name="harga_beli" maxlength="20" 
                            placeholder="Rp. xxx" value="<?=$data['Harga_Beli'];?>">
						<span id='err_beli'></span>
					</div><span id='pesan_beli'></span>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Harga Jual</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="harga_jual" name="harga_jual" maxlength="20" 
                            placeholder="Rp. xxx" value="<?=$data['Harga_Jual'];?>" >
						<span id='err_jual'></span>
					</div><span id='pesan_jual'></span>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label heading-label"id="lblPhone">Satuan</label>
					<div class="col-sm-6">
						<select id="select_satuan" tabindex="5" class="chzn-select form-control" 
                            name="select_satuan" value="" data-placeholder="Select Satuan">
                                <option value=""></option>
                                 <?php
                                 if(isset($data_satuan)){
                                    foreach($data_satuan as $row){
                                        ?>
                                        <option value="<?=$row['Satuan_ID']?>" <?php if($row['Satuan_ID']==$data['Satuan_ID']){echo "selected";} ?>>
                                            <?=$row['Satuan_Name']?>
                                        </option>
                                    <?php
                                    }
                                 }
                                ?>
                            </select>
						<span id='err_telp'></span>
					</div><span id='pesan_satuan'></span>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Quantity</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="qty" name="qty" 
                            placeholder="Qty" value="<?=$data['Qty'];?>" onkeyup='cek_qty()'>
						<span id="err_qty"></span>
					</div>
					<span id="pesan_qty"></span>
				</div>
                
               	<div class="form-group">
					<label class="col-sm-4 control-label heading-label">Limit</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="limit" name="limit" 
                            placeholder="limit" value="<?=$data['Limit'];?>" maxlength="10" onkeyup='cek_limit()'>
						<span id="err_limit"></span>
					</div>
					<span id="pesan_limit"></span>
				</div>
				
                <div class="toolbar-form well">
                    <ul>
                        <li>
                            <button type="submit" id="edit_barang" class="submit btn btn-large btn-primary btn-block ">Edit Item</button>
                        </li>
                        <li><a href="<?=site_url('Barang/index')?>"><button type="reset" id="cancel" class="btn btn-large btn-block ">Back to List</button></a></li>
                    </ul>    
                    
                </div>
				
                </div><!-- side 2 -->
                
                <div class="clear"></div>
				<?php echo form_close(); ?>

			</div>
		</div>

</div>
</body>