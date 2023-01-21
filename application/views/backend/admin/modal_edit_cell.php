<?php 
$edit_data		=	$this->db->get_where('cell' , array('cell_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_cell');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(site_url('admin/cells/do_update/'.$row['cell_id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
  
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('usher');?></label>
                        <div class="col-sm-5">
                            <select name="usher_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $ushers = $this->db->get('usher')->result_array();
                                foreach($ushers as $row2):
                                ?>
                                    <option value="<?php echo $row2['usher_id'];?>"
                                        <?php if($row['usher_id'] == $row2['usher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('zone_divisions');?></label>
                        <div class="col-sm-5">
                            <select name="zone_divisions_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $zone_divisions = $this->db->get('zone_divisions')->result_array();
                                foreach($zone_divisions as $row3):
                                ?>
                                    <option value="<?php echo $row3['id'];?>"
                                        <?php if($row['zone_divisions_id'] == $row3['id'])echo 'selected';?>>
                                            <?php echo $row3['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_cell');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


