<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
        <div class="ibox-title red-bg">
            <h5><i class="fa fa-gears"></i> Modules List</h5>
            <div class="ibox-tools">
                <a href="<?= site_url('setup/accessibility/users') ?>">
                    <button type="button" class="btn btn-primary dim btn-xs">
                        <i class="fa fa-th-list"></i> Back to Users List
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
        	<div class="row">
        		<div class="col-lg-12 table-responsive">
        			<!-- TOP CONTENT -->
        			<table class="table table-striped table-hover">
                        <thead>
                        	<tr>
                        		<th>Name:</th>
                        		<td><?= $user_value['lastname'].', '.$user_value['firstname'].' '.$user_value['middlename'] ?></td>
                        		<th>User Role:</th>
                        		<td><?= $user_value['user_role'] ?></td>
                        	</tr>
                        	<tr>
                        		<th>Username:</th>
                        		<td><?= $user_value['username'] ?></td>
                        		<th>Email Address:</th>
                        		<td><?= $user_value['email_address'] ?></td>
                        	</tr>
                            <tr>
                                <th></th>
                                <th class="text-center">Check/Uncheck all:</th>
                                <th class="text-center"><input type="checkbox" id="check_all" /></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                    <!-- END TOP CONTENT -->
        		</div>
        		<?= form_open('setup/accessibility/users/update_user_module', 'id="user_module_form"') ?>
        			<input type="hidden" name="user_id" value="<?= $user_value['user_id'] ?>">
	        		<div class="col-lg-6 table-responsive">
	        			<!-- LEFT CONTENT -->
	        			<table class="table table-striped table-hover">
	        				<thead>
	        					<tr>
	        						<th colspan="2"> <i class="fa fa-th-large"></i> Setup</th>
	        					</tr>
	        				</thead>
	                        <tbody>
	                            <tr>
	                                <td colspan="2">Accessibility</td>
	                            </tr>
	                            <tr>
	                                <td><i class="fa fa-caret-right"></i> Users</td>
	                                <td>
	                            		<input type="checkbox" name="modules[]" value="/setup/accessibility/users" <?= empty($user_modules['users']) ? '':'checked' ?> />
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <!-- END LEFT CONTENT -->
	        		</div>
	        		<div class="col-lg-6 table-responsive">
	        			<!-- RIGHT CONTENT -->
	                    <table class="table table-striped table-hover">
	        				<thead>
	        					<tr>
	        						<th colspan="2"> <i class="fa fa-refresh"></i> Organizations</th>
	        					</tr>
	        				</thead>
	                        <tbody>
                                <tr>
                                    <td>List of Organizations</td>
                                    <td>
                                        <input type="checkbox" name="modules[]" value="/organizations/organizations" <?= empty($user_modules['organizations']) ? '':'checked' ?> />
                                    </td>
                                </tr>
	                        	<tr>
	                                <td>Organization Requirements</td>
	                                <td>
	                            		<input type="checkbox" name="modules[]" value="/organizations/organization_requirements" <?= empty($user_modules['organization_requirements']) ? '':'checked' ?> />
	                                </td>
	                            </tr>
                                <tr>
                                    <td>Organization Users</td>
                                    <td>
                                        <input type="checkbox" name="modules[]" value="/organizations/organization_users" <?= empty($user_modules['organization_users']) ? '':'checked' ?> />
                                    </td>
                                </tr>
	                        </tbody>
	                    </table>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2"> <i class="fa fa-user"></i> Applicants</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>List of Applicants</td>
                                    <td>
                                        <input type="checkbox" name="modules[]" value="/applicants/applicants" <?= empty($user_modules['applicants']) ? '':'checked' ?> />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
	        			<!-- END RIGHT CONTENT -->
	        		</div>
	        		<div class="col-lg-12">
	        			<button class="btn btn-primary dim btn-xs pull-right" type="submit">
	        				<i class="fa fa-check-square"></i> Save Modules
	        			</button>
	        		</div>
        		<?= form_close() ?>
        	</div>
        </div>
        <div class="ibox-footer lazur-bg">
        </div>
    </div>
	<!-- END CONTENT -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Check/Uncheck All
		$("#check_all").change(function(){ 
            $('input[type="checkbox"]').prop('checked', $(this).prop("checked"));
        });
        //User Module Form
        $('#user_module_form').ajaxForm({
            resetForm: false,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
            }
        });
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>