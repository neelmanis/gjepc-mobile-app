 <section id="no-more-tables">   
        <table id="table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
						<th>Exhibitor_ID</th>
                        <th>Exhibitor_Name</th>
                        <th>Exhibitor_Contact_Person</th>
                        <th>Exhibitor_Designation</th>
                        <th>Exhibitor_IsActive</th>
						<th>Exhibitor Code</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
 
            <tfoot>
                <tr>
                    <th>Exhibitor_ID</th>
                        <th>Exhibitor_Name</th>
                        <th>Exhibitor_Contact_Person</th>
                        <th>Exhibitor_Designation</th>
                        <th>Exhibitor_IsActive</th>
						<th>Exhibitor Code</th>
                </tr>
            </tfoot>
        </table>
   </section>
  
<script type="text/javascript"> 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('test/ajax_list')?>", 
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>
 