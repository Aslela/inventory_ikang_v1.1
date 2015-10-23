
var base_url = $("#site_url").val();

if(base_url =="http://localhost"){
    base_url = base_url+"/inv_ikang";
}
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

                // ajax mulai disini
                $.ajax({
                    url: base_url+"/"+modul+"/"+function_name, //arahkan pada proses_tambah di controller nasabah
                    data: data_post,
                    type: "POST",
                    success: function(msg){
                        if(msg==0){
                            $(".isi_pesan").css({"color":"#fc5d32","font-size":"10px"});
                            $(".isi_pesan").html("Proses Daftar Gagal...");
                            $(".isi_pesan").fadeIn(1000);
                            alert("Add Master Gagal");
                        }else{
                            $(".isi_pesan").css("color","#59c113");
                            $(".isi_pesan").html("Proses Daftar Berhasil...");
                            $(".isi_pesan").fadeIn(1000);

                            // hapus data
                            $("#inputan").val("");
                            alert("Add Master Sukses");
                            //window.location.assign(base_url+"/index.php/"+modul+"/index/");
                            window.location.reload();
                        }
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

                // ajax mulai disini
                $.ajax({
                    url: base_url+"/"+modul+"/"+function_name+"/"+id_item, //arahkan pada proses_tambah di controller nasabah
                    data: data_post,
                    type: "POST",
                    success: function(msg){
                        if(msg==0){
                            $(".isi_pesan").css({"color":"#fc5d32","font-size":"10px"});
                            $(".isi_pesan").html("Proses Daftar Gagal...");
                            $(".isi_pesan").fadeIn(1000);
                            alert("Edit Master Gagal");
                        }else{
                            $(".isi_pesan").css("color","#59c113");
                            $(".isi_pesan").html("Proses Daftar Berhasil...");
                            $(".isi_pesan").fadeIn(1000);

                            // hapus data
                            $("#inputan_edit").val("");
                            alert("Edit Master Sukses");
                            //window.location.assign(base_url+"/index.php/"+modul+"/index/");
                            window.location.reload();
                        }
                    }
                });
            }

            return false;
				 
        });            
            
});