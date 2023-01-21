<hr />
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#single_student" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('assign_single_student');?></span>
					</a>
				</li>
				<li>
					<a href="#mass_student" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('assign_mass_student');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
            <br>
				<div class="tab-pane active" id="single_student">

				<!-- creation of single subject -->
				<?php echo form_open(site_url('admin/subject_allocation/individual') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title"><?php echo get_phrase('student_information');?></div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                        <div class="col-sm-9">
                                            <select name="class_id" class="form-control selectboxit class_id" id='class_id'
                                                onchange="return get_class_students(this.value)">
                                                <option value=""><?php echo get_phrase('select_class');?></option>
                                                <?php 
                                                    $classes = $this->db->get('class')->result_array();
                                                    foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                                        <div class="col-sm-9">
                                            <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder" required
                                                onchange="return get_class_subjects(this.value)"
                                            >
                                                <option value=""><?php echo get_phrase('select_class_first');?></option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title"><?php echo get_phrase('student_subjects');?></div>
                                </div>
                                <div class="panel-body" id='subject_selection_holder'>
                                    <!-- Ajax call is made -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-info submit"><?php echo get_phrase('save');?></button>
                                </div>
                            </div>
                        </div>


                    </div>
	            <?php echo form_close();?>

				<!-- creation of single subject -->
					
				</div>
				<div class="tab-pane" id="mass_student">

				<!-- creation of mass subject -->
				<?php echo form_open(site_url('admin/subject_allocation/create_mass_subject') , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-9">
                                    <select name="class_id" class="form-control class_id2" id="class_id2"
                                        onchange="return get_class_students_mass(this.value)" required="">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                        <?php 
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php endforeach;?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('student_subjects');?></label>
                                <div class="col-sm-9">
                                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_selection_holder2" required
                                        onchange="return get_students_subjects(this.value)"
                                    >
                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="student_selection_holder_mass"></div>
                        </div>
                    </div>
				<?php echo form_close();?>
				<!-- creation of mass subject -->

				</div>
				
			</div>
			
			
	</div>
</div>

<script type="text/javascript">

	function select() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = true ;
			}

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = false ;
			}
	}
</script>

<script type="text/javascript">
    function get_class_students(class_id) {
        if (class_id !== '') {
            $.ajax({
                url: '<?php echo site_url('admin/get_class_students/');?>' + class_id ,
                success: function(response)
                {
                    jQuery('#student_selection_holder').html(response);
                }
            });
        }
    }
    function get_class_subjects(student_id) {
        var class_id = $('#class_id').val();
        if (student_id !== '') {
            $.ajax({
                url: '<?php echo site_url('admin/get_class_subjects/');?>' + student_id + '/' + class_id,
                success: function(response)
                {
                    jQuery('#subject_selection_holder').html(response);
                }
            });
        }
    }
    
</script>
<script type="text/javascript">
var class_id = '';
jQuery(document).ready(function($) {
    $('.submit').attr('disabled', 'disabled');
    <?php
        if($this->uri->segment(3) !==  null){
            echo '$("#class_id").val('.$this->uri->segment(3).');';
            echo '$("#class_id2").val('.$this->uri->segment(3).');';
            echo 'get_class_students($("#class_id").val());';
            echo 'get_class_students_mass($("#class_id2").val());';
        }
    ?>
});
    function get_class_students_mass(class_id) {
    	if (class_id !== '') {
        $.ajax({
            url: '<?php echo site_url('admin/get_class_students_mass/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });
        $.ajax({
            url: '<?php echo site_url('admin/get_class_subject_mass/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder2').html(response);
            }
        });
      }
    }
    function get_students_subjects(subject_id) {
        var class_id = $('#class_id2').val();
    	if (class_id !== '') {
        $.ajax({
            url: '<?php echo site_url('admin/get_students_subjects/');?>' + class_id + '/' + subject_id,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });
      }
    }
    function check_validation(){
        if (class_id !== '') {
            $('.submit').removeAttr('disabled');
        }
        else{
            $('.submit').attr('disabled', 'disabled');
        }
    }
    $('.class_id').change(function(){
        class_id = $('.class_id').val();
        check_validation();
    });
</script>