<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Header style --> 
    <?php $this->load->helper('HTML');	
        echo link_tag('css/bootstrap.css');
        echo link_tag('css/reset.css');
        echo link_tag('css/style.css');
        echo link_tag('css/nav-left-bar.css'); 
        echo link_tag('css/modal.css');
        
	?>
    <script src="<?php echo base_url(); ?>js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" type="text/javascript"></script>	
    

    <title>Inventory Ikang</title>
</head>
<body>
	<header>
		<a id="cd-menu-trigger" href="#0"><span class="cd-menu-text">Menu</span><span class="cd-menu-icon"></span></a>
		<nav id="cd-top-nav">
			<ul>
				<li><a href="#0">Tour</a></li>
				<li><a href="#0">Login</a></li>
			</ul>
		</nav>
	</header>
    
	<main class="cd-main-content">
		<!-- put your content here -->
        <?php $this->load->view($main_content,$data); ?>
	</main> <!-- cd-main-content -->

	<nav id="cd-lateral-nav">
		<ul class="cd-navigation">
			<li class="item-has-children">
				<a href="#0">Master</a>
				<ul class="sub-menu">
					<li><a href="<?php echo site_url('kategori')?>">Kategori</a></li>
					<li><a href="<?php echo site_url('subkategori')?>">Sub Kategori</a></li>
					<li><a href="<?php echo site_url('merk')?>">Merk</a></li>
                    <li><a href="<?php echo site_url('modelx')?>">Model</a></li>
                    <li><a href="<?php echo site_url('satuan')?>">Satuan</a></li>
				</ul>
			</li> <!-- item-has-children -->

			<li class="item-has-children">
				<a href="#0">Transaction</a>
				<ul class="sub-menu">
   	                <li><a href="<?php echo site_url('barang')?>">List Barang</a></li>
					<li><a href="<?php echo site_url('barang/goToAddNewBarang')?>">Add New Barang</a></li>
					<li><a href="#0">Add Stock Barang</a></li>
					<li><a href="#0">Product 4</a></li>
					<li><a href="#0">Product 5</a></li>
				</ul>
			</li> <!-- item-has-children -->

			<li class="item-has-children">
				<a href="">Penjualan</a>
				<ul class="sub-menu">
					<li><a href="<?php echo site_url('penjualan')?>">List Penjualan</a></li>
					<li><a href="#0">New York</a></li>
					<li><a href="#0">Milan</a></li>
					<li><a href="#0">Paris</a></li>
				</ul>
			</li> <!-- item-has-children -->
		</ul> <!-- cd-navigation -->

		<ul class="cd-navigation cd-single-item-wrapper">
			<li><a href="#0">Tour</a></li>
			<li><?php echo anchor('login/logout', 'Logout'); ?></li>
			<li><a href="#0">Register</a></li>
		</ul> <!-- cd-single-item-wrapper -->

	</nav>

<script src="<?php echo base_url(); ?>js/modal.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>js/nav-left-bar.js" type="text/javascript"></script>    
</body>
</html>