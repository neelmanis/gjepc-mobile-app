<div class="row mt">
    <div class="col-lg-12">
	
        <div class="content-panel">
        	<h4 style="display: inline-block; padding-right: 1em">Service Venue List</h4>
			
			<a href="<?php echo base_url("venue/addshowdetails");?>"><button class="btn btn-primary" type="button">ADD NEW</button></a>
			
			<section id="no-more-tables">
	    <table id="example" class="table table-striped table-advance table-hover">
	            <thead class="cf">
					<tr>
                       <th>Sr. No.</th>
					   <th>Title</th>
                       <th>Year</th>
                       <th>Event Name</th>
                       <th>Status</th>
                       <th>Action</th>
					</tr>
				</thead>
              
				<tbody>
                  <?php 
				       if(is_array($details)){
				       $i= 1;
                       foreach($details as $row){						 
				  ?>
					 <tr>
                     	<td><?php echo $i++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo Modules::run('venue/yearName',$row['year'])?></td>
						<td><?php echo Modules::run('venue/eventName',$row['event_name'])?></td>
                        <td><?php if($row['status']== 1) { echo 'Active'; } else { echo 'InActive'; } ?></td>
						<td>
                        <a class="optbtns" href="<?php echo base_url()."venue/editinfo/".$row['id']; ?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit"></i></a>
						
                        <a class="optbtns" href="<?php echo base_url()."venue/viewDetails/".$row['id']; ?>" title="View Details"><i class="fa fa-eye" aria-hidden="true"></i></a>
	 
						<a class="btn btn-danger btn-xs" href="<?php echo base_url()."venue/delete_details/".$row['id']; ?>" title="Delete" id="delete" onClick="return confirmDelete();"><i class="fa fa-trash-o"></i></a>
                        </td>
					 </tr>
                       <?php } } ?>
				</tbody>
	        </table>
           </section>   	
        </div>
    </div>
</div>
<script type='text/javascript'>
function confirmDelete()
{
   return confirm("Are you sure you want to delete this?");
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/datatable/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>/admin_assets/datatable/js/jquery.dataTables.js"></script>   
<script type="text/javascript">
   $(document).ready(function(){
   $("#example").DataTable();
     });
</script>
<style>
.optbtns{
	margin:0px 5px;
}
</style>
		
        