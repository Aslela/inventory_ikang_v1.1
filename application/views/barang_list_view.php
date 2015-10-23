
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'right',
        html:true
    });
});
</script>

<div class="content-container" >
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
    
    <div>
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
            <th style = "text-align:center;font-weight: bold;">Harga Beli</th>
            <th style = "text-align:center;font-weight: bold;">Harga Jual</th>
            <th style = "font-weight: bold;">Qty</th>
            <th style = "font-weight: bold;">Limit</th>
            <th style = "font-weight: bold;">Satuan</th>
            <th style = "text-align:center;font-weight: bold;">Option</th>
        </tr>
        </thead>
        
        <tbody>
            <?php 
                $no=0;
                foreach ($data as $row){
                    $no++;
            ?>
                    <tr>
                        <td align='center' class="no"><?=$no?></td>
                        <td align='left' class="nr"><?=$row['Kode_Barang']?></td>
                        <td align='left' class="nr" ><?=$row['Barang_Name']?></td>
                        <td align='left' class="nr" ><?=$row['Kategori_Name']?></td>
                        <td align='left' class="nr" ><?=$row['SubKategori_Name']?></td>
                        <td align='left' class="nr" ><?=$row['Merk_Name']?></td>
                        <td align='left' class="nr" ><?=$row['Model_Name']?></td> 
                       
                        <td align='right' class="nr"><?php echo number_format($row['Harga_Beli']);?></td>
                        <td align='right' class="nr"><?php echo number_format($row['Harga_Jual']);?></td>
                        <td align='left' class="nr"><?=$row['Qty']?></td>
                        <td align='left' class="nr"><?=$row['Limit']?></td>
                        <td align='left' class="nr"><?=$row['Satuan_Name']?></td>
                        <td align='center'>
                            <a class="edit-nav" href="<?php echo site_url('barang/getBarangByID/'.$row['Barang_ID'])?>">           
                                <button type="button" class="btn btn-primary btn-xs edit-btn">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>      
                            </a>    
                           	<a class="btn btn-danger btn-xs " href="<?php echo site_url('barang/deleteBarang/'.$row['Kategori_ID'])?>" 
                               onclick="return confirm('Are you sure to delete <?=$row['Kategori_ID']?> ?');">
                                <i class="glyphicon glyphicon-trash"></i>&nbsp Delete
                            </a>
                        </td>
                        
                        <td class="id-item" style="display: none;"><?=$row['Kategori_ID']?></td>
                        <td class="created" style="display: none;">
                            <?php 
                                $date=date_create($row['Created']); 
                                echo date_format($date,"d M Y")." by ".$row['Created_By'];
                            ?>
                        </td>
                        <td class="last-modified" style="display: none;">
                            <?php 
                                $date=date_create($row['Last_Modified']); 
                                echo date_format($date,"d M Y")." by ".$row['Last_Modified_By'];
                            ?>
                        </td>
                    </tr>
            <?php
                }
            ?>
            
        </tbody>
    </table>
    </div>
</div>