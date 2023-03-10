<hr />
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('create_single_invoice');?></span>
					</a>
				</li>
				<li>
					<a href="#paid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('create_mass_invoice');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
            <br>
				<div class="tab-pane active" id="unpaid">

				<!-- creation of single invoice -->
				<?php echo form_open(site_url('accountant/invoice/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="row">
					<div class="col-md-6">
	                        <div class="panel panel-default panel-shadow" data-collapsed="0">
	                            <div class="panel-heading">
	                                <div class="panel-title"><?php echo get_phrase('invoice_informations');?></div>
	                            </div>
	                            <div class="panel-body">
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                        <div class="col-sm-9">
                                            <select name="class_id" class="form-control  class_id"
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
                                            <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder" required>
                                                <option value=""><?php echo get_phrase('select_class_first');?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="title"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="description"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="datepicker form-control" name="date"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                        </div>
                                    </div>
                                    
                                </div>
	                        </div>
	                    </div>

	                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('payment_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('total');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo get_phrase('enter_payment_amount');?>"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control selectboxit">
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                            <option value="partial_payment"><?php echo get_phrase('partial payment');?></option>
                                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control selectboxit">
                                            <option value="1"><?php echo get_phrase('cash');?></option>
                                            <option value="2"><?php echo get_phrase('check');?></option>
                                            <option value="3"><?php echo get_phrase('card');?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info submit"><?php echo get_phrase('add_invoice');?></button>
                            </div>
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
</script>

<script type="text/javascript">
var class_id = '';
jQuery(document).ready(function($) {
    $('.submit').attr('disabled', 'disabled');
});
    
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