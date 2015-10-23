<script src="<?php echo base_url(); ?>js/validate/insert-master-validate.js" type="text/javascript"></script>	

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Add Satuan</a></li>
            <li><a href="#0"></a></li>
        </ul>

    <div id="cd-login"> <!-- log in form -->
        <form class="cd-form" method="post" action="">
            <p class="fieldset">
                <label class="image-replace cd-name" >Satuan Name </label>
                <input class="full-width has-padding has-border" 
                    id="inputan" type="text" name="satuan_name" 
                    placeholder="Name" onkeyup='cek_input()'>
                <span class="cd-error-message">Nama harus di isi!</span>
            </p>
            
            <p class="fieldset">
                <button class="full-width cd-btn-save btn btn-primary" id="save" >Save</button>
            </p>
             <input type="hidden" id="modul_name" value="Satuan"/>
        </form>
                    
    <!-- <a href="#0" class="cd-close-form">Close</a> -->
    </div> <!-- cd-login -->

    <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->