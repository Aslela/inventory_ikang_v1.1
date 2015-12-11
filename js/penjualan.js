
    var count_index = 0;
    var base_url = $("#base_url").val();
    var detailItemPenjualan = new Array();

    function addBarangPenjualan(){
        createItemDetail();
        count_index++;
        setEditableElement();
        countHargaTotalHandler();
    }

    function createItemDetail(){
        var tr = $("<tr>", {id: "item-"+count_index, class:"item-detail"});

        // Kode Barang
        var td1 = $("<td>", {class: "kode-item"});
        var a1 = $("<a>", {class: "kode-item-input","data-value": "","data-type":"text","data-pk":count_index});
        a1.appendTo(td1);

        // Nama barang, Harga barang current
        var td2 = $("<td>", {class: "name-item"});
        var a2 = $("<a>", {class: "name-item-input","data-value": "","data-type":"select2","data-pk":count_index});
        a2.appendTo(td2);

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

    function setEditableElement(){
        //Editable Kode
        $('.kode-item-input').editable({
            url: base_url+"/index.php/barang/getBarangPenjualan",
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
                    //$row.find(".name-item").text(response.namaBarang);
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

        //Editable Nama barang
        $('.nama-item-input').editable({
            step: 'any', // <-- added this line
            title : 'Enter New Value',
            display: function(value) {
                $(this).attr("data-value",value);
                $(this).text(value);
            }
        });

        //Editable qty
        $('.qty-item-input').editable({
            step: 'any', // <-- added this line
            title : 'Enter New Value',
            display: function(value) {
                $(this).attr("data-value",value);
                $(this).text(value);
            }
        });
        //Editable harga Jual
        $('.harga-item-input').editable({
            title : 'Enter New Value',
            display: function(value) {
                $(this).attr("data-value",value);
                var k = parseFloat(value).format(0, 3, '.', ',');
                $(this).text(k);
            }
        });
    }

    function countHargaTotalHandler(){
        // Change event untuk itung total dynamic
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

    // Function untuk hitung harga total belanjaan
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

        if(detailArray.length == 0){
            error_list_msg.push("Barang yand di jual harus di isi");
        }

        if(error_list_msg.length != 0 ){
            $('#error-msg').removeClass("hidden");
            for(var i in error_list_msg ){
                var div_msg = $("<div>", {id: "kode", class: "alert alert-danger"}).text(error_list_msg[i]);
                $('.error-box').append(div_msg);
                alert(tgl_penjualan);
            }

        }
    }

    function validateDetailItem(){
        $( "div" ).each(function( index, element ) {
            // element == this
            $( element ).css( "backgroundColor", "yellow" );
            if ( $( this ).is( "#stop" ) ) {
                $( "span" ).text( "Stopped at div index #" + index );
                return false;
            }
        });
    }

