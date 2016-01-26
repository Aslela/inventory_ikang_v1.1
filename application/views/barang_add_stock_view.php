<div class="content-container" >
    <h2>Add Stock Barang </h2>
    <div class="well">
        <div class="row">
            <div class="col-lg-8">
                <a class="cd-signin main-nav" href="<?php echo site_url('barang/goToAddNewBarang')?>">
                    <button type="button" class="btn btn-primary btn-xl">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp Add New Barang
                    </button>
                </a>
            </div>
            <div class="col-lg-4" id="search-box">
                <?php echo form_open('barang/searchBarang'); ?>
                <div class="input-group">
                    <input type="text" class="form-control" name="search-text" id="search-text" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="search-btn" class="btn btn-default" type="submit">Search!</button>
                    </span>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <table  class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th style = "text-align:center;font-weight: bold;">NO</th>
                <th style = "font-weight: bold;">Kode Barang</th>
                <th style = "font-weight: bold;">Nama Barang</th>
                <th style = "font-weight: bold;">Kategori</th>
                <th style = "font-weight: bold;">Sub Kategori</th>
                <th style = "font-weight: bold;">Merek</th>
                <th style = "font-weight: bold;">Model</th>
                <th style = "font-weight: bold;">Qty</th>
                <th style = "font-weight: bold;">Limit</th>
                <th style = "font-weight: bold;">Satuan</th>
            </tr>
        </thead>

        <tbody>

        </tbody>

    </table>
</div>