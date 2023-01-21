
            <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_carer_add/');?>');"
                class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('add_new_carer');?>
                </a>
                <br><br>
               <table class="table table-bordered" id="carers">
                    <thead>
                        <tr>
                            <th width="60"><div><?php echo get_phrase('carer_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email').'/'.get_phrase('username');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('profession');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#carers').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_carers') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "carer_id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "profession" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [5],
                    "orderable": false
                },
            ]
        });
    });

    function carer_edit_modal(carer_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_carer_edit/');?>' + carer_id);
    }

    function carer_delete_confirm(carer_id) {
        confirm_modal('<?php echo site_url('admin/carer/delete/');?>' + carer_id);
    }

</script>
