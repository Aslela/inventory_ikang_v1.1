<style>
    div.form-group {
        margin-bottom: 5px!important;
    }
</style>

<fieldset>
    <legend>Data Barang</legend>
<?php echo form_open('',"class='form-horizontal'"); ?>
    <div class="side-one"><!-- side 1 -->
        <div class="form-group" id="lbl-kode">
            <label class="control-label heading-label">Kode Barang</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Kode_Barang;?>">
        </div>

        <div class="form-group" id="lbl-nama">
            <label class="control-label heading-label">Nama Barang</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Barang_Name;?>">
        </div>

        <div class="form-group" id="lbl-kategori" >
            <label class="control-label heading-label">Kategori</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Kategori_Name;?>">
        </div>
        <div class="form-group" id="lbl-subkategori">
            <label class="control-label heading-label">Sub Kategori</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->SubKategori_Name;?>">
        </div>
        <div class="form-group" id="lbl-merk">
            <label class="control-label heading-label">Merek</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Merk_Name;?>">
        </div>

        <div class="form-group" id="lbl-model">
            <label class="control-label heading-label">Model</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Model_Name;?>">
        </div>

    </div><!-- side 1 -->


    <div class="side-two"><!-- side 2 -->
        <div class="form-group" id="lbl-hb">
            <label class="control-label heading-label" id="lblName">Harga Beli</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Harga_Beli;?>">

        </div>

        <div class="form-group" id="lbl-hj">
            <label class="control-label heading-label">Harga Jual</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Harga_Jual;?>" >

        </div>

        <div class="form-group" id="lbl-ukuran">
            <label class="control-label heading-label">Ukuran</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Ukuran;?>">
        </div>

        <div class="form-group" id="lbl-satuan">
            <label class="control-label heading-label"id="lblPhone">Satuan</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Satuan_Name;?>">
        </div>
        <div class="form-group">
            <label class="control-label heading-label">Quantity</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Qty;?>">
        </div>

        <div class="form-group" id="lbl-limit">
            <label class="control-label heading-label">Limit</label>
            <input type="text" class="form-control"
                   disabled="disabled" value="<?php echo $data_barang->Limit;?>">
        </div>

    </div><!-- side 2 -->

    <div class="clear"></div>
<?php echo form_close(); ?>
</fieldset>