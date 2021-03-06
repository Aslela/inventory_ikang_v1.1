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
                    decimal :",",
                    precision :0
                }
            );
            
            $("#harga_jual").maskMoney(
                {   
                    prefix:'Rp.  ',
                    thousands : ".",
                    decimal :",",
                    precision :0
                }
            );
        });

    </script>

<div class="content-container" >
    <h2>Add New Barang </h2>
    <div class="form-add-new">
			<!-- general form elements -->
			<div class="box box-primary">

				<!-- form start -->
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" id="save" name="save" class="submit btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-save"></span>&nbsp Save
                            </button>
                            <a href="<?=site_url('Barang/index')?>">
                                <button type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp Back to List
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
				<?php echo form_open('',"class='form-horizontal'"); ?>

                <div class="side-one"><!-- side 1 -->
				<div class="form-group" id="lbl-kode">
					<label class="control-label heading-label">Kode Barang</label>
                    <span id='err_kode' class=""></span><span id='pesan_kode'></span>
					<input type="text" class="form-control" id="kode_barang" name="kode_name"
                            placeholder="Kode Barang" maxlength="15">
				</div>

				<div class="form-group" id="lbl-nama">
					<label class="control-label heading-label">Nama Barang</label>
                    <span id='err_nama' class=""></span>
					<input type="text" class="form-control" id="nama_barang" name="nama_barang"
                            placeholder="Nama Barang" maxlength="150">

				</div>

				<div class="form-group" id="lbl-kategori" >
					<label class="control-label heading-label">Kategori</label>
                    <span id='err_kategori' class=""></span>
					<div class="">
                            <select id="select_kategori" tabindex="5" class="chzn-select form-control"
                            name="select_kategori" data-placeholder="Select Kategori">
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
                    </div>
				</div>
				<div class="form-group" id="lbl-subkategori">
					<label class="control-label heading-label">Sub Kategori</label>
                    <span id='err_subkategori' class=""></span>
					<div class="">
						<select id="select_subkategori" tabindex="5" class="chzn-select form-control"
                            name="select_subkategori" value="" data-placeholder="Select Sub Kategori">
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
					</div>
				</div>
				<div class="form-group" id="lbl-merk">
					<label class="control-label heading-label">Merek</label>
                    <span id='err_merk' class=""></span>
					<div class="">
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
					</div>
				</div>

				<div class="form-group" id="lbl-model">
					<label class="control-label heading-label">Model</label>
                    <span id='err_model' class=""></span>
					<div class="">
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
					</div>
				</div>

                </div><!-- side 1 -->


                <div class="side-two"><!-- side 2 -->
				<div class="form-group" id="lbl-hb">
					<label class="control-label heading-label" id="lblName">Harga Beli</label>
                    <span id='err_hb' class=""></span>
					<input type="text" class="form-control" id="harga_beli" name="harga_beli"
                            maxlength="20" placeholder="Rp. xxx" onkeyup='cek_hb()'>

				</div>

				<div class="form-group" id="lbl-hj">
					<label class="control-label heading-label">Harga Jual</label>
                    <span id='err_hj' class=""></span>
					<input type="text" class="form-control" id="harga_jual" name="harga_jual"
                            maxlength="20" placeholder="Rp. xxx" onkeyup='cek_hj()' >

				</div>

                <div class="form-group" id="lbl-ukuran">
                    <label class="control-label heading-label">Ukuran</label>
                    <span id='err_ukuran' class=""></span><span id='pesan_ukuran'></span>
                    <input type="text" class="form-control" id="ukuran" name="ukuran"
                           placeholder="99 x 99" maxlength="15"'>
                </div>

				<div class="form-group" id="lbl-satuan">
					<label class="control-label heading-label"id="lblPhone">Satuan</label>
                    <span id='err_satuan' class=""></span>
					<div class="">
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
					</div>
				</div>
				<div class="form-group" id="lbl-qty">
					<label class="control-label heading-label">Quantity</label>
                    <span id='err_qty' class=""></span>

					<input type="text" class="form-control" id="qty" name="qty"
                            placeholder="Qty" maxlength="10" onkeypress='validate_number(event)'>

				</div>

               	<div class="form-group" id="lbl-limit">
					<label class="control-label heading-label">Limit</label>
                    <span id='err_limit' class=""></span>
					<input type="text" class="form-control" id="limit" name="limit"
                            placeholder="limit" maxlength="10" onkeypress='validate_number(event)'>

				</div>

                </div><!-- side 2 -->

                <div class="clear"></div>
				<?php echo form_close(); ?>

			</div>
		</div><!-- div form-add-new -->
</div><!-- div container  -->