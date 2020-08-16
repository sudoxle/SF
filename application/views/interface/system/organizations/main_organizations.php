<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
		<div class="ibox-title red-bg">
			<h5><i class="fa fa-th-list"></i> Organizations List</h5>
			<div class="ibox-tools">
				<a href="#organization_modal" data-toggle="modal">
					<button type="button" class="btn btn-primary dim btn-xs">
						<i class="fa fa-pencil"></i> Add Organization
					</button>
                </a>
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
		</div>
		<div class="ibox-content">
            <div class="col-sm-12">
                <?= empty($notification) ? '':$notification ?>
            </div>
			<!-- ORGANIZATIONS TABLE -->
            <div id="organizations_table">
				<?= $organizations_table ?>
			</div>
		</div>
		<div class="ibox-footer lazur-bg">
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- ORGANIZATION FORM -->
	<?= $organization_form_open ?>
		<div class="row">
			<input type="hidden" name="organization_id" />
			<div class="col-lg-6">			
				<div class="form-group">
		            <label>Org. Name</label>
		            <input type="text" class="form-control" name="organization_name" required />
		        </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="organization_address" required></textarea>
                </div>
                <div class="form-group">
                    <label>Contact No.</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        <input type="text" class="form-control" name="organization_contact_no" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="email" class="form-control" name="organization_email_address" />
                    </div>
                </div>
			</div>
			<div class="col-lg-6">
                <div class="form-group">
                    <label>Organization Type</label>
                    <select class="form-control" name="organization_type" required>
                        <option value="">Choose Type</option>
                        <option value="TVI (Technical-Vocational Institution)">TVI (Technical-Vocational Institution)</option>
                        <option value="Academe">Academe</option>
                        <option value="Non-Academe">Non-Academe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Organization Scholarship Description</label>
                    <textarea class="form-control" name="organization_scholarship_description" rows="9"></textarea>
                </div>
			</div>
		</div>
	<?= $organization_form_close ?>
	<!-- END ORGANIZATION FORM -->
    <!-- ORGANIZATION IMAGE FORM -->
    <?= $organization_image_form_open ?>
        <input type="hidden" name="organization_id" />
        <div class="form-group">
            <label>Organization Image</label>
            <input type="file" name="organization_image_file_path">
        </div>
    <?= $organization_image_form_close ?>
    <!-- END ORGANIZATION IMAGE FORM -->
	<!-- ORGANIZATION DELETE MODAL -->
	<?= $organization_del_modal ?>
	<!-- END ORGANIZATION DELETE MODAL -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Data Table
		load_tbl_organizations();
		function load_tbl_organizations(){
			$('.datatable').dataTable({
	            responsive: true
	        });
		}
        //File Input
        $('input[name="organization_image_file_path"]').fileinput({
            dropZoneEnabled: true,
            showUpload: false,
            showRemove: false,
            allowedFileExtensions: ["jpg", "jpeg", "png"]
        });
        //Organization Image Update
        $(document).on("click", '.organization_img_btn', function(e){
            $('#organization_image_form')[0].reset();
            $('input[name="organization_id"]').val($(this).attr('id'));
            $('#organization_image_modal').modal({backdrop: true});
        });
        //Organization Form
        $('#organization_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#organization_modal .close').click();
                if(value.organizations_table!=null){
                	$('#organizations_table').html(value.organizations_table);
                	load_tbl_organizations();
                }
            }
        });
        //Organization Update
        $(document).on("click", '.organization_upd_btn', function(e){
            $('#organization_form').attr('action', '<?= site_url('organizations/organizations/update') ?>');
            $('input[name="organization_id"]').val($(this).attr('id'));
            $.post("<?= site_url('organizations/organizations/ajax') ?>", {
                organization_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('input[name="organization_name"]').val(value.organization_name);
                $('textarea[name="organization_address"]').val(value.organization_address);
                $('input[name="organization_contact_no"]').val(value.organization_contact_no);
                $('input[name="organization_email_address"]').val(value.organization_email_address);
                $('select[name="organization_type"]').val(value.organization_type);
                $('textarea[name="organization_scholarship_description"]').val(value.organization_scholarship_description);
            });
            $('#organization_modal').modal({backdrop: true});
        });
        $('a[href="#organization_modal"]').click(function(){
        	$('#organization_form').attr('action', '<?= site_url('organizations/organizations/insert') ?>');
        	$('#organization_form')[0].reset();
        });
        //Organization Delete
        $(document).on("click", '.organization_del_btn', function(e){
			$('#organization_delete_yes').attr('data-id', $(this).attr('id'));
			$('#organization_delete_modal').modal({backdrop: true});
		});
		$(document).on("click", '#organization_delete_yes', function(e){
            $.post("<?= site_url('organizations/organizations/delete') ?>", {
                organization_id:$(this).attr('data-id')
            })
            .done( function(data){
               	var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#organization_delete_modal .close').click();
                if(value.organizations_table!=null){
                	$('#organizations_table').html(value.organizations_table);
                	load_tbl_organizations();
                }
            });
        });
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>