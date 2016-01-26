
   function cek_input(){
       var error = 1;
        var inputan = $("#inputan").val();
        	 
        if(inputan==""){
            $('.cd-error-message').css("visibility","visible");
            $('.cd-error-message').css("opacity","1");
            error = 1;
        }else{
            $('.cd-error-message').css("visibility","hidden");
            $('.cd-error-message').css("opacity","0"); 
            error = 0;
        }

       if(error > 0){
           return false;
       }else{
           return true;
       }
    }
    
   function cek_input_edit(){
		
        var inputan = $("#inputan_edit").val();
        	 
        if(inputan==""){
            $('.cd-error-message').css("visibility","visible");
            $('.cd-error-message').css("opacity","1");
            error = 1;
        }else{
            $('.cd-error-message').css("visibility","hidden");
            $('.cd-error-message').css("opacity","0"); 
            error = 0;
        }
    }

$(document).ready(function(){
        $("#btn-save").click(function(){
            if(cek_input()){

                var data_post = {
                    input_value: $("#inputan").val()
                };
                var modul = $("#modul_name").val();
                var function_name = "create"+modul;
                var base_url = $("#base_url").val();
                var url_path =  base_url.concat("index.php/",modul,"/",function_name);

                $("#btn-save").attr('disabled','disabled');
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
                            $("#btn-save").removeAttr('disabled');
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
                        $("#btn-save").removeAttr('disabled');
                    }
                });
            }

            return false;

        });
            
        $("#btn-update").click(function(){

            if(cek_input()){
							
                var data_post = {
                    input_value: $("#inputan").val()
                };

                var modul = $("#modul_name").val();
                var function_name = "edit"+modul;
                var id_item = $("#item_id").val();
                var base_url = $("#base_url").val();
                var url_path =  base_url.concat("index.php/",modul,"/",function_name,"/",id_item);
                $("#btn-update").attr('disabled','disabled');

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
                            $("#btn-update").removeAttr('disabled');
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
                        $("#btn-update").removeAttr('disabled');
                    }
                });
            }

            return false;
				 
        });            
            
});