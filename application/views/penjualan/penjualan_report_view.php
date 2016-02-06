<?php $this->load->helper('HTML');
// Bootstrap Core CSS
echo link_tag('css/morris.css');
?>
<script src="<?php echo base_url();?>js/morris.min.js"></script>
<script src="<?php echo base_url();?>js/raphael.min.js"></script>

<style>
    .btn-float-right{
        float: right;
    }
</style>

<div class="content-container" >
    <div class="well">
        <button type="button" class="btn btn-default btn-xl" id="show-table">
            <span class="glyphicon glyphicon-th-list"></span>&nbsp Table
        </button>
        <button type="button" class="btn btn-default btn-xl" id="show-graph">
            <span class="glyphicon glyphicon-stats"></span>&nbsp Graph
        </button>
        <button type="button" class="btn btn-default btn-xl btn-float-right">
            <span class="glyphicon glyphicon-calendar"></span>&nbsp Year
        </button>
        <button type="button" class="btn btn-default btn-xl btn-float-right" id="btn-modal-month">
            <span class="glyphicon glyphicon-calendar"></span>&nbsp Month
        </button>
        <button type="button" class="btn btn-default btn-xl btn-float-right" id="btn-modal-day">
            <span class="glyphicon glyphicon-calendar"></span>&nbsp Day
        </button>
    </div>

    <div id="tbl-content">
        <table  class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th style = "text-align:center;font-weight: bold;">NO</th>
                <th style = "font-weight: bold;">Tanggal Penjualan</th>
                <th align='right' style = "font-weight: bold; text-align:right;">Total</th>
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
                    <td align='left' class="nr" ><?=$row['Tgl_Penjualan']?></td>
                    <td align='right' class="nr" ><?php echo number_format($row['Harga_Total'])?></td>

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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="option-report-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" id="month-modal">
                        <label for="recipient-name" class="control-label">Month:</label>
                        <select class="form-control">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Year:</label>
                        <select class="form-control">
                            <?php
                                $year = date("Y");
                                for($i=1; $i<= 10; $i++){
                                    $print_year = $year-$i;
                                    echo "<option value=".$print_year.">".$print_year."</option>";
                            ?>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">GO</button>
            </div>
        </div>
    </div>
</div>

<script>

    //
    $('#show-table').click(function(){
        $('#tbl-content').show();
        $('#line-chart').hide();
    });

    var data_graph = <?=json_encode($data);?>;
    var json_data = JSON.stringify(data_graph);

    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart',
        behaveLikeLine: true,
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: data_graph,
        // The name of the data record attribute that contains x-values.
        xkey: 'Tgl_Penjualan',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['Harga_Total'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Tgl_Penjualan','Harga_Total']
    });
    $('#line-chart').hide();

    $('#show-graph').click(function(){
        $('#tbl-content').hide();
        //$('#line-chart').html("");
        $('#line-chart').show();
    });

    $('#btn-modal-day').click(function(){
        $('#month-modal').show();
        $('#option-report-modal').modal('show');
    });

    $('#btn-modal-month').click(function(){
        $('#month-modal').hide();
        $('#option-report-modal').modal('show');
    });



</script>