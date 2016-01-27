<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory Ikang - CMS Panel</title>

    <?php $this->load->helper('HTML');
        // Bootstrap Core CSS
        echo link_tag('css/bootstrap.min.css');
        echo link_tag('css/bootstrap-editable.css');

        echo link_tag('css/jquery-ui.min.css');
        //DataTables CSS
        echo link_tag('css/sb-admin-2.css');

        //Custom Fonts
        echo link_tag('css/font-awesome.min.css');

        //Alert
        echo link_tag('css/alert/alertify.core.css');
        echo link_tag('css/alert/alertify.default.css');

    ?>
    
    <style>
        /*Pagination*/
        ul.pagination li.active a{
            pointer-events:none;
        }
        .content-container{
            padding-top: 1px;
            padding-bottom: 50px;
        }
    </style>
    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

   <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.js"></script>

    <!-- Alert -->
    <script src="<?php echo base_url(); ?>css/alert/alertify.min.js"></script>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url("home_cms/index") ?>">CMS Panel</a>
            <a class="navbar-brand"><button type="button" id="menu-toggle-btn" class="btn btn-primary btn-sm">Show/Hide Menu</button></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?= site_url('user/profileDetail')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>-->
                    <li class="divider"></li>
                    <li><a href="<?= site_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="#"><i class="fa fa-th fa-fw"></i> Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?= site_url("kategori") ?>">Kategori</a>
                            </li>
                            <li>
                                <a href="<?= site_url("subkategori") ?>">Sub Kategori</a>
                            </li>
                            <li>
                                <a href="<?= site_url("merk") ?>">Merk</a>
                            </li>
                            <li>
                                <a href="<?= site_url("modelx") ?>">Model</a>
                            </li>
                            <li>
                                <a href="<?= site_url("satuan") ?>">Satuan</a>
                            </li>
                            <li>
                                <a href="<?= site_url("supplier") ?>">Supplier</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-gear fa-fw"></i> Barang<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?= site_url("barang") ?>">Daftar Barang</a>
                            </li>
                            <li>
                                <a href="<?= site_url("barang/goToAddNewBarang") ?>">Tambah Barang Baru</a>
                            </li>
                            <li>
                                <a href="<?= site_url("barang/goToAddStockBarang") ?>">Tambah Stock Barang</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Penjualan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?= site_url("penjualan") ?>">Daftar Penjualan</a>
                            </li>
                            <li>
                                <a href="<?= site_url("penjualan/goToAddNewPenjualan") ?>">Penjualan Baru</a>
                            </li>
                            <li>
                                <a href="<?= site_url("barangde j") ?>">Cancel Penjualan</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <input type="hidden" id="base_url" value="<?=base_url()?>"/>
        <?php $this->load->view($main_content); ?>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>js/metisMenu.min.js"></script>

<!-- Jquery UI Plugin JavaScript -->
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>js/sb-admin-2.js"></script>

<script>
    $(document).ready(function() {
        var show = 1;
       $("#menu-toggle-btn").click(function(){
           $(".sidebar").toggle();
           if(show == 1) {
               $("#page-wrapper").css("margin-left", "0");
               show=0;
           }else{
               $("#page-wrapper").css("margin-left", "250px");
               show=1;
           }
       });
        var base_url = $("#base_url").val();
        //alert($("#base_url").val());
    });
</script>

</body>

</html>