var error = 1;
   
   function validate_number(evt) {
        var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 39 || key == 46) ){
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
   }
   
   
   
   function cek_kode(){
		
        var inputan = $("#kode_barang").val();
        	 
        if(inputan==""){ // jika nama kosong
            $("#lbl-kode").addClass("has-error");
    		$("#err_kode").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_kode").fadeIn(1000);
    		error = 1;
		}else{
            $("#lbl-kode").removeClass("has-error");
    		$("#err_kode").html(""); 
    		error = 0; // setting error 0;
		}
   }
    
   function cek_nama(){
		
        var inputan = $("#nama_barang").val();
        	 
        if(inputan==""){ // jika nama kosong
            $("#lbl-nama").addClass("has-error");
            $("#err_nama").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_nama").fadeIn(1000);
    		error = 1;
                    
		}else{
            $("#lbl-nama").removeClass("has-error");
    		$("#err_nama").html(""); 
    		error = 0; // setting error 0;
		}
   }
    
    function cek_hb(){
		
        var inputan = $('#harga_beli').maskMoney('unmasked')[0];
        	 
        if(inputan==""){ // jika nama kosong
    		$("#lbl-hb").addClass("has-error");
            $("#err_hb").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_hb").fadeIn(1000);
    		error = 1;
                
		}else{
            $("#lbl-hb").removeClass("has-error");
    		$("#err_hb").html(""); 
    		error = 0; // setting error 0;
		}
    }
    
    function cek_hj(){
		
        var inputan = $('#harga_jual').maskMoney('unmasked')[0];
        	 
        if(inputan==""){ // jika nama kosong
            $("#lbl-hj").addClass("has-error");
            $("#err_hj").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_hj").fadeIn(1000);
    		error = 1;
                
		}else{
            $("#lbl-hj").removeClass("has-error");
			$("#err_hj").html(""); 
  	        
			error = 0; // setting error 0;
		}
    }
    
    function cek_qty(){
		
        var inputan = $("#qty").val();
        	 
        if(inputan==""){ // jika nama kosong
            $("#lbl-qty").addClass("has-error");
            $("#err_qty").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_qty").fadeIn(1000);
    		error = 1;
                    
		}else{
            $("#lbl-qty").removeClass("has-error");
    		$("#err_qty").html(""); 
    		error = 0; // setting error 0;
		}
    }
    
    function cek_limit(){
		
        var inputan = $("#limit").val();
        	 
        if(inputan==""){ // jika nama kosong
            $("#lbl-limit").addClass("has-error");
            $("#err_limit").html("<span class='label label-danger'>Must be filled!</span>");
    		$("#err_limit").fadeIn(1000);
    		error = 1;
                    
		}else{
            $("#lbl-limit").removeClass("has-error");
    		$("#err_limit").html(""); 
    		error = 0; // setting error 0;
		}
    }
    
    function cek_kategori(){
		
        var inputan = $("#select_kategori").val();
        	 
        if(inputan!=""){ // jika nama kosong
            $("#lbl-kategori").removeClass("has-error");
            $("#err_kategori").fadeIn(1000);
            $("#err_kategori").html("Must be filled!");
            error = 0; // setting error 0;
		}
    }
    
    function cek_kosong(){
        
        var err=false;
        
        if(err==false){
            if($("#kode_barang").val()==""){
                $("#lbl-kode").addClass("has-error");
                $("#err_kode").html("<span class='label label-danger'>Must be filled!</span>");
                $("#err_kode").fadeIn(1000);
                error = 1;
                err=true;
            }
        }
        
        if(err==false){
            if($("#nama_barang").val()==""){
                $("#lbl-nama").addClass("has-error");
           	    $("#err_nama").html("<span class='label label-danger'>Must be filled!</span>");
                $("#err_nama").fadeIn(1000);
                error = 1;
                err=true;
            }
        }
        
           
        if(err==false){
            if($("#select_kategori").val()==""){
           	    $("#lbl-kategori").addClass("has-error");
                $("#err_kategori").html("<span class='label label-danger'>Must be filled!</span>");
				$("#err_kategori").fadeIn(1000);
   
                error = 1;
                err=true;
            }
        }
        
         if(err==false){
            if($("#select_subkategori").val()==""){
                $("#lbl-kategori").addClass("has-error");
                $("#err_kategori").html("<span class='label label-danger'>Must be filled!</span>");
				$("#err_kategori").fadeIn(1000);
                
                error = 1;
                err=true;
            }
        }
        
        if(err==false){
            return true;
        }else{
            return false;
        }
    }

$(document).ready(function(){   
        
        $("#save").click(function(){			
				
				if(cek_kosong()){
                    
                    var harga_beli = $('#harga_beli').maskMoney('unmasked')[0];
                    var harga_jual = $('#harga_jual').maskMoney('unmasked')[0];
                    
					var data_post = {
						input_val_1: $("#kode_barang").val(),
                        input_val_2: $("#nama_barang").val(),
                        input_val_3: $("#select_kategori").val(),
                        input_val_4: $("#select_subkategori").val(),
                        input_val_5: $("#select_merk").val(),
                        input_val_6: $("#select_model").val(),
                        input_val_7: harga_jual,
                        input_val_8: harga_beli,
                        input_val_9: $("#select_satuan").val(),
                        input_val_10: $("#qty").val(),
                        input_val_11: $("#limit").val()            						
					};
			 	
					// ajax mulai disini
					$.ajax({
						url: base_url+"/index.php/barang/createBarang", //arahkan pada proses_tambah di controller nasabah
						data: data_post,
						type: "POST",
						success: function(msg){
							if(msg==0){ 
                                alert("Add Barang Gagal");
							}else{
								// hapus data                          
                                alert("Add Barang Sukses");
								window.location.assign(base_url+"/index.php/barang/index/");							
							}							 
						}
					});
				}
				 
				return false;
				 
			});
        
        $("#edit_barang").click(function(){			
				
				if(cek_kosong()){
					
                    var harga_beli = $('#harga_beli').maskMoney('unmasked')[0];
                    var harga_jual = $('#harga_jual').maskMoney('unmasked')[0];
                    		
					var data_post = {
						input_val_1: $("#kode_barang").val(),
                        input_val_2: $("#nama_barang").val(),
                        input_val_3: $("#select_kategori").val(),
                        input_val_4: $("#select_subkategori").val(),
                        input_val_5: $("#select_merk").val(),
                        input_val_6: $("#select_model").val(),
                        input_val_7: harga_jual,
                        input_val_8: harga_beli,
                        input_val_9: $("#select_satuan").val(),
                        input_val_10: $("#qty").val(),
                        input_val_11: $("#limit").val()     					
					};
				 	
                    var id_item = $("#item_id").val();
                    
					// ajax mulai disini
					$.ajax({
						url: base_url+"/index.php/barang/editBarang/"+id_item, //arahkan pada proses_tambah di controller nasabah
						data: data_post,
						type: "POST",
						success: function(msg){
							if(msg==0){
                                alert("Edit Barang Gagal");
							}else{	
								// hapus data                          
                                alert("Edit Barang Sukses");
								window.location.assign(base_url+"/index.php/barang/index/");							
							}							 
						}
					});
				}
				 
				return false;
				 
        });            
            
});