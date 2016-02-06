
    var count_index = 0;
    var base_url = $("#base_url").val();
    var detailItemPenjualan = [];
    var autoCompleteArr = new Array();

    $(document).ready(function() {
        // Add New Penjualan Detail
        $('#add-detail').click(function(){
            addBarangPenjualan();
        });

        // SET Editable Component

        // Nama Barang Item (AutoComplete)
        $(document).on( "keyup",".search-box",function(event) {
            var $element = $(this);
            var value = $(this).val();
            var $row =  $(this).closest("div");
            if(value.length > 2) {
                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/barang/getBarangData",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function () {
                        $element.css("background", "#FFF url(../../img/loading.gif) no-repeat 80%");
                    },
                    success: function (data) {
                        var arr = JSON.parse(data);
                        autoCompleteArr = arr;
                        $($row).children(".suggesstion-box").show();

                        if(arr.length > 0) {
                            var ul = $("<ul>", {class: "barang-list"});
                            for (x in arr) {
                                var li = $("<li>",
                                    {"data-index": x}).text(arr[x].Barang_Name);
                                ul.append(li);
                            };
                            $($row).children(".suggesstion-box").html(ul);
                        }else{
                            var div = $("<div>", {class: "barang-list"}).text("barang not found");
                            $($row).children(".suggesstion-box").html(div);
                        }
                        $element.css("background", "#FFF");
                    }
                });
            }else{
                $(".suggesstion-box").hide();
            }
        });

        // Kode Item
        $(document).on('click','#add-detail', function(){
            $('.kode-item-input').editable({
                url: base_url+"index.php/barang/getBarangPenjualan",
                ajaxOptions: {
                    type: 'post',
                    dataType: 'json'
                },
                success: function(response, newValue) {
                    if(response.status=="error"){
                        return response.msg;
                    }
                    else{
                        $(this).attr("data-value",response.barangID);
                        var $row =  $(this).closest("tr");
                        var harga = parseInt(response.harga).format(0, 3, '.', ',');
                        $row.attr('data-value',response.barangID);
                        $row.find(".harga-curr-item").attr('data-value',response.harga);
                        $row.find(".harga-curr-item").text(harga);
                        $row.find(".harga-item-input").editable('setValue', response.harga, true);
                        //return response.msg;
                    }
                },
                error: function(response, newValue) {
                    if(response.status === 500) {
                        return 'Service unavailable. Please try later.';
                    } else {
                        return response.responseText;
                    }
                }

            });
        });

        // Quantity Item
        $(document).on('click','#add-detail', function(){
            $('.qty-item-input').editable({
                step: 'any', // <-- added this line
                title : 'Enter New Value',
                display: function(value) {
                    $(this).attr("data-value",value);
                    $(this).text(value);
                }
            });
        });

        // Harga Item
        $(document).on('click','#add-detail', function(){
            $('.harga-item-input').editable({
                title : 'Enter New Value',
                display: function(value) {
                    $(this).attr("data-value",value);
                    var k = parseFloat(value).format(0, 3, '.', ',');
                    $(this).text(k);
                }
            });
        });

        $(document).on('click','.barang-list li', function(){
            var value = $(this).text();
            var index = $(this).attr("data-index");
            var div =  $(this).closest("div");
            var $row =  div.prev();

            var tr =  $(this).closest("tr");
            var harga = parseInt(autoCompleteArr[index].Harga_Jual).format(0, 3, '.', ',');
            //$row.find(".name-item").text(response.namaBarang);
            tr.attr('data-value',autoCompleteArr[index].Barang_ID);
            //set kode
            tr.find(".kode-item-input").editable('setValue',autoCompleteArr[index].Kode_Barang);
            tr.find(".kode-item-input").attr('data-value',autoCompleteArr[index].Kode_Barang);
            //set harga curr
            tr.find(".harga-curr-item").attr('data-value',autoCompleteArr[index].Harga_Jual);
            tr.find(".harga-curr-item").text(harga);
            //set harga jual
            tr.find(".harga-item-input").editable('setValue', autoCompleteArr[index].Harga_Jual, true);

            $row.val(autoCompleteArr[index].Barang_Name);
            div.hide();
        });

    });

    function selectNamaBarang(val) {
        alert(this.html);
        $("#search-box").val(autoCompleteArr[val].Barang_Name);
        $(".suggesstion-box").hide();
    }

    function addBarangPenjualan(){
        createItemDetail();
        count_index++;
        countHargaTotalHandler();
    }

    function createItemDetail(){
        var tr = $("<tr>", {id: "item-"+count_index, class:"item-detail","data-value":""});

        // Kode Barang
        var td1 = $("<td>", {class: "kode-item"});
        var a1 = $("<a>", {class: "kode-item-input","data-value": "","data-type":"text","data-pk":count_index});
        a1.appendTo(td1);

        // Nama barang, Harga barang current
        var td2 = $("<td>", {class: "name-item"});
        var div2 = $("<div>", {class: "frmSearch"});
        var input2 = $("<input>", {type: "text", placeholder:"Nama Barang ...", class:"search-box"});
        var divBox = $("<div>", {class: "suggesstion-box"});
        input2.appendTo(div2);
        divBox.appendTo(div2);
        div2.appendTo(td2);

        var td3 = $("<td>", {class: "harga-curr-item td-right"});

        // Qty Barang
        var td4 = $("<td>", {class: "qty-item td-right"});
        var a4 = $("<a>", {class: "qty-item-input","data-value": "0","data-type":"number","data-pk":count_index});
        a4.appendTo(td4);

        // Harga jual
        var td5 = $("<td>", {class: "harga-item td-right"});
        var a5 = $("<a>", {class: "harga-item-input","data-value": "0","data-type":"number","data-pk":count_index});
        a5.appendTo(td5);

        //Harga total
        var td6 = $("<td>", { class: "harga-total-item td-right","data-value": "0"});

        //Option
        var td7 = $("<td>", { class: "option td-center"});
        var button_del = $("<button>", {id: "del", class: "btn btn-danger btn-xs", type: "button", "data-index-id":count_index});
        var span_del = $("<span>", {class: "glyphicon glyphicon-trash"});
        span_del.appendTo(button_del);
        button_del.appendTo(td7);

        //Delete Action
        //DELETE BUTTON CLICK
        button_del.click(function(event){
            var element  = $(this).closest("tr");
            var total = parseInt(element.find(".harga-total-item").attr("data-value"));
            var result = 0-total;
            countResult(result);
            element.remove();
        });

        //Set data to table
        td1.appendTo(tr);
        td2.appendTo(tr);
        td3.appendTo(tr);
        td4.appendTo(tr);
        td5.appendTo(tr);
        td6.appendTo(tr);
        td7.appendTo(tr);
        $('#detail-content').append(tr);
    }

    function countHargaTotalHandler(){
        // Change event untuk itung total per item dynamic
        $(".kode-item-input,.qty-item-input,.harga-item-input").bind("DOMSubtreeModified", function() {
            var $row =  $(this).closest("tr");
            var qty = $row.find(".qty-item-input").attr("data-value");
            var price = $row.find(".harga-item-input").attr("data-value");

            var total = parseInt(qty)*parseInt(price);
            var old_total = parseInt($row.find(".harga-total-item").attr("data-value"));
            var result = total-old_total;
            countResult(result);

            $row.find(".harga-total-item").attr("data-value",total);
            $row.find(".harga-total-item").text(total.format(0, 3, '.', ','));
            //alert("tree changed");
        });
    }

    // Function untuk hitung final harga total belanjaan
    function countResult(value){
        var old_result = parseInt($("#total-result").attr("data-value"));
        var result = old_result+value;
        $("#total-result").attr("data-value",result);
        $("#total-result").text(result.format(0, 3, '.', ','));
    }

    // change format currency
    Number.prototype.format = function(n, x, s, c) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
            num = this.toFixed(Math.max(0, ~~n));

        return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
    };

    function validatePenjualanInput(){
        var kode_bon = $("#kode_bon").val();
        var nama_customer = $("#nama_customer").val();
        var tgl_penjualan = $("#tgl_penjualan").val();

        var status = $('#stat option:selected').val();
        var tgl_jth_tempo = $("#tgl_jth_tmp").val();
        var harga_hutang = $("#harga_htg").val();

        var error_list_msg = new Array();

        if(kode_bon == null || kode_bon==""){
            error_list_msg.push("Kode bon harus di isi");
        }
        if(nama_customer == null || nama_customer==""){
            error_list_msg.push("Nama Customer harus di isi");
        }
        if(tgl_penjualan == null || tgl_penjualan==""){
            error_list_msg.push("Tanggal Penjualan harus di isi");
        }
        if(status == 3){
            if(tgl_jth_tempo == null || tgl_jth_tempo==""){
                error_list_msg.push("Tanggal Jatuh Tempo harus di isi");
            }
            if(harga_hutang == null || harga_hutang==""){
                error_list_msg.push("Harga Hutang harus di isi");
            }
        }

        if(!validateDetailItem()){
            error_list_msg.push("Barang yand di jual harus di isi");
        }

        var msg = "";

        if(error_list_msg.length != 0 ){
            //$('#error-msg').removeClass("hidden");
            for(var i in error_list_msg ){
                //var div_msg = $("<div>", {class: "alert alert-danger"}).text(error_list_msg[i]);
                msg+=error_list_msg[i]+"<br/><br/>";
                //div_con.append(div_msg);
            }
            alertify.alert(msg);
            return false;
        }else{
            return true;
        }
    }

    function validatePenjualanEdit(){
        var kode_bon = $("#kode_bon").val();
        var nama_customer = $("#nama_customer").val();
        var tgl_penjualan = $("#tgl_penjualan").val();

        var status = $('#stat option:selected').val();
        var tgl_jth_tempo = $("#tgl_jth_tmp").val();

        var error_list_msg = new Array();

        if(kode_bon == null || kode_bon==""){
            error_list_msg.push("Kode bon harus di isi");
        }
        if(nama_customer == null || nama_customer==""){
            error_list_msg.push("Nama Customer harus di isi");
        }
        if(tgl_penjualan == null || tgl_penjualan==""){
            error_list_msg.push("Tanggal Penjualan harus di isi");
        }
        if(status == 2){
            if(tgl_jth_tempo == null || tgl_jth_tempo==""){
                error_list_msg.push("Tanggal Jatuh Tempo harus di isi");
            }
        }

        if(error_list_msg.length != 0 ){
            //$('#error-msg').removeClass("hidden");
            for(var i in error_list_msg ){
                //var div_msg = $("<div>", {class: "alert alert-danger"}).text(error_list_msg[i]);
                msg+=error_list_msg[i]+"<br/><br/>";
                //div_con.append(div_msg);
            }
            alertify.alert(msg);
            return false;
        }else{
            return true;
        }

    }


    function validateDetailItem(){
        var err = 0; //err data detail
        var check_detail = 1; // err if detail is empty
        detailItemPenjualan=[];
        $( "tr.item-detail" ).each(function( index, element ) {
            // element == this
            var harga_total = $(this).children("td.harga-total-item").attr("data-value");

            if ( harga_total==0 || harga_total==null ) {
                $(this).css("border","3px solid #C0392B");
                err++;
            }else{
                $(this).css("border","none");
                var barang_id = $(this).attr("data-value");
                var harga_curr = $(this).children("td.harga-curr-item").attr("data-value");
                var qty = $(this).children("td.qty-item").children().attr("data-value");
                var harga = $(this).children("td.harga-item").children().attr("data-value");

                var detailData = {
                    id : barang_id,
                    qty : qty,
                    capital_price : harga_curr,
                    price : harga
                };

                detailItemPenjualan.push(detailData);
                check_detail = 0;
                err+=0;
            }
        });
        if(err != 0 || check_detail != 0){
            detailItemPenjualan=[];
            //alert(err+" error "+check_detail+JSON.stringify(detailItemPenjualan));
            return false;
        }else{
            //alert(err+" sukses "+check_detail+JSON.stringify(detailItemPenjualan));
            return true;
        }

    }

