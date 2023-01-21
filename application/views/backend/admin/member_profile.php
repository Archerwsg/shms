<style>
  .exam_chart {
    width: 100%;
    height: 265px;
    font-size: 11px;
  }
</style>

<?php
$member_info = $this->db->get_where('member', array('member_id' => $member_id))->result_array();
foreach ($member_info as $row) :
  $enroll_info = $this->db->get_where('enroll', array(
    'member_id' => $row['member_id'], 'year' => $running_year
  ));
  $cell_id = $enroll_info->row()->cell_id;

?>
  <div class="profile-env">
    <header class="row">
      <div class="col-md-3">
        <center>
          <a href="#">
            <img src="<?php echo $this->crud_model->get_image_url('member', $member_id); ?>" class="img-circle" style="width: 60%;" />
          </a>
          <br>
          <h3>
            <?php echo $row['name']; ?>
          </h3>
          <br>
          <span>
            <?php
            $cell_name = $this->db->get_where('cell', array(
              'cell_id' => $enroll_info->row()->cell_id
            ))->row()->name;

            ?>
            <a href="<?php echo site_url('admin/member_information/' . $enroll_info->row()->cell_id); ?>">
              <?php echo get_phrase('cell') . ' - ' . $cell_name; ?>
            </a>
          </span>
        </center>
      </div>
      <div class="col-md-9">

        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
              <span class="visible-xs"><i class="entypo-home"></i></span>
              <span class="hidden-xs"><?php echo get_phrase('basic_info'); ?></span>
            </a>
          </li>
          <li class="">
            <a href="#tab2" data-toggle="tab" class="btn btn-default">
              <span class="visible-xs"><i class="entypo-user"></i></span>
              <span class="hidden-xs"><?php echo get_phrase('secondary_info'); ?></span>
            </a>
          </li>
          <li class="">
            <a href="#tab3" data-toggle="tab" class="btn btn-default">
              <span class="visible-xs"><i class="entypo-user"></i></span>
              <span class="hidden-xs"><?php echo get_phrase('carer_info'); ?></span>
            </a>
          </li>

          <!-- <li class="">
				<a href="#tab4" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs"><?php //echo get_phrase('attendance'); 
                                  ?></span>
				</a>
			</li> -->

        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="tab1">
            <?php
            $basic_info_titles = ['name', 'carer', 'cell', 'email', 'phone', 'residential_address', 'gender', 'birthday', 'age', 'occupation', 'ministry'];
            $basic_info_values = [
              $row['name'], $row['carer_id'] == NULL ? '' : $this->db->get_where('carer', array('carer_id' => $row['carer_id']))->row()->name,
              $cell_name,  $row['email'], $row['phone'] == NULL ? '' : $row['phone'], $row['address'] == NULL ? '' : $row['address'], $row['sex'] == NULL ? '' : $row['sex'],
              $row['birthday'], $row['age'], $row['occupation'], $row['ministry']
            ];

            ?>
            <table class="table table-bordered" style="margin-top: 20px;">
              <tbody>
                <?php for ($i = 0; $i < count($basic_info_titles); $i++) { ?>
                  <tr>
                    <td width="30%">
                      <strong><?php echo get_phrase($basic_info_titles[$i]); ?></strong>
                    </td>
                    <td><?php echo $basic_info_values[$i]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane active" id="tab2">
            <?php
            $secondary_info_titles = ['baptismal_status', 'foundation_school', 'marital_status', 'hometown', 'associated_family_name', 'associated_family_phone', 'relationship'];
            $secondary_info_values = [
              $row['baptismal_status'], $row['foundation_school'], $row['marital_status'], $row['hometown'],
              $row['associated_family_name'], $row['associated_family_phone'], $row['relationship'],
            ];

            ?>
            <table class="table table-bordered" style="margin-top: 20px;">
              <tbody>
                <?php for ($i = 0; $i < count($secondary_info_titles); $i++) { ?>
                  <tr>
                    <td width="30%">
                      <strong><?php echo get_phrase($secondary_info_titles[$i]); ?></strong>
                    </td>
                    <td><?php echo $secondary_info_values[$i]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="tab3">
            <?php if ($row['carer_id'] == NULL) { ?>
              <div style="margin-top: 20px;">
                <center>
                  <?php echo get_phrase('carer_information_is_not_available'); ?>
                </center>
              </div>
            <?php } else {
              $carer_info = $this->db->get_where('carer', array('carer_id' => $row['carer_id']))->result_array();
              $carer_info_titles = ['name', 'email', 'phone', 'address', 'profession'];
              foreach ($carer_info as $info) {
                $carer_info_values = [
                  $info['name'], $info['email'], $info['phone'] == NULL ? '' : $info['phone'],
                  $info['address'] == NULL ? '' : $info['address'], $info['profession'] == NULL ? '' : $info['profession']
                ];
              }
            ?>
              <table class="table table-bordered" style="margin-top: 20px;">
                <tbody>
                  <?php for ($i = 0; $i < count($carer_info_titles); $i++) { ?>
                    <tr>
                      <td width="30%"><strong><?php echo get_phrase($carer_info_titles[$i]); ?></strong></td>
                      <td><?php echo $carer_info_values[$i]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
          </div>


          <br>

        </div>
    </header>
  </div>
<?php endforeach; ?>