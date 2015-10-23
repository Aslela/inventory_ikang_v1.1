<script>  
    $(document).ready(function(){
        $(".edit-btn").click(function(){
            var $row =  $(this).closest("tr");
            var text = $row.find(".nr").text();
            var id_item = $row.find(".id-item").text();
            var created = $row.find(".created").text();
            var last_modified = $row.find(".last-modified").text();
            
            $('.inputan').val(text);
            $('#item_id').val(id_item);

            $('#created').empty();
            $('#created').append("Created : "+created);
            $('#last_modified').empty();
            $('#last_modified').append("Last Modified : "+last_modified);
            
        });
    });
</script>
<div class="cd-edit-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-edit-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Edit Merk</a></li>
            <li><a href="#0"></a></li>
        </ul>
    
    <div id="cd-login"> <!-- log in form -->
        <form class="cd-form" method="post" action="">
            <p class="fieldset">
                <label class="image-replace cd-name" >Merk Name </label>
                <input class="full-width has-padding has-border inputan" 
                    id='inputan_edit' type="text" name="merk_name" 
                    placeholder="Name" onkeyup='cek_input_edit()'>
                <span class="cd-error-message">Nama harus di isi!</span>
            </p>
            
            <p class="fieldset">
                <button class="full-width cd-btn-save btn btn-primary" id="edit" >Edit</button>
            </p>
            
            <p id="created"></p>
            <p id="last_modified"></p>
            <input type="hidden" id="item_id" />
        </form>
                    
    <!-- <a href="#0" class="cd-close-form">Close</a> -->
    </div> <!-- cd-login -->

    <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->