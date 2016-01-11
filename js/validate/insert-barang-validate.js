var error = 1;
   
   function validate_number(evt) {
        var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 39 || key == 46) ){
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
   }

    function validateInput(){
        var err=0;

        var kodeBarang = $("#kode_barang").val();
        var namaBarang = $("#nama_barang").val();
        var kategori = $("#select_kategori").val();
        var subKategori = $("#select_subkategori").val();
        var merk = $("#select_merk").val();
        var model = $("#select_model").val();
        var hargaBeli = $('#harga_beli').maskMoney('unmasked')[0];
        var hargaJual = $('#harga_jual').maskMoney('unmasked')[0];
        var ukuran = $("#ukuran").val();
        var satuan = $("#select_satuan").val();
        var qty = $("#qty").val();
        var limit = $("#limit").val();

        $(".label-danger").remove();

        if(kodeBarang=="" || kodeBarang==null){ // jika kode kosong
            //$("#err_kode").html("<span class='label label-danger'>Must be filled!</span>");
            $('<span class="label label-danger">Must be filled</span>').appendTo("#err_kode");
            err++;
        }

        if(namaBarang=="" || namaBarang==null){ // jika kode kosong
            $("#err_nama").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(kategori=="" || kategori==null){ // jika kateogri kosong
            $("#err_kategori").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(subKategori=="" || subKategori==null){ // jika sub kategori kosong
            $("#err_subkategori").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(merk=="" || merk==null){ // jika merk kosong
            $("#err_merk").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(model=="" || model==null){ // jika model kosong
            $("#err_model").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(hargaBeli=="" || hargaBeli==null){ // jika harga beli kosong
            $("#err_hb").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(hargaJual=="" || hargaJual==null){ // jika harga jual kosong
            $("#err_hj").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(ukuran=="" || ukuran==null){ // jika qty kosong
            $("#err_ukuran").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(satuan=="" || satuan==null){ // jika qty kosong
            $("#err_satuan").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(qty=="" || qty==null){ // jika qty kosong
            $("#err_qty").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(limit=="" || limit==null){ // jika limit kosong
            $("#err_limit").html("<span class='label label-danger'>Must be filled!</span>");
            err++;
        }

        if(err==0){
            return true;
        }else{
            return false;
        }
    }

$(document).ready(function(){   
        
        $("#save").click(function(){
				if(validateInput()){
                    
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
                        input_val_11: $("#limit").val()  ,
                        input_val_12: $("#ukuran").val()
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
				
				if(validateInput()){
					
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
                        input_val_11: $("#limit").val(),
                        input_val_12: $("#ukuran").val()
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