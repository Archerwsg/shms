<?php
$member_info	=	$this->db->get_where('enroll' , array(
    'member_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
    ))->result_array();
foreach($member_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('member' , $row['member_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3>
                                <?php echo $this->db->get_where('member' , array('member_id' => $param2))->row()->name;?>                     
                            </h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <?php if($row['cell_id'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('cell');?></td>
                        <td><b><?php echo $this->crud_model->get_cell_name($row['cell_id']);?></b></td>
                    </tr>
                    <?php endif;?>


                    <tr>
                        <td><?php echo get_phrase('id');?></td>
                        <td><b><?php echo $this->db->get_where('member',array('member_id'=>$row['member_id']))->row()->member_code;?><</b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('birthday');?></td>
                        <td><b><?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->birthday;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('gender');?></td>
                        <td><b><?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->sex;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('phone');?></td>
                        <td><b><?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->phone;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('email').'/'.get_phrase('username');?></td>
                        <td><b><?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->email;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('address');?></td>
                        <td><b><?php echo $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->address;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('carer');?></td>
                        <td>
                            <b>
                                <?php 
                                    $carer_id = $this->db->get_where('member' , array('member_id' => $row['member_id']))->row()->carer_id;
                                    echo $this->db->get_where('carer' , array('carer_id' => $carer_id))->row()->name;
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('carer_phone');?></td>
                        <td><b><?php echo $this->db->get_where('carer' , array('carer_id' => $carer_id))->row()->phone;?></b></td>
                    </tr>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>