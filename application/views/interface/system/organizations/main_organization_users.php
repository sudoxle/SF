<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
		<div class="ibox-title red-bg">
			<h5><i class="fa fa-th-list"></i> Organization Users List</h5>
			<div class="ibox-tools">
				<a href="#organization_user_modal" data-toggle="modal">
					<button type="button" class="btn btn-primary dim btn-xs">
						<i class="fa fa-pencil"></i> Add Organization User
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
			<div id="organization_users_table">
				<?= $organization_users_table ?>
			</div>
		</div>
		<div class="ibox-footer lazur-bg">
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- ORGANIZATION USER FORM -->
	<?= $organization_user_form_open ?>
		<div class="row">
			<input type="hidden" name="organization_user_id" />
			<div class="col-lg-6">
                <div class="form-group">
                    <label>Organization Name</label>
                    <select class="form-control" name="organization_id" required></select>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="organization_user_username" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input type="password" class="form-control" name="organization_user_password" required />
                    </div>
                </div>
				<div class="form-group">
		            <label>Fullname</label>
		            <input type="text" class="form-control" name="organization_user_fullname" required />
		        </div>
		        <div class="form-group">
                    <label>Gender</label>
					<select class="form-control" name="organization_user_gender" required>
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
                        <input type="text" class="form-control" name="organization_user_birthdate" required />
                    </div>
		        </div>
		        <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="organization_user_address"></textarea>
                </div>
                <div class="form-group">
		            <label>Mobile</label>
		            <div class="input-group">
                        <span class="input-group-addon">+63</span>
                        <input type="number" class="form-control" name="organization_user_mobile" />
                    </div>
		        </div>
		        <div class="form-group">
		            <label>Email Address</label>
		            <div class="input-group">
                        <span class="input-group-addon">
                        	<i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="email" class="form-control" name="organization_user_email_address" required />
                    </div>
		        </div>
			</div>
		</div>
	<?= $organization_user_form_close ?>
	<!-- END ORGANIZATION USER FORM -->
	<!-- ORGANIZATION USER DELETE MODAL -->
	<?= $organization_user_del_modal ?>
	<!-- END ORGANIZATION USER DELETE MODAL -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Data Table
		load_tbl_organization_users();
		function load_tbl_organization_users(){
			$('.datatable').dataTable({
	            responsive: true
	        });
		}
        //Selections
        load_sel_organizations();
        function load_sel_organizations(){
            $.post("<?= site_url('organizations/organization_users/ajax') ?>", {
                organizations_selection:'load'
            })
            .done( function(data){
                $('select[name="organization_id"]').html(data);
            });
        }
        //Password Show
        $('i[class="fa fa-eye"]').mousedown(function(){
            $('input[name="organization_user_password"]').attr('type','text');
        }).mouseup(function(){
            $('input[name="organization_user_password"]').attr('type','password');
        });
        //Date Picker
        $('input[name="organization_user_birthdate"]').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        //Organization User Form
        $('#organization_user_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#organization_user_modal .close').click();
                if(value.organization_users_table!=null){
                	$('#organization_users_table').html(value.organization_users_table);
                	load_tbl_organization_users();
                }
            }
        });
        //Organization User Update
        $(document).on("click", '.organization_user_upd_btn', function(e){
            $('#organization_user_form').attr('action', '<?= site_url('organizations/organization_users/update') ?>');
            $('input[name="organization_user_id"]').val($(this).attr('id'));
            $.post("<?= site_url('organizations/organization_users/ajax') ?>", {
                organization_user_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('input[name="organization_user_username"]').val(value.organization_user_username);
                $('input[name="organization_user_password"]').val(value.organization_user_password);
                $('input[name="organization_user_fullname"]').val(value.organization_user_fullname);
                $('select[name="organization_user_gender"]').val(value.organization_user_gender);
                $('input[name="organization_user_birthdate"]').val(value.organization_user_birthdate);
                $('textarea[name="organization_user_address"]').val(value.organization_user_address);
                $('input[name="organization_user_mobile"]').val(value.organization_user_mobile);
                $('input[name="organization_user_email_address"]').val(value.organization_user_email_address);
                $('select[name="organization_id"]').val(value.organization_id);
            });
            $('#organization_user_modal').modal({backdrop: true});
        });
        $('a[href="#organization_user_modal"]').click(function(){
        	$('#organization_user_form').attr('action', '<?= site_url('organizations/organization_users/insert') ?>');
        	$('#organization_user_form')[0].reset();
        });
        //Organization User Delete
        $(document).on("click", '.organization_user_del_btn', function(e){
			$('#organization_user_delete_yes').attr('data-id', $(this).attr('id'));
			$('#organization_user_delete_modal').modal({backdrop: true});
		});
		$(document).on("click", '#organization_user_delete_yes', function(e){
            $.post("<?= site_url('organizations/organization_users/delete') ?>", {
                organization_user_id:$(this).attr('data-id')
            })
            .done( function(data){
               	var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#organization_user_delete_modal .close').click();
                if(value.organization_users_table!=null){
                	$('#organization_users_table').html(value.organization_users_table);
                	load_tbl_organization_users();
                }
            });
        });
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>