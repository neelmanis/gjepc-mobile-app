<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><?php echo $breadcrumb;?></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $breadcrumb;?></li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $breadcrumb;?></h4>
                
                <form class="form-material" id="onspot-form">
                	<div class="row">	
                    <div class="form-group col-md-4">
                        <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT EXHIBITOR</strong></label>
                        <div class="col-sm-12">
                            <div class="row-sm-12">
                                <select class="form-control" name="exhibitor_code" id="exhibitor_code">                            
                                <option value="">SELECT EXHIBITOR</option>
                                <?php foreach($exhibitors as $ed){ ?>
                                <option value="<?php echo $ed->Exhibitor_Code; ?>"><?php echo strtoupper($ed->Exhibitor_Name); ?></option>
                                <?php } ?>
                                </select>
                                <label for="exhibitor_code" generated="true" class="error"></label>
                            </div>
                        </div>                        
                    </div>			
					<div class="form-group col-md-4">
                        <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT VENDOR</strong></label>
                        <div class="col-sm-12">
                            <div class="row-sm-12">
                                <select class="form-control" name="vendor_id" id="vendor_id">                            
                                <option value="">SELECT VENDOR</option>
                                <?php foreach($vendorUser as $vd){ ?>
                                <option value="<?php echo $vd->id; ?>"><?php echo strtoupper($vd->contact_name); ?></option>
                                <?php } ?>
                                </select>
                                <label for="vendor_id" generated="true" class="error"></label>
                            </div>
                        </div>                        
                    </div>
					<!--<div class="form-group col-md-4">
                        <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT Department</strong></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="department_id" id="department_id">                            
                              <option value="">SELECT Department</option>
							  <?php foreach($dept as $val){ ?>
							  <option value="<?php echo $val->id; ?>" <?php if($val->id == $onspot_visitor[0]->department_id){ echo 'selected'; }?>><?php echo strtoupper($val->name); ?></option>
							  <?php } ?>
							</select>	
							<label for="department_id" generated="true" class="error"></label>
                        </div>                        
                    </div>-->
                    </div>
					<div class="row">	
                        <div class="form-group col-md-4">
                            <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT ISSUE</strong></label>
                            <div class="col-sm-12">
                                <div class="row-sm-12">
                                    <select class="form-control" name="issue_id" id="issue_id">                            
                                    <option value="">SELECT ISSUE</option>
                                    <?php foreach($issue as $i){ ?>
                                    <option value="<?php echo $i->id; ?>"><?php echo strtoupper($i->issue_name); ?></option>
                                    <?php } ?>
                                    </select>
                                    <label for="issue_id" generated="true" class="error"></label>
                                </div>
                            </div>                        
                        </div>	
                        <div class="form-group col-md-4">
                            <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT Priority</strong></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="priority_id" id="priority_id">                            
                                <option value="">SELECT Priority</option>
                                <?php foreach($priorities as $priority){ ?>
                                <option value="<?php echo $priority->id; ?>" <?php if($priority->id == $onspot_visitor[0]->priority_id){ echo 'selected'; }?>><?php echo strtoupper($priority->name); ?></option>
                                <?php } ?>
                                </select>	
                                <label for="priority_id" generated="true" class="error"></label>
                            </div>                        
                        </div>					
                        <div class="form-group col-md-4">
                            <label for="example-search-input" class="col-sm-12 col-form-label"><strong>SELECT Status</strong></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="statuses" id="statuses">                            
                                <option value="">SELECT STATUS</option>
                                <?php foreach($statuses as $val){ ?>
                                <option value="<?php echo $val->id; ?>" <?php if($val->id == 1){ echo 'selected'; }?>><?php echo strtoupper($val->name); ?></option>
                                <?php } ?>
                                </select>	
                                <label for="statuses" generated="true" class="error"></label>
                            </div>                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-12 col-form-label"><strong>SUBJECT </strong></label>
                        <div class="col-sm-12">
                         <input class="form-control" type="text" name="subject" id="subject" value="<?php echo $onspot_visitor[0]->subject; ?>">
                        <label for="subject" generated="true" class="error"></label>
                        </div>                        
					</div>
                   
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-12 col-form-label"><strong>Ticket Summary </strong></label>
                        <div class="col-sm-12">
                        <textarea class="form-control" name="description" id="description" rows="10" style="height:50%;"><?php echo $onspot_visitor[0]->description; ?></textarea>
                        <label for="description" generated="true" class="error"></label>
                        </div>                     
					</div>
					
                    <div class="form-group row">                        
                        <div class="col-10">
                            <input class="btn btn-success" type="submit" name="submit" value="Submit">
                            <button class="btn " type="Reset">Reset</button>
                        </div>
                    </div>                    
                    
                </form>
            </div>
        </div>
    </div>
</div>