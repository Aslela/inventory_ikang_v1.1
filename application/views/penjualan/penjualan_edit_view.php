<?php $this->load->helper('HTML');
echo link_tag('css/form-transaction.css');
echo link_tag('css/chosen.css');
echo link_tag('css/datepicker.css');
echo link_tag('css/select2.css');
?>
<script src="<?php echo base_url(); ?>js/jquery.maskMoney.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/validate/insert-barang-validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-editable.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/penjualan.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        var $selected_row;
        $(window).load(function() {
            var option = <?=$data_penjualan_header->Status?>;
            $(".hutang").hide();
            if(option!=1){
                $(".hutang").show();
                $("#harga_htg").val('<?=$data_penjualan_header->Harga_Hutang?>');
                $("#tgl_jth_tmp").val('<?=$data_penjualan_header->Tgl_Jatuh_Tempo?>');
            }
            $('#stat option[value='+option+']').attr('selected','selected');
        });

        //set jquery datepicker
        $('#tgl_penjualan').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#tgl_jth_tmp').datepicker({
            dateFormat: "yy-mm-dd"
        });

        $('#tgl_penjualan').datepicker()
            .on('changeDate', function(ev){
                $('#tgl_penjualan').datepicker('hide');
            });

        $('#tgl_jth_tmp').datepicker()
            .on('changeDate', function(ev){
                $('#tgl_jth_tmp').datepicker('hide');
            });

        //show hide status hutang
        $( ".status" ).change(function() {
            var value = $( "#stat" ).val();
            if(value=='1'){
                $(".hutang").hide();
            }else{
                $(".hutang").show();
            }
        });

        $.fn.editable.defaults.mode = 'inline';
        $('#discount').editable({
            type: 'number',
            title : 'Enter New Value',
            display: function(value) {
                // set Total-discount
                var old_discount =  parseInt($(this).attr("data-value"));
                var discount  = parseInt(value);
                var result = 0-(discount-old_discount);
                //alert(result);
                countResult(result);

                // set Discount value
                $(this).attr("data-value",value);
                var k = discount.format(0, 3, '.', ',');
                $(this).text(k);
            }
        });
    });
</script>
<style>
    .modal
    {
        overflow: hidden;
    }
    .modal-dialog{
        margin:auto;
        left: 0;
    }
    #container-result{
        margin-bottom: 40px;
    }
    #total-result{
        color: #5978ff;
        font-weight: 800;
    }
    #dicount{
        color:#FE1A00;
    }
    #total-result, #dicount{
        font-size: 22px;
    }
    .frmSearch {
        border: 1px solid #428BCC;
        background-color:#C8EEFD;
        margin: 2px 0px;}
    .suggesstion-box{
        position:relative;
    }
    .barang-list{
        float:left;
        list-style:none;
        margin:0;padding:0;
        width:100%;
        position: absolute;
        border: 1px solid black;
    }
    .barang-list li{
        padding: 8px;
        background:#FAFAFA;
        border-bottom:#F0F0F0 1px solid;
    }
    .barang-list li:hover{
        background:#C8EEFD;
        cursor: pointer
    }
    .search-box{
        padding: 5px;
        border: #428BCC 1px solid;
        width:100%;
    }
    .label{
        font-size: 12px;
    }
    .tr-cancel td{
        color:#d2322d;
        font-weight: bold;
    }
</style>

<div class="content-container" >

    <!--Error Container-->
    <div class="error-container hidden" id="error-msg">
        <div class="btn-closed">
            <button type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
        </div>

        <div class="error-box">
            <!--Error Messages here-->
        </div>
    </div>

    <div class="form-add-new">
        <!-- general form elements -->
        <div class="box box-primary">

            <!-- form start -->

            <h3 class="">
                Penjualan Edit
            </h3>
            <div class="well well-sm">
                <button type="button" class="btn btn-primary" id="hd-btn-save">
                    <span class="glyphicon glyphicon-floppy-save"></span>&nbsp Save
                </button>
                <a href="<?=site_url('Penjualan/index')?>">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp Back to List
                    </button>
                </a>
            </div>

            <?php echo form_open('',"class='form-horizontal'"); ?>

            <div class="side-one"><!-- side 1 -->
                <div class="form-group" id="lbl-kode">
                    <label class="col-sm-3 control-label heading-label">Kode BON</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_bon" name="kode_bon"
                               placeholder="Kode BON" maxlength="15" value="<?=$data_penjualan_header->Kode_Bon?>">
                    </div><span id='err_kode' class="err_span"></span><span id='pesan_kode'></span>
                </div>

                <div class="form-group" id="lbl-customer">
                    <label class="col-sm-3 control-label heading-label">Nama Pembeli</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                               placeholder="Nama Pembeli" maxlength="150" value="<?=$data_penjualan_header->Nama_Pembeli?>">
                    </div><span id='err_nama' class="err_span"></span>
                </div>

                <div class="form-group" id="lbl-tgl-beli">
                    <label class="col-sm-3 control-label heading-label">Tanggal Penjualan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_penjualan" name="tgl_penjualan"
                               placeholder="MM/dd/YYYY" maxlength="150" value="<?=$data_penjualan_header->Tgl_Penjualan?>">
                    </div><span id='err_nama' class="err_span"></span>
                </div>

            </div><!-- side 1 -->

            <div class="side-two"><!-- side 2 -->
                <div class="form-group">
                    <label class="col-sm-3 control-label heading-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-control status" id="stat" name="stat">
                            <option value="1">CASH</option>
                            <option value="2">LUNAS</option>
                            <option value="3">HUTANG</option>
                        </select>
                    </div>
                </div>

                <div class="form-group hutang">
                    <label class="col-sm-3 control-label heading-label">Harga Hutang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_htg" name="harga_htg"
                               placeholder="xxx" maxlength="150">
                    </div>
                </div>

                <div class="form-group hutang" id="lbl-tgl-beli">
                    <label class="col-sm-3 control-label heading-label">Tanggal Jatuh Tempo</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_jth_tmp" name="tgl_jth_tmp"
                               placeholder="MM/dd/YYYY" maxlength="150">
                    </div><span id='err_nama' class="err_span"></span>
                </div>

            </div>
            <?php echo form_close(); ?>

            <div class="clear"></div>

            <table class="table table-bordered table-striped" id="tbl-detail">
                <thead>
                    <tr>
                        <th style = "text-align:left;">Kode Barang</th>
                        <th style = "text-align:left;">Nama Barang</th>
                        <th style = "text-align:right;">Harga Jual Current </th>
                        <th style = "text-align:right;">Qty</th>
                        <th style = "text-align:right;">Harga Jual</th>
                        <th style = "text-align:right;">Harga Total</th>
                        <th style = "text-align:center;">Option</th>
                    </tr>
                </thead>

                <tbody id="detail-content">
                    <?php foreach($data_penjualan_detail as $row){?>
                        <tr data-id="<?=$row['Penjualan_Detail_ID']?>"
                            <?php if($row['status']==2){?>class="tr-cancel"<?php } ?>
                        >
                            <td class="kode-barang"><?=$row['Kode_Barang']?></td>
                            <td class="nama-barang"><?=$row['Barang_Name']?></td>
                            <td class="td-right"><?=$row['Harga_Jual_Normal']?></td>
                            <td class="td-right"><?=$row['Qty']?></td>
                            <td class="td-right"><?=$row['Harga_Jual']?></td>
                            <td class="td-right"><?=$row['Harga_Total']?></td>
                            <td class="td-center">

                            </td>
                            <input type="hidden" class="alasan-cancel-hidden"
                                   <?php if($row['status']==2){?>value="<?=$row['alasan']?>"<?php } ?>
                            >

                        </tr>
                    <?php } ?>
                </tbody>

            </table>

            <div id="container-result">
                <div class="row">
                    <div class="col-lg-5 float-right td-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default btn-lg" aria-label="Bold">
                                    <span class="glyphicon glyphicon-gift"></span> Discount
                                </button>
                            </div>
                            <span class="form-control"><a href="#" id="discount" data-value="<?=$data_penjualan_header->Discount?>"><?=$data_penjualan_header->Discount?></a></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 float-right td-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default btn-lg" aria-label="Bold">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Total
                                    &nbsp&nbsp&nbsp&nbsp&nbsp
                                </button>
                            </div>
                            <span class="form-control" id="total-result" data-value="<?=$data_penjualan_header->Harga_Total?>"><?=$data_penjualan_header->Harga_Total?></span>
                        </div>
                    </div>
                </div>
            </div><!-- div Container-result -->
        </div>
    </div><!-- div form-add-new -->


</div><!-- div container -->

<script>
    $(function(){
        var data_cancel_penjualan = [];

        $('#hd-btn-save').click(function(){
            if(validatePenjualanEdit()){
                var penjualan_id = <?=$data_penjualan_header->Penjualan_ID?>;
                var header_data_penjualan = new Object();
                header_data_penjualan.kode = $("#kode_bon").val(); ;
                header_data_penjualan.customer  = $("#nama_customer").val();
                header_data_penjualan.tgl_penjualan = $("#tgl_penjualan").val();
                header_data_penjualan.status = $('#stat option:selected').val();
                header_data_penjualan.discount = $("a#discount").attr("data-value");
                header_data_penjualan.harga_total = $('span#total-result').attr("data-value");
                if(status!=1){
                    header_data_penjualan.tgl_jth_tempo =$("#tgl_jth_tmp").val();
                    header_data_penjualan.harga_hutang =$("#harga_htg").val();
                }else{
                    header_data_penjualan.tgl_jth_tempo =null;
                    header_data_penjualan.harga_hutang =null;
                }
                var data_penjualan = new Array();
                data_penjualan.push(header_data_penjualan);

                var data_post = {
                    data :data_penjualan
                }
                //alert(JSON.stringify(data_penjualan));
                // ajax mulai disini
                $.ajax({
                    url: base_url+"index.php/penjualan/editPenjualan/"+penjualan_id,
                    data: data_post,
                    type: "POST",
                    dataType: 'json',
                    success: function(msg){
                        if(msg.status=='error'){
                            alertify.error(msg.msg);
                        }else{
                            alertify.success(msg.msg);
                            location.href = "<?= site_url("penjualan")?>";
                        }
                    },
                    error:function(msg){
                        alertify.error('Failed to response server!');
                    }
                });
            }

        });
    });
</script>