

<div class="form-panel">
        <h4 class="mb">Add Laboratories Details</h4>
			 
			<form method="post" id="form1" class="form-horizontal style-form categoryform" action="<?php echo base_url("test/addtestDetails");?>" >		
			<span id="chkregisuser">
			<div class="form-group">
	       	<label class="col-sm-3 control-label" for="username">Email</label>
		    <div class="col-sm-9">
				<input type="text" name="email" id="email" class="form-control" />
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

<script src="<?php echo base_url('assets/js/jquery.validate.js')?>" type="text/javascript"></script> 
<script type="text/javascript">
$(document).ready(function() {
    $("#form1").validate({
        rules: {
            email: "required",
			email:true
            
        },
        messages: {
            email: "Enter Email"
			
        },
});
});
</script>	
<script>
$(document).ready(function(){
  $("#email").change(function(){
	email=$("#email").val();
	$.ajax({ type: 'POST',
					url: "<?php echo base_url()?>test/addtestDetails",
					data: "actiontype=chkregisuser&email="+email,
					dataType:'html',
					beforeSend: function(){
							},
					success: function(data){
							   //  alert(data);
							    $("#chkregisuser").html(data);  
							}
		});
 });
});
</script>