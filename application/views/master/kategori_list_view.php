 <?php $this->load->helper('HTML');
?>
<style>
    .cd-error-message{
        font-size:12px;
        visibility: hidden;
    }
    .hidden{
        display: none;
    }
    th.dt-center, td.dt-center { text-align: center; }
</style>
 <?php $this->load->view('modal/modal_add_edit_kategori')?>

<div class="content-container" id="content-container" >
    <p>
        <div class="row">
            <div class="col-lg-8">
                <button type="button" class="btn btn-primary btn-xl" id="add-btn" data-toggle="modal" data-target="#kategori-modal">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp Add Kategori
                </button>
            </div>
        </div>
    </p>
    
    <div class="data-content">
    <table  class="table table-bordered table-striped tbl-master" id="dataTables-list">
        <thead>
            <tr>
                <th style = "text-align:center;">No</th>
                <th style = "text-align:left;">Nama Kategori</th>
                <th style = "text-align:left;display:none;">Created</th>
                <th style = "text-align:left;display:none;">Created By</th>
                <th style = "text-align:left;display:none;">Last Modified</th>
                <th style = "text-align:left;display:none;">Last Modified By</th>
                <th style = "text-align:center;">Option</th>
            </tr>
        </thead>
        
        <tbody>

        </tbody>
    </table>

    </div>
</div>
 <script src="<?php echo base_url(); ?>js/validate/insert-master-validate.js" type="text/javascript"></script>
 <script>
     $(function() {
         var baseurl = "<?php echo site_url();?>/";

         /*
         var table = $('#dataTables-list').dataTable({
             "fnCreatedRow": function( nRow, aData, iDataIndex ) {

                 var temp = aData[0];
                 var temp = temp.split('|');
                 var numbering = temp[0];
                 var id = temp[1];

                 var kategori_name = aData[1];
                 var created = aData[2];
                 var createdBy = aData[3];
                 var lastModified = aData[4];
                 var lastModifiedBy = aData[5];
                 //var action = $('td:eq(6)', nRow).text();

                 //var status = $('td:eq(3)', nRow).text();
                 // Button Edit
                 var $a_btn_edit = $("<a>", { class: "edit-nav"});
                 var $btn_edit = $("<button>", { class:"btn btn-primary btn-xs edit-btn","type": "button",
                     "data-toggle":"modal","data-target":"#kategori-modal","data-value": id});
                 $btn_edit.append("<span class='glyphicon glyphicon-pencil'></span>&nbsp Edit");
                 $a_btn_edit.append($btn_edit);

                 var $a_btn_del = $("<a>", { class: "edit-nav","data-value": "0"});
                 var $btn_del = $("<button>", { class:"btn btn-danger btn-xs del-btn","type": "button",
                     "data-toggle":"modal","data-target":"#kategori-modal","data-value": id});
                 $btn_del.append("<span class='glyphicon glyphicon-remove'></span>&nbsp Delete");
                 $a_btn_del.append($btn_del);

                 $('td:eq(0)', nRow).html(numbering);
                 $('td:eq(1)', nRow).attr("data-name",kategori_name).html(kategori_name);
                 $('td:eq(2)', nRow).html(created).css('display','none');
                 $('td:eq(3)', nRow).html(createdBy).css('display','none');
                 $('td:eq(4)', nRow).html(lastModified).css('display','none');
                 $('td:eq(5)', nRow).html(lastModifiedBy).css('display','none');
                 $('td:eq(6)', nRow).html($a_btn_edit).append(" ").append($a_btn_del);
             },
             "bAutoWidth": false, // Disable the auto width calculation
             "aoColumns": [
                 { "sWidth": "10%" },
                 { "sWidth": "40%" },
                 { "sWidth": "0%" },
                 { "sWidth": "0%" },
                 { "sWidth": "0%" },
                 { "sWidth": "0%" },
                 { "sWidth": "20%" }
             ],
             aoColumnDefs: [
                 {
                     bSortable: false,
                     aTargets: [ -1 ]
                 },
                 {"className": "dt-center", "targets": 6}
             ],
             "bProcessing": true,
             "bServerSide": true,
             "sAjaxSource": baseurl+"kategori/dataKategoriList",
             'fnServerData': function (sSource, aoData, fnCallback) {
                 $.ajax
                 ({
                     'dataType': 'json',
                     'type': 'POST',
                     'url': sSource,
                     'data': aoData,
                     'success': fnCallback
                 });
             },
             "createdRow": function (row, data, rowIndex) {
                 // Per-cell function to do whatever needed with cells
                 $.each($('td', row), function (colIndex) {
                     // For example, adding data-* attributes to the cell
                     $(this).attr('data-foo', "bar");
                 });
             }
         });
         $('#dataTables-list').each(function(){
             var datatable = $(this);
             // LENGTH - Inline-Form control
             var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
             length_sel.addClass('form-control input-sm');
         });
            */
         var selected = [];
         var table = $('#dataTables-list').DataTable({
             "lengthChange": false,
             "processing": true, //Feature control the processing indicator.
             "serverSide": true, //Feature control DataTables' server-side processing mode.
             "order": [], //Initial no order.
             "autoWidth": false,
             deferRender: true,
             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": baseurl+"kategori/dataKategoriListAjax",
                 "type": "POST"
             },
             "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                 $(nRow).attr('id', aData[1]);
             },
             columns: [
                 { data: 0,"width": "10%" },
                 { data: 2, "width": "50%"},
                 { data: 1, "width": "40%"}
             ],
             //Set column definition initialisation properties.
             "columnDefs": [
                 {
                     "targets": [ -1 ], //last column
                     "orderable": false,//set not orderable
                     "className": "dt-center",
                     "createdCell": function (td, cellData, rowData, row, col) {
                         var $btn_edit = $("<button>", { class:"btn btn-primary btn-xs edit-btn","type": "button",
                             "data-toggle":"modal","data-target":"#kategori-modal","data-value": cellData});
                         $btn_edit.append("<span class='glyphicon glyphicon-pencil'></span>&nbsp Edit");

                         var $btn_del = $("<button>", { class:"btn btn-danger btn-xs del-btn","type": "button",
                            "data-value": cellData});
                         $btn_del.append("<span class='glyphicon glyphicon-remove'></span>&nbsp Delete");

                         var $div_info = $("<div>",{class:"hidden item-info", "data-created":rowData[3],"data-last-modifed":rowData[4]});
                         $(td).html($btn_edit).append(" ").append($btn_del).append($div_info);
                     }
                 },
                 {
                     "targets": [0], //last column
                     "orderable": false//set not orderable}
                 }
             ],
             "rowCallback": function( row, data ) {
                 if ( $.inArray(data[1], selected) !== -1 ) {
                     $(row).addClass('selected');
                 }
             }

         });

         $('#dataTables-list tbody').on('click', 'tr', function () {
             var id = this.id;
             var index = $.inArray(id, selected);

             if ( index === -1 ) {
                 selected.push( id );
             } else {
                 selected.splice( index, 1 );
             }

             var count_selected = selected.length;
             $("#dataTables-list_info span").empty();
             $("#dataTables-list_info").append(" <span>"+count_selected+" selected</span>");

             $(this).toggleClass('selected');
         } );

         $("#add-btn").click(function(){
             $('#kategori-form')[0].reset();
             $('#created').empty();
             $('#last_modified').empty();
             $('.modal-title').text("Add New Kategori");
             $('#btn-update').hide();
             $('#btn-save').show();
             $('.cd-error-message').css("visibility","hidden");
         });

         //Edit open Modal
         $( "#dataTables-list tbody" ).on( "click", "button.edit-btn", function() {
             $('#kategori-form')[0].reset();
             $('.modal-title').text("Edit Kategori");
             $('#btn-save').hide();
             $('#btn-update').show();
             $('.cd-error-message').css("visibility","hidden");

             var id_item =  $(this).attr("data-value");
             var $tr =  $(this).closest("tr");
             var $td =  $(this).closest("td");
             var text = $tr.find('td').eq(1).text();
             var created = $td.find('div.item-info').attr("data-created");
             var last_modified = $td.find('div.item-info').attr("data-last-modifed");

             $('#inputan').val(text);
             $('#item_id').val(id_item);

             $('#created').empty();
             $('#created').append("Created : "+"<b>"+created+"</b>");
             $('#last_modified').empty();
             $('#last_modified').append("Last Modified : "+"<b>"+last_modified+"</b>");

         });

         //Delete
         $( "#dataTables-list tbody" ).on( "click", "button.del-btn", function() {
             var id_item =  $(this).attr("data-value");
             var $tr =  $(this).closest("tr");
             var col_title = $tr.find('td').eq(1).text();

             var formData = new FormData();
             formData.append("delID", id_item);

             $(this).deleteData({
                 alertMsg     : "Do you want to delete this <i><b>"+col_title+"</b></i> kategori ?",
                 alertTitle   : "Delete Confirmation",
                 url		     : "<?php echo site_url('kategori/deleteKategori')?>",
                 data		 : formData,
                 locationHref : "<?php echo site_url('kategori')?>"
             });

         });
     });
 </script>