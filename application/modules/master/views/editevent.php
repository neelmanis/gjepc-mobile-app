<div class="form-panel">
        <h4 class="mb">Edit Event Details</h4>
		
			<?php
			if(is_array($editevent)){
            foreach($editevent as $row){
			 //echo '<pre>';print_r($row);
			?>
		<form method="post" class="form-horizontal style-form categoryform" action="<?php echo base_url("master/updateEvent");?>" >
		
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Event</label>
		    <div class="col-sm-9">
				<input type="text" name="event" id="event" value="<?php echo $row->event;?>"  class="form-control" value=""/>
			</div>
			</div>
			
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Status</label>
		    <div class="col-sm-9">
			<select class="form-control" name="status">
				<option value="1" <?php if($row->status=="1") echo 'selected="selected"';?> >Active</option>
				<option value="0" <?php if($row->status=="0") echo 'selected="selected"';?> >Inactive</option>
			</select>

			</div>
			</div>
			<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $row->id?>">
			<input type="submit" class="btn btn-primary" name="submit" value="Update">
			</div>
			</form>			

		  <?php
				}
			 } 
			?> 
</div>

        