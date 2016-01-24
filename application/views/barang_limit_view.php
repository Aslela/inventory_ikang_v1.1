<?php $this->load->helper('HTML');
echo link_tag('css/form-transaction.css');
?>
<table class="table table-bordered table-striped" id="tbl-detail">
    <thead>
    <tr>
        <th style = "text-align:left;">Kode Barang</th>
        <th style = "text-align:left;">Nama Barang</th>
        <th style = "text-align:right;">Qty</th>
        <th style = "text-align:right;">Limit</th>
    </tr>
    </thead>

    <tbody id="detail-content">
    <?php foreach($data_barang as $row){?>
        <tr>
            <td><?=$row['Kode_Barang']?></td>
            <td><?=$row['Barang_Name']?></td>
            <td class="td-right"><?=$row['Qty']?></td>
            <td class="td-right"><?=$row['Limit']?></td>
        </tr>
    <?php } ?>
    </tbody>

</table>