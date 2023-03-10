<hr />
<?php echo form_open(site_url('admin/marks_selector_assessment'));?>
<div class="row">

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('assessment');?></label>
			<select name="assessment_id" class="form-control selectboxit" required>
				<?php
					$assessments = $this->db->get_where('assessment' , array('year' => $running_year))->result_array();
					foreach($assessments as $row):
				?>
				<option value="<?php echo $row['assessment_id'];?>"
					<?php if($assessment_id == $row['assessment_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"
					<?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder">
		<div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
				<select name="section_id" id="section_id" class="form-control selectboxit">
					<?php 
						$sections = $this->db->get_where('section' , array(
							'class_id' => $class_id 
						))->result_array();
						foreach($sections as $row):
					?>
					<option value="<?php echo $row['section_id'];?>" 
						<?php if($section_id == $row['section_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('subject');?></label>
				<select name="subject_id" id="subject_id" class="form-control selectboxit">
					<?php 
						$subjects = $this->db->get_where('subject' , array(
							'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
						))->result_array();
						foreach($subjects as $row):
					?>
					<option value="<?php echo $row['subject_id'];?>"
						<?php if($subject_id == $row['subject_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info"><?php echo get_phrase('manage_marks');?></button>
			</center>
		</div>
	</div>

</div>
<?php echo form_close();?>

<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('marks_for');?> <?php echo $this->db->get_where('assessment' , array('assessment_id' => $assessment_id))->row()->name;?></h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('class');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
				<?php echo get_phrase('section');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #696969;">
				<?php echo get_phrase('subject');?> : <?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->name;?>
			</h4>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(site_url('admin/marks_update_assessment/'.$assessment_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id));?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo get_phrase('id');?></th>
						<th><?php echo get_phrase('name');?></th>
						<th><?php echo get_phrase('marks_obtained');?></th>
						<th><?php echo get_phrase('comment');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					$marks_of_students = $this->db->get_where('assessment_marks' , array(
						'class_id' => $class_id, 
							'section_id' => $section_id ,
								'year' => $running_year,
									'subject_id' => $subject_id,
										'assessment_id' => $assessment_id
					))->result_array();
					foreach($marks_of_students as $row):
				?>
					<tr>
						<td><?php echo $count++;?></td>

                        <td><?php echo $this->db->get_where('student',array('student_id'=>$row['student_id']))->row()->student_code;?></td>

						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
							<input type="number" class="form-control" max="<?=$row['mark_total']?>" name="marks_obtained_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['mark_obtained'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="comment_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['comment'];?>">
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>

		<center>
			<button type="submit" class="btn btn-success" id="submit_button">
				<i class="entypo-check"></i> <?php echo get_phrase('save_changes');?>
			</button>
		</center>
		<?php echo form_close();?>
		
	</div>
	<div class="col-md-2"></div>
</div>





<script type="text/javascript">
	function get_class_subject(class_id) {
	if (class_id !== '') {
	$.ajax({
            url: '<?php echo site_url('admin/marks_get_subject/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
	  }
	}
</script>