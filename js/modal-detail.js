 var count = 1;
 var indexNewItem = -1;
 var selected_row;
 var detailArray = [];
    
   Array.prototype.removeDetail = function(value) {
        if (value != -1) {
              return this.splice(value, 1);
        }
            return false;
        }
        
   Array.prototype.objIndexOf = function(val) {
        var index;
        for (var i = 0; i < detailArray.length; i++) {
          if (detailArray[i].indexItem == val ) {
            index = i;
            return index;
            break;
          }
        }
    }
    
    $(document).ready(function(){ 
            
       $('#detail-form').submit(function(){ return false;});
       $('#detail-form-edit').submit(function(){ return false;});  
       
        $(".edit-btn").click(function(){


            $("#detail-form")[0].reset();

            var $form_edit_modal = $('.cd-edit-modal');
            var $edit_nav = $('.edit-nav');

            var selected_row = $(this).closest("tr");
            var $row =  $(this).closest("tr");
            var kode_modal = $row.find("#kode").text();
            var stock_modal = $row.find("#stock").text();
            var harga_modal = parseInt($row.find("#harga_value").val());
            var qty_modal = $row.find("#qty").text();
            var harga_jual_modal = parseInt($row.find("#harga_curr_value").val());

            $('#kode_barang_edit').val(kode_modal);
            $('#stock_barang_edit').val(stock_modal);
            $('#qty_barang_edit').val(qty_modal);
            $('#harga_jual_barang_edit').maskMoney('mask', harga_modal);
            $('#harga_jual_curr_barang_edit').maskMoney('mask', harga_jual_modal);

            if( $(event.target).is($edit_nav) ) {
                // on mobile open the submenu
                $(this).children('ul').toggleClass('is-visible');
            } else {
                // on mobile close submenu
                $edit_nav.children('ul').removeClass('is-visible');
                //show modal layer
                $form_edit_modal.addClass('is-visible');
            }
            alert("asd");
        });
        
       //Add Data to Detail
       $("#add-detail-item").click(function(){
            
            var item_id = $("#item_id").val();
            var kode = $("#kode_barang").val();
            var stock = $("#stock_barang").val();
            var harga = $("#harga_jual_barang").val();
            var qty = $("#qty_barang").val();
            var harga_curr = $("#harga_jual_curr_barang").val();
            
            var harga_value = $('#harga_jual_barang').maskMoney('unmasked')[0];
            var harga_curr_value = $('#harga_jual_curr_barang').maskMoney('unmasked')[0];
            
            
            var detailItem = {
                indexItem : indexNewItem,
                id : item_id,
                quantity : qty,
                capital_price : harga_value,
                price : harga_curr_value,
                status : "add"
            };
            detailArray.push(detailItem);
            
            if(isValidate(item_id,kode, stock, harga, qty, harga_curr, harga_value, harga_curr_value)){
                //Add Item to Table
                addItemDetail(kode, stock, harga, qty, harga_curr, harga_value, harga_curr_value);
                
                alert(JSON.stringify(detailArray));
                      
                count++;
                indexNewItem--;
    
                var $form_edit_modal = $('.cd-user-modal');
                $form_edit_modal.removeClass('is-visible');
                $("#detail-form")[0].reset();
            }
                
       });
       
       function isValidate(item_id,kode, stock, harga, qty, harga_curr, harga_value, harga_curr_value){
            if(item_id == "" || item_id==null){
                 $("#err_kode_1").show();
            }
            return 1;
       }
       
       function addItemDetail(kode, stock, harga, qty, harga_curr, harga_value, harga_curr_value  ){
            var tr = $("<tr>", {id: "item-"+count, class: "a"});
            var td1 = $("<td>", {id: "kode", class: "td-center"}).text(kode);
            var td2 = $("<td>", {id: "stock", class: "td-right"}).text(stock);
            var td3 = $("<td>", {id: "harga", class: "td-right"}).text(harga);
            var td4 = $("<td>", {id: "qty", class: "td-right"}).text(qty);
            var td5 = $("<td>", {id: "harga_curr", class: "td-right"}).text(harga_curr);           
            var td6 = $("<td>", {id: "option", class: "td-center"});
            
            var input_hidden1= $("<input>", {id: "harga_value", class: "hidden", value :harga_value});
            var input_hidden2= $("<input>", {id: "harga_curr_value", class: "hidden", value :harga_curr_value});
            
            var anchor = $("<a>", {class: "edit-nav", href : "#"});
            var button_edit =  $("<button>", {id: "edit"+count, class: "btn btn-primary btn-xs edit-btn ", type: "button", "data-index-id":indexNewItem});
            var button_del = $("<button>", {id: "del", class: "btn btn-danger btn-xs", type: "button", "data-index-id":indexNewItem});
            var span_edit = $("<span>", {class: "glyphicon glyphicon-pencil"});
            var span_del = $("<span>", {class: "glyphicon glyphicon-trash"});
            
            td1.appendTo(tr);
            td2.appendTo(tr);
            td3.appendTo(tr);
            td4.appendTo(tr);
            td5.appendTo(tr);
            td6.appendTo(tr);
            input_hidden1.appendTo(tr);
            input_hidden2.appendTo(tr);
            
            //EDIT BUTTON CLICK
            button_edit.click(function(event){
                
                $("#detail-form")[0].reset();
                
                var $form_edit_modal = $('.cd-edit-modal'),
                $edit_nav = $('.edit-nav');
                
                selected_row = $(this).closest("tr");
                var $row =  $(this).closest("tr");
                var kode_modal = $row.find("#kode").text();
                var stock_modal = $row.find("#stock").text();
                var harga_modal = parseInt($row.find("#harga_value").val());
                var qty_modal = $row.find("#qty").text();
                var harga_jual_modal = parseInt($row.find("#harga_curr_value").val());
                
                $('#kode_barang_edit').val(kode_modal);
                $('#stock_barang_edit').val(stock_modal);
                $('#qty_barang_edit').val(qty_modal);
                $('#harga_jual_barang_edit').maskMoney('mask', harga_modal);
                $('#harga_jual_curr_barang_edit').maskMoney('mask', harga_jual_modal);
                
                if( $(event.target).is($edit_nav) ) {
        			// on mobile open the submenu
        			$(this).children('ul').toggleClass('is-visible');
        		} else {
        			// on mobile close submenu
        			$edit_nav.children('ul').removeClass('is-visible');
        			//show modal layer
        			$form_edit_modal.addClass('is-visible');	
        		}
                
            });
            
            //DELETE BUTTON CLICK
            button_del.click(function(event){
                 var element  = $(this).closest("tr");
                 var indexId = element.find("#del").data("index-id");
                 var indefOf = detailArray.objIndexOf(indexId);
                 detailArray.removeDetail(indefOf);
                 element.remove();
                 alert(JSON.stringify(detailArray));
            });
            
            span_edit.appendTo(button_edit);
            span_del.appendTo(button_del);
            
            button_edit.appendTo(anchor);
            anchor.appendTo(td6);
            button_del.appendTo(td6);    
            
            $('#detail-content').append(tr);
       }
    });