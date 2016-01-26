
<?php $this->load->view('modal/modal_add_edit_supplier')?>
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

        $("#add-btn").click(function(){
            $('#supplier-form')[0].reset();
            $('#created').empty();
            $('#last_modified').empty();
            $('.modal-title').text("Add New Supplier");
            $('#btn-update').hide();
            $('#btn-save').show();
            $('.cd-error-message').css("visibility","hidden");
        });

        $(".edit-btn").click(function(){
            $('#supplier-form')[0].reset();
            $('.modal-title').text("Edit Supplier");
            $('#btn-save').hide();
            $('#btn-update').show();
            $('.cd-error-message').css("visibility","hidden");

            var $row =  $(this).closest("tr");
            var text = $row.find(".nr").text();
            var desc = $row.find(".dr").text();
            var id_item = $row.find(".id-item").text();
            var created = $row.find(".created").text();
            var last_modified = $row.find(".last-modified").text();

            $('#supplier-name').val(text);
            $('#supplier-desc').val(desc);
            $('#item_id').val(id_item);

            $('#created').empty();
            $('#created').append("Created : "+"<b>"+created+"</b>");
            $('#last_modified').empty();
            $('#last_modified').append("Last Modified : "+"<b>"+last_modified+"</b>");

        });

    });
</script>
<div class="content-container" >
    <div class="well">
        <div class="row">
            <div class="col-lg-8">
                <button type="button" class="btn btn-primary btn-xl" id="add-btn" data-toggle="modal" data-target="#supplier-modal">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp Add Supplier
                </button>
            </div>
            <div class="col-lg-4" id="search-box">
                <?php echo form_open('supplier/searchSupplier'); ?>
                <div class="input-group">
                    <input type="text" class="form-control" name="search-text" value="<?=$search_text?>" id="search-text" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="search-btn" class="btn btn-default" type="submit">Search!</button>
                    </span>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div>
        <table  class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style = "text-align:center">No</th>
                <th style = "text-align:center">Nama Supplier</th>
                <th style = "text-align:center">Deskripsi</th>
                <th style = "text-align:center">Option</th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($data as $row){
                $no++;
                ?>
                <tr>
                    <td align='center' class="no"><?=$no?></td>
                    <td align='center' class="nr"><?=$row['Supplier_Name']?></td>
                    <td align='center' class="dr"><?=$row['Supplier_Desc']?></td>
                    <td align='center'>
                        <a class="edit-nav" href="#<?php echo $no?>">
                            <button type="button" class="btn btn-primary btn-xs edit-btn" data-toggle="modal" data-target="#supplier-modal">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>
                        </a>
                        <a class="btn btn-danger btn-xs " href="<?php echo site_url('merk/deleteMerk/'.$row['Supplier_ID'])?>"
                           onclick="return confirm('Are you sure to delete <?=$row['Supplier_Name']?> ?');">
                            <i class="glyphicon glyphicon-trash"></i>&nbsp Delete
                        </a>
                    </td>

                    <td class="id-item" style="display: none;"><?=$row['Supplier_ID']?></td>
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
<script type="text/javascript">
    $(function() {
        function cek_input(){
            var error = 0;
            var name = $("#supplier-name").val();
            var desc = $("#supplier-desc").val();

            if(name==""){
                $('.cd-error-name').css("visibility","visible");
                $('.cd-error-name').css("opacity","1");
                error++;
            }else{
                $('.cd-error-name').css("visibility","hidden");
                $('.cd-error-name').css("opacity","0");
            }
            if(desc==""){
                $('.cd-error-desc').css("visibility","visible");
                $('.cd-error-desc').css("opacity","1");
                error++;
            }else{
                $('.cd-error-desc').css("visibility","hidden");
                $('.cd-error-desc').css("opacity","0");
            }

            if(error > 0){
                return false;
            }else{
                return true;
            }
        }

        $("#btn-save").click(function(){
            if(cek_input()){
                var data_post = {
                    name: $("#supplier-name").val(),
                    desc: $("#supplier-desc").val()
                };
                var base_url = $("#base_url").val();
                var url_path =  base_url.concat("index.php/Supplier/createSupplier");

                // ajax mulai disini
                $.ajax({
                    url: url_path, //arahkan pada proses_tambah di controller nasabah
                    data: data_post,
                    type: "POST",
                    success: function(msg){
                        if(msg==0){
                            $(".isi_pesan").css({"color":"#fc5d32","font-size":"10px"});
                            $(".isi_pesan").html("Proses Daftar Gagal...");
                            $(".isi_pesan").fadeIn(1000);
                            alertify.error('Add Master Gagal');
                        }else{
                            $(".isi_pesan").css("color","#59c113");
                            $(".isi_pesan").html("Proses Daftar Berhasil...");
                            $(".isi_pesan").fadeIn(1000);

                            // hapus data
                            $("#inputan").val("");
                            alertify.success('Add Master Sukses');
                            //window.location.assign(base_url+"/index.php/"+modul+"/index/");
                            window.location.reload();
                        }
                    },
                    error:function(msg){
                        alertify.error('Failed to response server!');
                    }
                });
            }

            return false;

        });

        $("#btn-update").click(function(){

            if(cek_input()){

                var data_post = {
                    name: $("#supplier-name").val(),
                    desc: $("#supplier-desc").val()
                };

                var id_item = $("#item_id").val();
                var base_url = $("#base_url").val();
                var url_path =  base_url.concat("index.php/Supplier/editSupplier/",id_item);

                // ajax mulai disini
                $.ajax({
                    url: url_path, //arahkan pada proses_tambah di controller nasabah
                    data: data_post,
                    type: "POST",
                    success: function(msg){
                        if(msg==0){
                            $(".isi_pesan").css({"color":"#fc5d32","font-size":"10px"});
                            $(".isi_pesan").html("Proses Daftar Gagal...");
                            $(".isi_pesan").fadeIn(1000);
                            alertify.error("Edit Master Gagal");
                        }else{
                            $(".isi_pesan").css("color","#59c113");
                            $(".isi_pesan").html("Proses Daftar Berhasil...");
                            $(".isi_pesan").fadeIn(1000);

                            // hapus data
                            $("#inputan_edit").val("");
                            alertify.success("Edit Master Sukses");
                            //window.location.assign(base_url+"/index.php/"+modul+"/index/");
                            window.location.reload();
                        }
                    },
                    error:function(msg){
                        alertify.error('Failed to response server!');
                    }
                });
            }

            return false;

        });
    });
</script>