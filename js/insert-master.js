function cek_input(){
		
			var address = $("#inputan").val();
	 
			if(address==""){          
				$("#cd-error-message").html("<div style='color:#fc5d32;font-size:17px;'>This data Must be Filled&nbsp<span class='label label-danger'><i class='glyphicon glyphicon-remove'></i></span></div>");
				$("#inputan").css("border-color","#fc5d32");
				$("#cd-error-message").fadeIn(1000);
				$("#pesan_address").html("");
				error = 1;
			}else{
				$("#pesan_address").html("<span class='label label-success'><i class='glyphicon glyphicon-ok'></i></span>");
				$("#inputan").css("border-color","#59c113");
				$("#pesan_address").fadeIn(1000);
				$("#cd-error-message").html(""); 
				error = 0;
			}
		}