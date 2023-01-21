<?php 
$edit_data		=	$this->db->get_where('enroll' , array(
	'member_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-17">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_member');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/member/do_update/'.$row['member_id'].'/'.$row['cell_id'])  , array('cell' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('member' , $row['member_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
								value="<?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('cell');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class" disabled
								value="<?php echo $this->db->get_where('cell' , array('cell_id' => $row['cell_id']))->row()->name; ?>">
						</div>
					</div>

	

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('id');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="member_code"
								value="<?php echo $this->db->get_where('member' , array(
                                    'member_id' => $row['member_id']
                                ))->row()->member_code;?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('carer');?></label>
                        
						<div class="col-sm-5">
							<select name="carer_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$carers = $this->db->get('carer')->result_array();
									$carer_id = $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->carer_id;
									foreach($carers as $row3):
										?>
                                		<option value="<?php echo $row3['carer_id'];?>"
                                        	<?php if($row3['carer_id'] == $carer_id)echo 'selected';?>>
													<?php echo $row3['name'];?>
                                                </option>
	                                <?php
									endforeach;
								  ?>
                          </select>
						</div> 
					</div>

					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" 
								value="<?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->birthday; ?>" 
									data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
							<?php
								$gender = $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->sex;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($gender == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($gender == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('ministry');?></label>
                        
						<div class="col-sm-5">
							<select name="ministry" class="form-control selectboxit">
							<?php
								$ministry = $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->ministry;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="protocol" <?php if($ministry == 'protocol')echo 'selected';?>><?php echo get_phrase('protocol');?></option>
                              <option value="media"<?php if($ministry == 'media')echo 'selected';?>><?php echo get_phrase('media');?></option>
							  <option value="prayer_warriors"<?php if($ministry == 'prayer_warriors')echo 'selected';?>><?php echo get_phrase('prayer_warriors');?></option>
							  <option value="ushers"<?php if($ministry == 'ushers')echo 'selected';?>><?php echo get_phrase('ushers');?></option>
							  <option value="temples"<?php if($ministry == 'temples')echo 'selected';?>><?php echo get_phrase('temples');?></option>
							  <option value="deacon"<?php if($ministry == 'deacon')echo 'selected';?>><?php echo get_phrase('deacon');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('residential_address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" 
								value="<?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->address; ?>" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" 
								value="<?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->phone; ?>" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email').'/'.get_phrase('username');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" 
								value="<?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->email; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('baptismal_status');?></label>
                        
						<div class="col-sm-5">
							<select name="baptismal_status" class="form-control selectboxit">
							<?php
								$baptismal_status = $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->baptismal_status;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="protocol" <?php if($ministry == 'protocol')echo 'selected';?>><?php echo get_phrase('protocol');?></option>
                              <option value="media"<?php if($ministry == 'media')echo 'selected';?>><?php echo get_phrase('media');?></option>
							  <option value="prayer_warriors"<?php if($ministry == 'prayer_warriors')echo 'selected';?>><?php echo get_phrase('prayer_warriors');?></option>
							  <option value="ushers"<?php if($ministry == 'ushers')echo 'selected';?>><?php echo get_phrase('ushers');?></option>
							  <option value="temples"<?php if($ministry == 'temples')echo 'selected';?>><?php echo get_phrase('temples');?></option>
							  <option value="deacon"<?php if($ministry == 'deacon')echo 'selected';?>><?php echo get_phrase('deacon');?></option>
                          </select>
						</div> 
					</div>

				

					
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_member');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

