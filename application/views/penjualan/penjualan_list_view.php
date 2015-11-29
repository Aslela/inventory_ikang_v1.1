
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
        <a class="cd-signin main-nav" href="<?php echo site_url('penjualan/goToAddNewPenjualan')?>">
            <button type="button" class="btn btn-primary btn-xl">
                <span class="glyphicon glyphicon-plus"></span>&nbsp Add New Penjualan
            </button>
        </a>
    </div>
    
    <div>
    <table  class="table table-hover table-bordered table-striped">
        <thead>
        <tr>
            <th style = "text-align:center;font-weight: bold;">NO</th>
            <th style = "font-weight: bold;">Kode Bon</th>
            <th style = "font-weight: bold;">Tanggal Penjualan</th>
            <th style = "font-weight: bold;">Pembeli</th>
            <th style = "font-weight: bold;">Status</th>
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
                        <td align='left' class="nr"><?=$row['Kode_Bon']?></td>
                        <td align='left' class="nr" ><?=$row['Tgl_Penjualan']?></td>
                        <td align='left' class="nr" ><?=$row['Nama_Pembeli']?></td>
                        <td align='left' class="nr" ><?=$row['Status']?></td>

                        <td align='center'>
                            <a class="edit-nav" href="<?php echo site_url('penjualan/goToEditPenjualan?id='.$row['Penjualan_ID'])?>">           
                                <button type="button" class="btn btn-primary btn-xs edit-btn">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>      
                            </a>    
                           	
                        </td>
                        
                        <td class="id-item" style="display: none;"><?=$row['Penjualan_ID']?></td>
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