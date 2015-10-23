<html>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>

    <!-- Login style --> 
    <?php $this->load->helper('HTML');	
	    echo link_tag('css/reset.css');
        echo link_tag('css/login.css');	  			 
	?>

<body>

			<div id="cd-login"> <!-- log in form -->
				<div id="cd-container-form">
                 <?php echo form_open('login/validate_login',"class='cd-form'") ?>
					<p class="fieldset">
						<label class="image-replace cd-username" for="signin-email">UserName</label>
						<input class="full-width has-padding has-border" id="signin-email" type="text" name="username" placeholder="UserName">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" type="password" name="password"  placeholder="Password">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width" type="submit" value="Login">
					</p>
				<?php echo form_close() ?>
				
                </div>
			</div> <!-- cd-login -->

<script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>    

</body>  
</html>