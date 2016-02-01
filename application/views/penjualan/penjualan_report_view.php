<?php $this->load->helper('HTML');
// Bootstrap Core CSS
echo link_tag('css/morris.css');
?>
<script src="<?php echo base_url();?>js/morris.min.js"></script>
<script src="<?php echo base_url();?>js/raphael.min.js"></script>

<div class="content-container" >
    <div class="well">
        <button type="button" class="btn btn-default btn-xl" id="show-table">
            <span class="glyphicon glyphicon-th-list"></span>&nbsp Table
        </button>
        <button type="button" class="btn btn-default btn-xl" id="show-graph">
            <span class="glyphicon glyphicon-stats"></span>&nbsp Graph
        </button>
    </div>

    <div id="tbl-content">
        <table  class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th style = "text-align:center;font-weight: bold;">NO</th>
                <th style = "font-weight: bold;">Kode Bon</th>
                <th style = "font-weight: bold;">Tanggal Penjualan</th>
                <th style = "font-weight: bold;">Pembeli</th>
                <th align='right' style = "font-weight: bold; text-align:right;">Harga</th>
                <th style = "font-weight: bold; ">Status</th>
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
                    <td align='right' class="nr" ><?php echo number_format($row['Harga_Total'])?></td>
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

    <div id="line-chart" style="height: 250px;"></div>

</div>

<script>

    $('#show-table').click(function(){
        $('#tbl-content').show();
        $('#line-chart').hide();
    });

    $('#show-graph').click(function(){
        $('#tbl-content').hide();
        $('#line-chart').html("");
        $('#line-chart').show();

        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'line-chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                { year: '2008', value: 20 },
                { year: '2009', value: 10 },
                { year: '2010', value: 5 },
                { year: '2011', value: 5 },
                { year: '2012', value: 20 }
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    });

</script>