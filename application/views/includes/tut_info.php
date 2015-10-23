<div id="tutInfo">Tutorial created by <a href="http://www.youtube.com/watch?v=oHg5SJYRHA0">Jeffrey Way</a> for <a href="http://net.tutsplus.com">Nettuts+</a></div>

  <?php 
                $no=0;
                foreach ($data as $row){
                    $no++;
            ?>
                    <tr>
                        <td class="no"><?=$no?></td>
                        <td class="nr"><?=$row['Kode_Barang']?></td>
                        <td class="nr" ><?=$row['Barang_Name']?></td>
                        <td class="nr"><?=$row['Kategori_Name']?>&nbsp
                         <button type="button" class="btn btn-xs" data-toggle="popover" title="Detail" 
                            data-content="
                                <table class='table'>
                                    <tr><td>SubKategori</td> <td>: &nbsp <?=$row['SubKategori_Name']?></td></tr>
                                    <tr><td>Merk</td> <td>: &nbsp <?=$row['Merk_Name']?></td></tr>
                                    <tr><td>Model</td> <td>: &nbsp <?=$row['Model_Name']?></td></tr>
                                </table>
                                "
                            
                            ><i class="glyphicon glyphicon-transfer"></i>
                         </button>
                        </td>
                        <td class="nr"><?php echo number_format($row['Harga_Beli']);?></td>
                        <td class="nr"><?php echo number_format($row['Harga_Jual']);?></td>
                        <td class="nr"><?=$row['Qty']?></td>
                        <td class="nr"><?=$row['Limit']?></td>
                        <td  >
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