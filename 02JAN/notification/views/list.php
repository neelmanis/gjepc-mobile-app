<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel">
        	<h4>View Notification</h4>
             <div style="display: none;" class="form_error"></div>
         <div style="display: none;" class="form_success"></div>

	        <section id="no-more-tables">
	            <table class="table table-striped table-condensed cf" id='bannerTable'>
	            <thead class="cf">
					<tr>
                      <th class="head0 nosort"><input type="checkbox" id="allchk"  class="checkall" /></th>
					  	<th>ID</th>
					  	<th>Device ID</th>
                        <th>Device Type</th>
					</tr>
				</thead>

				<tbody>
				<?php 
					$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
					if(is_array($getAllusers) && !empty($getAllusers)){						
						foreach($getAllusers as $val)
						{ 
					     if($val->isActive == 1){$status="Active";}else{$status="Deactive";}
						 if($val->deviceType == 'A'){$device="Android";}else{$device="iPhone";}
				?> 
					<tr>
                    <td class="aligncenter"><span class="center">
                            <input type="checkbox" class="checkbox1" name="chk[]" id="deviceIds" value='<?php echo $val->id;?>' />
                          </span></td>
					  	<td data-title="Name"><?php echo $val->id;?></td>
                        <td data-title="Order"><?php echo $val->deviceId;?></td>
                        <td data-title="Order"><?php echo $val->deviceType;?></td>
					</tr>
				<?php
					} }
				?>
				</tbody>
	        </table>     
            
               <div>                                
                <textarea class="newTextArea" rows="10" id="txtmsg" name="message" cols="100" placeholder="Type message"></textarea>
            </div>
            <div>
                <input id="btnsubmit" type="button"  value="Send Push Notification" /></div>
        </div>   	
        </div>
    </div>
</div>

<script>				
	$(document).ready(function(){
		$('#bannerTable').DataTable();
		$('body').delegate('.deleterows','click',function(e){
			e.preventDefault();
			var user_id = this.id;
			  $.ajax({
				type:"POST",
				url:"<?php echo base_url();?>users/delete_user",
				data:{user_id:user_id},
				success:function(result){
					alert("Category De-active successfuly..");
					location.reload(true);
				}
			}) 
		});
	});			
</script>	
 <script> 
jQuery(document).ready(function() {
    jQuery('#allchk').click(function(event) { 

        if(this.checked) { 	 
					jQuery('.checkbox1').prop('checked', true);//on click 
					jQuery('.checkbox1').parents('span').addClass('checked');
        }else{
				 jQuery('.checkbox1').prop('checked', false);//on click 
				jQuery('.checkbox1').parents('span').removeClass('checked');        
        }
    });
    
});
</script>	
<script>
$(document).ready(function(){
            $("#btnsubmit").click(function ()
                { 
                    var message=$("#txtmsg").val();
                     var Ids = $("#deviceIds:checked").map(function(){
                        return $(this).val();
                                  }).get();
                        if(message=="")
                        {                           
                            $(window).scrollTop(0);
				            $(".form_error").css("display","block");
				            $(".form_error").html("Please enter message.").delay(1000).fadeOut(5000);
                        }
                        else if(Ids.length==0)
                        {
                            $(window).scrollTop(0);
				            $(".form_error").css("display","block");
				            $(".form_error").html("Please select device").delay(1000).fadeOut(5000);            
                        }
                        else
                        {                         
                            $.ajax(
                            {
                            url:"<?php echo base_url();?>notification/SendMessage",
                            type:"POST",
                            data:{
                                sendMessage:message,
                                sendIds:Ids                    
                                    },
                                    success:function (data)
                                    { 
                                        if(data == 1)
                                        {       
											$(window).scrollTop(0);
											$(".form_success").css("display","block");
											$(".form_success").html("Notification sent").delay(1000).fadeOut(5000);
                                        }
                                        else
                                        {    
											$(window).scrollTop(0);
											$(".form_error").css("display","block");
											$(".form_error").html("Failed to send message "+data).delay(1000).fadeOut(5000);
                                        }
                                         $("#fadeMe").hide();
                                    }

                        });
                        }                  

                });
        });
</script>