 <?php $this->load->helper('HTML');
?>
<style>
    .cd-error-message{
        font-size:12px;
        visibility: hidden;
    }
</style>
 <?php $this->load->view('modal/modal_add_edit_kategori')?>

<script type="text/javascript">
    
     $(function() {
        $(document).on('click',"ul.pagination li a",function(e){
            var url = $(this).attr("href");     
            $.ajax({
              type: "POST",
              data: "ajax=1",
              url: url,
              beforeSend: function() {
                $("#content-container").html("");
              },
              success: function(msg) {
                $("#content-container").html(msg);
                //applyPagination();
              }
            });
            e.preventDefault();
            return false;
        });
        
        $("#search-btn").click(function(){

        });

         $("#add-btn").click(function(){
             $('#kategori-form')[0].reset();
             $('#created').empty();
             $('#last_modified').empty();
             $('.modal-title').text("Add New Kategori");
             $('#btn-update').hide();
             $('#btn-save').show();
             $('.cd-error-message').css("visibility","hidden");
         });

         $(".edit-btn").click(function(){
             $('#kategori-form')[0].reset();
             $('.modal-title').text("Edit Kategori");
             $('#btn-save').hide();
             $('#btn-update').show();
             $('.cd-error-message').css("visibility","hidden");

             var $row =  $(this).closest("tr");
             var text = $row.find(".nr").text();
             var id_item = $row.find(".id-item").text();
             var created = $row.find(".created").text();
             var last_modified = $row.find(".last-modified").text();

             $('#inputan').val(text);
             $('#item_id').val(id_item);

             $('#created').empty();
             $('#created').append("Created : "+"<b>"+created+"</b>");
             $('#last_modified').empty();
             $('#last_modified').append("Last Modified : "+"<b>"+last_modified+"</b>");

         });
        
    }); 
</script>

<div class="content-container" id="content-container" >
    <div class="well">
        <div class="row">
            <div class="col-lg-8">
                <button type="button" class="btn btn-primary btn-xl" id="add-btn" data-toggle="modal" data-target="#kategori-modal">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp Add Kategori
                </button>
            </div>
            <div class="col-lg-4" id="search-box">
                <?php echo form_open('kategori/searchKategori'); ?>
                <div class="input-group">
                    <input type="text" class="form-control" name="search-text" value="<?=$search_text?>" id="search-text" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="search-btn" class="btn btn-default" type="submit">Search!</button>
                    </span>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="input-group">
          
        </div><!-- /input-group -->
    </div>
    
    <div class="data-content">
    <table  class="table table-bordered table-striped tbl-master">
        <thead>
        <tr>
            <th style = "text-align:center;">No</th>
            <th style = "text-align:center;">Nama Kategori</th>
            <th style = "text-align:center;">Option</th>
        </tr>
        </thead>
        
        <tbody>
            <?php
                foreach ($data as $row){
                    $no++;
            ?>
                    <tr>
                        <td align='center' class="no"><?=$no?></td>
                        <td align='center' class="nr"><?=$row['Kategori_Name']?></td>
                        <td align='center'>
                            <a class="edit-nav" href="#<?php echo $no?>">           
                                <button type="button" class="btn btn-primary btn-xs edit-btn" data-toggle="modal" data-target="#kategori-modal">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>      
                            </a>    
                           	<a class="btn btn-danger btn-xs " href="<?php echo site_url('kategori/deleteKategori/'.$row['Kategori_ID'])?>" 
                               onclick="return confirm('Are you sure to delete <?=$row['Kategori_Name']?> ?');">
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
            
        </tbody>
    </table>
    <?=$pages?>
    </div>
</div>
 <script src="<?php echo base_url(); ?>js/validate/insert-master-validate.js" type="text/javascript"></script>