<hr />

<?php echo form_open(site_url('admin/attendance_selector/')); ?>
<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('cell'); ?></label>
            <select name="cell_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "cell_selection">
                <option value=""><?php echo get_phrase('select_class'); ?></option>
                <?php
                $cells = $this->db->get('cell')->result_array();
                foreach ($cells as $row):
                    ?>

                    <option value="<?php echo $row['cell_id']; ?>"
                            <?php if ($cell_id == $row['cell_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>


<div id="section_holder">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
            <select name="section_id" id="section_id" class="form-control selectboxit">
                <?php
                $sections = $this->db->get_where('section', array(
                            'cell_id' => $cell_id
                        ))->result_array();
                foreach ($sections as $row):
                    ?>
                    <option value="<?php echo $row['section_id']; ?>"
                            <?php if ($section_id == $row['section_id']) echo 'selected'; ?>>
                            <?php echo $row['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
</div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('date'); ?></label>
            <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy"
                   value="<?php echo date("d-m-Y", $timestamp); ?>"/>
        </div>
    </div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-3" style="margin-top: 20px;">
        <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('manage_attendance'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>






<hr />
<div class="row" style="text-align: center;">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-chart-area"></i></div>

            <h3 style="color: #696969;"><?php echo get_phrase('attendance_for_members'); ?> <?php echo $this->db->get_where('cell', array('cell_id' => $cell_id))->row()->name; ?></h3>
            <h4 style="color: #696969;">
                <?php echo get_phrase('section'); ?> <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?>
            </h4>
            <h4 style="color: #696969;">
                <?php echo date("d M Y", $timestamp); ?>
            </h4>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>

<center>
    <a class="btn btn-default" onclick="mark_all_present()">
        <i class="entypo-check"></i> <?php echo get_phrase('mark_all_present'); ?>
    </a>
    <a class="btn btn-default"  onclick="mark_all_absent()">
        <i class="entypo-cancel"></i> <?php echo get_phrase('mark_all_absent'); ?>
    </a>
</center>
<br>

<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

        <?php echo form_open(site_url('admin/attendance_update/'. $cell_id . '/' . $section_id . '/' . $timestamp)); ?>
        <div id="attendance_update">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('id'); ?></th>
                        <th><?php echo get_phrase('name'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    $attendance_of_members = $this->db->get_where('attendance', array(
                                'cell_id' => $cell_id,
                                'section_id' => $section_id,
                                'year' => $running_year,
                                'timestamp' => $timestamp
                            ))->result_array();


                    foreach ($attendance_of_members as $row):
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <?php echo $this->db->get_where('member', array('member_id' => $row['member_id']))->row()->member_code; ?>
                            </td>
                            <td>
                                <?php echo $this->db->get_where('member', array('member_id' => $row['member_id']))->row()->name; ?>
                            </td>
                            <td>
                                <input type="radio" name="status_<?php echo $row['attendance_id']; ?>" value="0" <?php if ($row['status'] == 0) echo 'checked'; ?>>&nbsp;<?php echo get_phrase('undefined'); ?> &nbsp;
                                <input type="radio" name="status_<?php echo $row['attendance_id']; ?>" value="1" <?php if ($row['status'] == 1) echo 'checked'; ?>>&nbsp;<?php echo get_phrase('present'); ?> &nbsp;
                                <input type="radio" name="status_<?php echo $row['attendance_id']; ?>" value="2" <?php if ($row['status'] == 2) echo 'checked'; ?>>&nbsp;<?php echo get_phrase('absent'); ?> &nbsp;
                            </td>
                        </tr>
                    <?php
                    $select_id++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <center>
            <button type="submit" class="btn btn-success" id="submit_button">
                <i class="entypo-thumbs-up"></i> <?php echo get_phrase('save_changes'); ?>
            </button>
        </center>
        <?php echo form_close(); ?>

    </div>



</div>


<script type="text/javascript">

var cell_selection = "";
jQuery(document).ready(function($) {
    $('#submit').attr('disabled', 'disabled');
});

    function select_section(cell_id) {
        if (cell_id !== '') {
        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + cell_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
}
    function mark_all_present() {
        var count = <?php echo count($attendance_of_members); ?>;
        for(var i = 0; i < count; i++){
            $(":radio[value=1]").prop('checked', true);
        }
    }

    function mark_all_absent() {
        var count = <?php echo count($attendance_of_members); ?>;
        for(var i = 0; i < count; i++)
            $(":radio[value=2]").prop('checked', true);
    }

function check_validation(){
    if(class_selection !== ''){
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
