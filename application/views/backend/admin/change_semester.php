<?php echo form_open(site_url('admin/change_semester') , array('id' => 'semester_change'));?>
<li>
	
	<div class="form-group">
		<select name="semester" class="form-control" onchange="submit()">
		  	<?php $ns = $this->db->get_where('settings' , array('type'=>'number_of_semester'))->row()->description + 1;?>
		  	<option value=""><?php echo get_phrase('select_running_semester');?></option>
		  	<?php for($i = 1; $i < $ns; $i++):?>
		      	<option value="<?=$i?>"> <?=$i?> </option>
		  <?php endfor;?>
		</select>
	</div>
	
	
</li>
<?php echo form_close();?>



<script type="text/javascript">

    function submit()
    {
    	$('#semester_change').submit();
    }
	
</script>