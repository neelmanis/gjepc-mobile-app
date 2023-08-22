<?php // print_r($ans); ?> 
<!--http://localhost/gjepc_mobile/test/inventory-->
 <section id="no-more-tables">
                <table class="table table-striped table-condensed cf" id='listTable'>
                    <thead class="cf">
                    <tr>
                        <th>Exhibitor_ID</th>
                        <th>Exhibitor_Name</th>
                        <th>Exhibitor_Contact_Person</th>
                        <th>Exhibitor_Designation</th>
                        <th>Exhibitor_IsActive</th>
						<th>Exhibitor_Login</th>
                        <th><i class=" fa fa-edit"></i> Actions</th>
                    </tr>
                    </thead>
                </table>
</section>

<script type="text/javascript" language="javascript" >
$(document).ready(function() {
    $('#listTable').DataTable({
        'sPaginationType': 'full_numbers',
		'processing': true,
		'serverSide': true,
		'bSort': false,
        "ajax": {
			 "url": baseUrl+"test/getProduct/A",
			
            "dataSrc": "",
            "deferRender": true,
   
	   },
        "columns": [
            { "data": "Exhibitor_ID" },
            { "data": "Exhibitor_Name" },
            { "data": "Exhibitor_Contact_Person" },
            { "data": "Exhibitor_Designation" },
            { "data": "Exhibitor_IsActive" },
			{ "data": "Exhibitor_Login" },
			{ "data": "Exhibitor_Password" },
        ],
        "order": [[5, "desc"]],
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false,
            },
            {
                "render": function ( data, type, row ) {
                    var url = baseUrl + 'test/views/' + data;
                    var str = ' <a class="btn btn-primary btn-xs" href="' + url + '" title="View Product"><i class="fa fa-eye"></i> View</a>';
                    return str;
                },
                "targets": [6]
            }
        ],
    });
});
</script>