

<div class="form-panel">
        <h4 class="mb">Registration</h4>
			 
			<form method="post" id="form1" class="form-horizontal style-form categoryform" action="<?php echo base_url("test/addRegistrationDetails");?>" >	
			
			<span id="chkregisuser">
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Email</label>
		    <div class="col-sm-9">
				<input type="text" name="email" id="email" class="form-control" />
			</div>
			</div>
			
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Username</label>
		    <div class="col-sm-9">
				<input type="text" name="username" id="username" class="form-control" />
			</div>
			</div>
			
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Password</label>
		    <div class="col-sm-9">
				<input type="text" name="password" id="password" class="form-control" />
			</div>
			</div>

			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Status</label>
		    <div class="col-sm-9">
			<select class="form-control" name="status" id="status">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			</select>
			</div>
			</div>
			
			<div class="form-group">
			<input type="submit" class="btn btn-primary" name="submit" id="regis" value="ADD">
			</div>
			</form>			
</div>

<script src="<?php echo base_url('assets/js/jquery.validate.js')?>" type="text/javascript"></script> 
<script type="text/javascript">
$(document).ready(function() {
    $("#form1").validate({
        rules: {
           email: {
				required: true,
				email:true
			},
			username: {
			required: true,
			},
			password: {
			required: true,
			} 
        },
        messages: {
            email: {
				required: "Please Enter a valid Email id",
			},
			username: {
				required: "Please Enter Username",
			},
			password: {
				required: "Please Enter Password",
			}
			
        },
});
});
</script>	
