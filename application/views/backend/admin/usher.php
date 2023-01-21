
            <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_usher_add/');?>');"
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('add_new_usher');?>
                </a>
                <br><br>
               <table class="table table-bordered datatable" id="ushers">
                    <thead>
                        <tr>
                            <th width="60"><div><?php echo get_phrase('usher_id');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email').'/'.get_phrase('username');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#ushers').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_ushers') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "usher_id" },
                { "data": "photo" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [1,5],
                    "orderable": false
                },
            ]
        });
	});

    function usher_edit_modal(usher_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_usher_edit/');?>' + usher_id);
    }

    function usher_delete_confirm(usher_id) {
        confirm_modal('<?php echo site_url('admin/usher/delete/');?>' + usher_id);
    }

</script>
