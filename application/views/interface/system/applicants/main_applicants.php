<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
		<div class="ibox-title red-bg">
			<h5><i class="fa fa-th-list"></i> Applicants List</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
		</div>
		<div class="ibox-content">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Applicant Status</label>
                    <select class="form-control" name="status_filter">
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Disapproved">Disapproved</option>
                    </select>
                </div>
            </div>
            <!-- APPLICANTS TABLE -->
			<div id="applicants_table">
				<?= $applicants_table ?>
			</div>
		</div>
		<div class="ibox-footer lazur-bg">
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- APPLICANT FORM -->
	<?= $applicant_form_open ?>
		<div class="row">
			<input type="hidden" name="applicant_id" />
			<div class="col-lg-6">			
				<div class="form-group">
		            <label>Firstname</label>
		            <input type="text" class="form-control" name="applicant_firstname" required />
		        </div>
		        <div class="form-group">
		            <label>Middlename</label>
		            <input type="text" class="form-control" name="applicant_middlename" />
		        </div>
		        <div class="form-group">
		            <label>Lastname</label>
		            <input type="text" class="form-control" name="applicant_lastname" required />
		        </div>
		        <div class="form-group">
                    <label>Gender</label>
					<select class="form-control" name="applicant_gender" required>
						<option value="">Choose Gender</option>
	                    <option value="Male">Male</option>
	                    <option value="Female">Female</option>
	                </select>
                </div>
			</div>
			<div class="col-lg-6">
                <div class="form-group">
		            <label>Birthdate</label>
		            <div class="input-group">
                        <span class="input-group-addon">
                        	<i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="applicant_birthdate" required />
                    </div>
		        </div>
		        <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="applicant_address"></textarea>
                </div>
                <div class="form-group">
		            <label>Mobile</label>
		            <div class="input-group">
                        <span class="input-group-addon">+63</span>
                        <input type="number" class="form-control" name="applicant_mobile" />
                    </div>
		        </div>
		        <div class="form-group">
		            <label>Email Address</label>
		            <div class="input-group">
                        <span class="input-group-addon">
                        	<i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="email" class="form-control" name="applicant_email_address" required />
                    </div>
		        </div>
			</div>
		</div>
	<?= $applicant_form_close ?>
	<!-- END APPLICANT FORM -->
	<!-- APPLICANT MODAL -->
	<?= $applicant_del_modal ?>
	<!-- END APPLICANT MODAL -->
    <!-- APPLICANT APPROVE/DISAPPROVE FORM -->
    <?= $applicant_approve_form_open ?>
        <input type="hidden" name="applicant_id" />
        <input type="hidden" name="applicant_organization_id" />
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message">Congratulations! You're scholarship application have been approved.</textarea>
        </div>
    <?= $applicant_approve_form_close ?>
    <?= $applicant_disapprove_form_open ?>
        <input type="hidden" name="applicant_id" />
        <input type="hidden" name="applicant_organization_id" />
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message" required>Sorry you're scholarship application has been disapproved due to the following reason: </textarea>
        </div>
    <?= $applicant_disapprove_form_close ?>
    <!-- END APPLICANT APPROVE/DISAPPROVE FORM -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Data Table
		load_tbl_applicants();
		function load_tbl_applicants(){
			$('.datatable').dataTable({
	            responsive: true
	        });
		}
        //
        // function load_textarea(){

        // }
        //Date Picker
        $('input[name="applicant_birthdate"]').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        //Status Filter
        $(document).on("change", 'select[name="status_filter"]', function(e){
            $.post("<?= site_url('applicants/applicants/ajax') ?>", {
                status_filter:$(this).val()
            })
            .done( function(data){
                $('#applicants_table').html(data);
                load_tbl_applicants();
            });
        });
        //Applicant Form
        $('#applicant_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#applicant_modal .close').click();
                if(value.applicants_table!=null){
                	$('#applicants_table').html(value.applicants_table);
                	load_tbl_applicants();
                }
            }
        });
        //Applicant Update
        $(document).on("click", '.applicant_upd_btn', function(e){
            $('#applicant_form').attr('action', '<?= site_url('applicants/applicants/update') ?>');
            $('input[name="applicant_id"]').val($(this).attr('id'));
            $.post("<?= site_url('applicants/applicants/ajax') ?>", {
                applicant_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('input[name="applicant_firstname"]').val(value.applicant_firstname);
                $('input[name="applicant_middlename"]').val(value.applicant_middlename);
                $('input[name="applicant_lastname"]').val(value.applicant_lastname);
                $('select[name="applicant_gender"]').val(value.applicant_gender);
                $('input[name="applicant_birthdate"]').val(value.applicant_birthdate);
                $('textarea[name="applicant_address"]').val(value.applicant_address);
                $('input[name="applicant_mobile"]').val(value.applicant_mobile);
                $('input[name="applicant_email_address"]').val(value.applicant_email_address);
            });
            $('#applicant_modal').modal({backdrop: true});
        });
        //Applicant Delete
        $(document).on("click", '.applicant_del_btn', function(e){
			$('#applicant_delete_yes').attr('value', $(this).attr('value'));
            $('#applicant_delete_yes').attr('data-id', $(this).attr('id'));
			$('#applicant_delete_modal').modal({backdrop: true});
		});
		$(document).on("click", '#applicant_delete_yes', function(e){
            var ids = $(this).attr('value').split('-');
            $.post("<?= site_url('applicants/applicants/delete') ?>", {
                applicant_id:$(this).attr('data-id'),
                applicant_organization_id:ids[1],
                organization_id:ids[0],
            })
            .done( function(data){
               	var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#applicant_delete_modal .close').click();
                if(value.applicants_table!=null){
                	$('#applicants_table').html(value.applicants_table);
                	load_tbl_applicants();
                }
            });
        });
        //Applicant Approve
        $(document).on("click", '.applicant_approve_btn', function(e){
            $('#applicant_approve_form input[name="applicant_id"]').val($(this).attr('value'));
            $('#applicant_approve_form input[name="applicant_organization_id"]').val($(this).attr('id'));
            $('#applicant_approve_modal').modal({backdrop: true});
        });
        $('#applicant_approve_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#applicant_approve_modal .close').click();
                if(value.applicants_table!=null){
                    $('#applicants_table').html(value.applicants_table);
                    load_tbl_applicants();
                }
            }
        });
        //Applicant Disapprove
        $(document).on("click", '.applicant_disapprove_btn', function(e){
            $('#applicant_disapprove_form input[name="applicant_id"]').val($(this).attr('value'));
            $('#applicant_disapprove_form input[name="applicant_organization_id"]').val($(this).attr('id'));
            $('#applicant_disapprove_modal').modal({backdrop: true});
        });
        $('#applicant_disapprove_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#applicant_disapprove_modal .close').click();
                if(value.applicants_table!=null){
                    $('#applicants_table').html(value.applicants_table);
                    load_tbl_applicants();
                }
            }
        });
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>