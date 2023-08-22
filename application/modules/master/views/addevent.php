<div class="form-panel">
        <h4 class="mb">Add Event Details</h4>
			 
		<form method="post" class="form-horizontal style-form categoryform" action="<?php echo base_url("master/addEventDetails");?>" />		
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Title</label>
		    <div class="col-sm-9">
				<input type="text" name="event" id="event" class="form-control" value="" required/>
			</div>
			</div>
			
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Status</label>
		    <div class="col-sm-9">
			<select class="form-control" name="status">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			</select>
			</div>
			</div>
			
			<div class="form-group">
			<input type="submit" class="btn btn-primary" name="submit" value="ADD">
			</div>
			</form>			
</div>
		
        