<hr />

<?php echo form_open(site_url('admin/attendance_selector/'));?>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('cell');?></label>
			<select name="cell_id" class="form-control selectboxit" onchange="select_section(this.value)" id = "cell_selection">
				<option value=""><?php echo get_phrase('select_cell');?></option>
				<?php
					$cells = $this->db->get('cell')->result_array();
					foreach($cells as $row):
                                            
				?>
                                
				<option value="<?php echo $row['cell_id'];?>"
					><?php echo $row['name'];?></option>
                                
				<?php endforeach;?>
			</select>
		</div>
	</div>

	
    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section');?></label>
			<select class="form-control selectboxit" name="section_id">
                            <option value=""><?php echo get_phrase('select_class_first') ?></option>
				
			</select>
		</div>
	</div>
    </div>
	
        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date');?></label>
			<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_attendance');?></button>
	</div>

</div>
<?php echo form_close();?>

<script type="text/javascript">
var cell_selection = "";
jQuery(document).ready(function($) {
	$('#submit').attr('disabled', 'disabled');
});

function select_section(cell_id) {
	if(cell_id !== ''){
		$.ajax({
			url: '<?php echo site_url('admin/get_section/'); ?>' + cell_id,
			success:function (response)
			{

			jQuery('#section_holder').html(response);
			}
		});
	}
}

function check_validation(){
	if(cell_selection !== ''){
		$('#submit').removeAttr('disabled')
	}
	else{
		$('#submit').attr('disabled', 'disabled');
	}
}

$('#cell_selection').change(function(){
	cell_selection = $('#cell_selection').val();
	check_validation();
});
</script>