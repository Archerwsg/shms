<div class="row">
	<div class="col-md-8">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('member_information_form'); ?>
				</div>
			</div>
			<div class="panel-body">

				<?php echo form_open(site_url('admin/member/create/'), array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
				<div class="form-group">
					<p class="card-title">
					<h3>Primary Information </h3>
					</p>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus required>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('select_carer'); ?></label>

					<div class="col-sm-5">
						<select name="carer_id" class="form-control select2" required>
							<option value=""><?php echo get_phrase('select'); ?></option>
							<?php
							$carers = $this->db->get('carer')->result_array();
							foreach ($carers as $row) :
							?>
								<option value="<?php echo $row['carer_id']; ?>">
									<?php echo $row['name']; ?>
								</option>
							<?php
							endforeach;
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('cell'); ?></label>

					<div class="col-sm-5">
						<select name="cell_id" class="form-control" data-validate="required" id="cell_id" data-message-required="<?php echo get_phrase('value_required'); ?>" onchange="return get_class_sections(this.value)">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<?php
							$cells = $this->db->get('cell')->result_array();
							foreach ($cells as $row) :
							?>
								<option value="<?php echo $row['cell_id']; ?>">
									<?php echo $row['name']; ?>
								</option>
							<?php
							endforeach;
							?>
						</select>
					</div>
				</div>

				<!-- <div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
					<div class="col-sm-5">
						<select name="section_id" class="form-control" id="section_selector_holder">
							<option value=""><?php echo get_phrase('select_class_first'); ?></option>

						</select>
					</div>
				</div> -->

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_no'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="member_code" value="<?php echo  'UCI';
																							echo rand(10, 1000); ?>" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required'); ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

					<div class="col-sm-5">
						<select name="sex" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="male"><?php echo get_phrase('male'); ?></option>
							<option value="female"><?php echo get_phrase('female'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="age" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus required>
					</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('occupation'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="occupation" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus required>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('ministry'); ?></label>

					<div class="col-sm-5">
						<select name="ministry" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="protocol"><?php echo get_phrase('protocol'); ?></option>
							<option value="media"><?php echo get_phrase('media'); ?></option>
							<option value="prayer_warriors"><?php echo get_phrase('prayer_warriors'); ?></option>
							<option value="temples"><?php echo get_phrase('temples'); ?></option>
							<option value="deacon"><?php echo get_phrase('deacon'); ?></option>
							<option value="ushers"><?php echo get_phrase('ushers'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('residential_address'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="address" value="">
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="phone" value="">
					</div>
				</div>

				<div class="form-group">
					<p class="card-title">
					<h3> Secondary Information </h3>
					</p>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('baptismal_status'); ?></label>

					<div class="col-sm-5">
						<select name="baptismal_status" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="baptised"><?php echo get_phrase('baptised'); ?></option>
							<option value="not_baptised"><?php echo get_phrase('not_baptised'); ?></option>
						</select>
					</div>
				</div>




				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('foundation_school'); ?></label>

					<div class="col-sm-5">
						<select name="foundation_school" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="completed"><?php echo get_phrase('completed'); ?></option>
							<option value="not_started"><?php echo get_phrase('not_started'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('marital_status'); ?></label>

					<div class="col-sm-5">
						<select name="marital_status" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="single"><?php echo get_phrase('single'); ?></option>
							<option value="married"><?php echo get_phrase('married'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('tongues_speaking_status'); ?></label>

					<div class="col-sm-5">
						<select name="tongues_speaking_status" class="form-control selectboxit">
							<option value=""><?php echo get_phrase('select'); ?></option>
							<option value="yes"><?php echo get_phrase('yes'); ?></option>
							<option value="no"><?php echo get_phrase('no'); ?></option>
						</select>
					</div>
				</div>

				 <div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email') . '/' . get_phrase('username'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="">
					</div>
				</div>

				<!--<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>

					<div class="col-sm-5">
						<input type="password" class="form-control" name="password" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="">
					</div>
				</div> -->


				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('hometown'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="hometown" value="">
					</div>
				</div>

				<div class="form-group">

					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('associated_family_name'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="associated_family_name" value="">
					</div>
				</div>

				<div class="form-group">

					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('associated_family_phone'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="associated_family_phone" value="">
					</div>


				</div>


				<div class="form-group">

					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('relationship'); ?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="relationship" value="">
					</div>
				</div>


					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo'); ?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_member'); ?></button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<blockquote class="blockquote-blue">
				<p>
					<strong>Member registration notes</strong>
				</p>
				<p>
					
				</p>
			</blockquote>
		</div>

	</div>

	<script type="text/javascript">
		function get_cell_sections(cell_id) {

			$.ajax({
				url: '<?php echo site_url('admin/get_cell_section/'); ?>' + cell_id,
				success: function(response) {
					jQuery('#section_selector_holder').html(response);
				}
			});

		}
	</script>