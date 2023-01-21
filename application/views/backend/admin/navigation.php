<div class="sidebar-menu">
    <header class="logo-env" >
        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo site_url('login'); ?>">
                <img src="<?php echo base_url('uploads/logo.png');?>"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
        <li id="search">
  				<form class="" action="<?php echo site_url($account_type . '/student_details'); ?>" method="post">
  					<input type="text" class="search-input" name="student_identifier" placeholder="<?php echo get_phrase('member_name').' / '.get_phrase('code').'...'; ?>" value="" required style="font-family: 'Poppins', sans-serif !important; background-color: #2C2E3E ; color: #868AA8; border-bottom: 1px solid #3F3E5F;">
  					<button type="submit">
  						<i class="entypo-search"></i>
  					</button>
  				</form>
			  </li>

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- ADMINS -->
        <li class="<?php if ($page_name == 'admin') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/admin'); ?>">
                <i class="fa fa-user-secret"></i>
                <span><?php echo get_phrase('admin'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php if ($page_name == 'member_add' ||
                                $page_name == 'member_bulk_add' ||
                                    $page_name == 'member_information' ||
                                        $page_name == 'member_subjects' ||
                                            $page_name == 'member_marksheet' ||
                                                $page_name == 'member_promotion' ||
                                                    $page_name == 'member_profile')
                                                    echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('members'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'member_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/member_add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_member'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'member_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/member_bulk_add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_member'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'member_information' || $page_name == 'member_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('member_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $division = $this->db->get('zone_divisions')->result_array();
                        foreach ($division as $rowr):
                            $cells = $this->db->where('zone_divisions_id' , $rowr['id'] )->get('cell')->result_array();
                            ?>
                            <li class="<?php if ($page_name == 'member_information' && in_array($cell_id , array_column($cells, 'cell_id')) ) echo 'opened active'; ?> ">
                                <a href="#">
                                    <!-- <i class="entypo-docs"></i> -->
                                    <span><?=$rowr['name'];?></span>
                                </a>
                                <ul>
                                    <?php foreach ($cells as $row): ?>
                                        <li class="<?php if ($page_name == 'member_information' && $cell_id == $row['cell_id']) echo 'active'; ?>">
                                            <a href="<?=site_url('admin/member_information/' . $row['cell_id']); ?>">
                                                <span><?=get_phrase('cell');?> <?=$row['name']; ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </li>

                <!-- STUDENT Subjects -->
                
                <!-- STUDENT PROMOTION -->
               

            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'usher') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/usher'); ?>">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('usher'); ?></span>
            </a>
        </li>

        <!-- PARENTS -->
        <li class="<?php if ($page_name == 'carer') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/carer'); ?>">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('carers'); ?></span>
            </a>
        </li>

        <!-- LIBRARIAN -->
        <li class="<?php if ($page_name == 'visitor') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/visitor'); ?>">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('visitor'); ?></span>
            </a>
        </li>

        <!-- ACCOUNTANT -->
        <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/accountant'); ?>">
                <i class="entypo-briefcase"></i>
                <span><?php echo get_phrase('accountant'); ?></span>
            </a>
        </li>

        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'cell' ||
                $page_name == 'section' ||
                    $page_name == 'academic_syllabus')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('cell_management_system'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'cell') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/zone_divisions'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_zone_divisions'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'cell') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/cells'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_cells'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/section'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/academic_syllabus'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('academic_syllabus'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
      

       

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view' || $page_name == 'attendance_report' || $page_name == 'attendance_report_view')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>

                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('daily_atendance'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/attendance_report'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>

            </ul>
        </li> 



        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
              $page_name == 'manage_language' ||
                $page_name == 'sms_settings'||
                  $page_name == 'payment_settings')
                    echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/system_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/sms_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/manage_language'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'payment_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/payment_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('payment_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- FRONTEND SETTINGS -->
       

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
