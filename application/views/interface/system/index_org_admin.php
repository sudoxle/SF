<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-0"><i class="fa fa-area-chart"></i> Graph</a></li>
            <li class=""><a data-toggle="tab" href="#tab-1"><i class="fa fa-users"></i> Applicants</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-folder"></i> Organization Requirements</a></li>
            <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-male"></i> Organization Users</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab-0" class="tab-pane active">
            <!-- ZERO CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> Graph</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <h2> <i class="fa fa-area-chart"></i> Applicants Graph</h2>
                            <h5> Legend </h5>
                            <ul>
                                <li>Black: Pending</li>
                                <li>Green: Approved</li>
                                <li>Red: Disapproved</li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <canvas id="barChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer lazur-bg">
                </div>
            </div>
            <!-- END ZERO CONTENT -->
        </div>
        <div id="tab-1" class="tab-pane">
            <!-- FIRST CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> Applicants List</h5>
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
            <!-- END FIRST CONTENT -->
        </div>
        <div id="tab-2" class="tab-pane">
            <!-- SECOND CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> Organization Requirements</h5>
                </div>
                <div class="ibox-content">
                    <!-- ORGANIZATION COURSES AND REQUIREMENTS TABLE -->
                    <div id="organizations_table">
                    	<?= $organizations_table ?>
                    </div>
                </div>
                <div class="ibox-footer lazur-bg">
                </div>
            </div>
            <!-- END SECOND CONTENT -->
        </div>
        <div id="tab-3" class="tab-pane">
            <!-- SECOND CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> Organization Users</h5>
                    <div class="ibox-tools">
                        <a href="#organization_user_modal" data-toggle="modal">
                            <button type="button" class="btn btn-primary dim btn-xs">
                                <i class="fa fa-pencil"></i> Add Organization User
                            </button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- ORGANIZATION USERS TABLE -->
                    <div id="organization_users_table">
                        <?= $organization_users_table ?>
                    </div>
                </div>
                <div class="ibox-footer lazur-bg">
                </div>
            </div>
            <!-- END SECOND CONTENT -->
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
	<!-- ORGANIZATION REQUIREMENT FORM -->
	<?= $organization_requirement_form_open ?>
		<div class="row">
			<input type="hidden" name="organization_id" />
			<div class="col-lg-6">			
				<div class="form-group">
		            <label>Course <a id="add_organization_course"> <i class="fa fa-plus-square-o"></i> </a></label>
		            <input type="text" class="form-control" name="organization_course[]" required />
		        </div>
                <div class="form-group">
                    <label>School </label>
                    <input type="text" class="form-control" name="organization_school[]" required />
                </div>
                <div class="form-group">
                    <label>Course Type</label>
                    <select class="form-control" name="organization_course_type[]" required>
                        <option value="">Choose Type</option>
                        <option value="Bachelors Degree">Bachelors Degree</option>
                        <option value="2 Year Degree Course">2 Year Degree Course</option>
                        <option value="Vocational Course">Vocational Course</option>
                    </select>
                </div>
                <div id="div_organization_course"></div>
			</div>
			<div class="col-lg-6">
                <div class="form-group">
                    <label>Requirement Desc. <a id="add_organization_requirement"> <i class="fa fa-plus-square-o"></i> </a></label>
                    <input type="text" class="form-control" name="organization_requirement_description[]" required />
                </div>
                <div class="form-group">
                    <label>Requirement Uploadable?</label>
                    <input type="checkbox" name="organization_requirement_is_uploadable[]" value="uploadable" />
                </div>
                <div id="div_organization_requirement"></div>
			</div>
		</div>
	<?= $organization_requirement_form_close ?>
	<!-- END ORGANIZATION REQUIREMENT FORM -->
    <!-- ORGANIZATION USER FORM -->
    <?= $organization_user_form_open ?>
        <div class="row">
            <input type="hidden" name="organization_user_id" />
            <div class="col-lg-6">
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
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
        //Data Table
		load_tbl_applicants();
		function load_tbl_applicants(){
			$('.datatable-applicants').dataTable({
	            responsive: true
	        });
		}
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
            $.post("<?= site_url('system/ajax') ?>", {
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
            $('#applicant_form').attr('action', '<?= site_url('system/update') ?>');
            $('input[name="applicant_id"]').val($(this).attr('id'));
            $.post("<?= site_url('system/ajax') ?>", {
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
            $.post("<?= site_url('system/delete') ?>", {
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
        //Data Table
		load_tbl_organizations();
		function load_tbl_organizations(){
			$('.datatable-organization').dataTable({
	            responsive: true
	        });
		}
        //Add Organization Course
        var counter_organization_course = 0;
        $(document).on("click", '#add_organization_course', function(e){
            ++counter_organization_course;
            $('#div_organization_course').append('<div id="div_organization_course_' + counter_organization_course + '">' +
                    '<div class="form-group">' +
                        '<label>Course <a id="rem_organization_course"> <i class="fa fa-trash"></i> </a></label>' +
                        '<input type="text" class="form-control" name="organization_course[]" required />' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label>School </label>' +
                        '<input type="text" class="form-control" name="organization_school[]" required />' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label>Course Type</label>' +
                        '<select class="form-control" name="organization_course_type[]" required>' +
                            '<option value="">Choose Type</option>' +
                            '<option value="Bachelors Degree">Bachelors Degree</option>' +
                            '<option value="2 Year Degree Course">2 Year Degree Course</option>' +
                            '<option value="Vocational Course">Vocational Course</option>' +
                        '</select>' +
                    '</div>' +
                '</div>');
        });
        //Remove Organization Course
        $(document).on("click", '#rem_organization_course', function(e){
            $('#div_organization_course_' + counter_organization_course).remove();
            --counter_organization_course;
        });
        //Add Organization Requirement
        var counter_organization_requirement = 0;
        $(document).on("click", '#add_organization_requirement', function(e){
            ++counter_organization_requirement;
            $('#div_organization_requirement').append('<div id="div_organization_requirement_' + counter_organization_requirement + '">' +
                    '<div class="form-group">' +
                        '<label>Requirement Desc. <a id="rem_organization_requirement"> <i class="fa fa-trash"></i> </a></label>' +
                        '<input type="text" class="form-control" name="organization_requirement_description[]" required />' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label>Requirement Uploadable?</label> ' +
                        '<input type="checkbox" name="organization_requirement_is_uploadable[]" value="uploadable" />' +
                    '</div>' +
                '</div>');
        });
        //Remove Organization Requirement
        $(document).on("click", '#rem_organization_requirement', function(e){
            $('#div_organization_requirement_' + counter_organization_requirement).remove();
            --counter_organization_requirement;
        });
        //Organization Form
        $('#organization_requirement_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#organization_requirement_modal .close').click();
                if(value.organizations_table!=null){
                	$('#organizations_table').html(value.organizations_table);
                	load_tbl_organizations();
                }
            }
        });
        //Organization Update
        $(document).on("click", '.organization_upd_btn', function(e){
            //Reset Form
            $('#div_organization_course').html("");
            $('#div_organization_requirement').html("");
            $('#organization_requirement_form')[0].reset();
            //Reload Form
            $('#organization_requirement_form').attr('action', '<?= site_url('system/update_organization') ?>');
            $('input[name="organization_id"]').val($(this).attr('id'));
            $.post("<?= site_url('system/ajax') ?>", {
                organization_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                // Load Organization Course Values
                counter_organization_course = Object.keys(value.organization_course).length - 1;
                for (var i = 1; i < Object.keys(value.organization_course).length; i++) {
                    $('#div_organization_course').append('<div id="div_organization_course_' + i + '">' +
                            '<div class="form-group">' +
                                '<label>Course <a id="rem_organization_course"> <i class="fa fa-trash"></i> </a></label>' +
                                '<input type="text" class="form-control" name="organization_course[]" required />' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label>School </label>' +
                                '<input type="text" class="form-control" name="organization_school[]" required />' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label>Course Type</label>' +
                                '<select class="form-control" name="organization_course_type[]" required>' +
                                    '<option value="">Choose Type</option>' +
                                    '<option value="Bachelors Degree">Bachelors Degree</option>' +
                                    '<option value="2 Year Degree Course">2 Year Degree Course</option>' +
                                    '<option value="Vocational Course">Vocational Course</option>' +
                                '</select>' +
                            '</div>' +
                        '</div>');
                }
                $('input[name="organization_course[]"]').each(function(index, elem) {
                    var data = value.organization_course[index].organization_course.split('; (');
                    $(this).val(data[0]);
                    if(data[1] != null)
                        $('input[name="organization_school[]').eq(index).val(data[1].replace(')', ''));
                });
                $('select[name="organization_course_type[]"]').each(function(index, elem) {
                    $(this).val(value.organization_course[index].organization_course_type);
                });
                // Load Organization Requirement Values
                counter_organization_requirement = Object.keys(value.organization_requirement).length - 1;
                for (var i = 1; i < Object.keys(value.organization_requirement).length; i++) {
                    $('#div_organization_requirement').append('<div id="div_organization_requirement_' + i + '">' +
                            '<div class="form-group">' +
                                '<label>Requirement Desc. <a id="rem_organization_requirement"> <i class="fa fa-trash"></i> </a></label>' +
                                '<input type="text" class="form-control" name="organization_requirement_description[]" required />' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label>Requirement Uploadable?</label> ' +
                                '<input type="checkbox" name="organization_requirement_is_uploadable[]" value="uploadable" />' +
                            '</div>' +
                        '</div>');
                }
                $('input[name="organization_requirement_description[]"]').each(function(index, elem) {
                    $(this).val(value.organization_requirement[index].organization_requirement_description);
                });
                $('input[name="organization_requirement_is_uploadable[]"]').each(function(index, elem) {
                    if(value.organization_requirement[index].organization_requirement_is_uploadable == 'uploadable')
                        $(this).attr('checked', true);
                });
            });
            $('#organization_requirement_modal').modal({backdrop: true});
        });
        //Data Table
        load_tbl_organization_users();
        function load_tbl_organization_users(){
            $('.datatable-organization-users').dataTable({
                responsive: true
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
            $('#organization_user_form').attr('action', '<?= site_url('system/update_organization_user') ?>');
            $('input[name="organization_user_id"]').val($(this).attr('id'));
            $.post("<?= site_url('system/ajax') ?>", {
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
            });
            $('#organization_user_modal').modal({backdrop: true});
        });
        $('a[href="#organization_user_modal"]').click(function(){
            $('#organization_user_form').attr('action', '<?= site_url('system/insert_organization_user') ?>');
            $('#organization_user_form')[0].reset();
        });
        // Graph
        var barData = {
            labels: 
                <?php 
                    echo '[';
                    foreach ($organizations_stats as $value) {
                        echo '"'. $value['organization_name'] .'", ';
                    }
                    echo '],';
                ?>
            datasets: [{
                    label: "Pending",
                    fillColor: "rgba(10,10,10,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: 
                        <?php 
                            echo '[';
                            foreach ($organizations_stats as $value) {
                                echo $value['applicants_count_pending'] .', ';
                            }
                            echo '],';
                        ?>
                },{
                    label: "Approved",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.8)",
                    highlightFill: "rgba(26,179,148,0.75)",
                    highlightStroke: "rgba(26,179,148,1)",
                    data: 
                        <?php 
                            echo '[';
                            foreach ($organizations_stats as $value) {
                                echo $value['applicants_count_approved'] .', ';
                            }
                            echo '],';
                        ?>
                },{
                    label: "Disapproved",
                    fillColor: "rgba(179,26,26,0.5)",
                    strokeColor: "rgba(179,26,26,0.8)",
                    highlightFill: "rgba(179,26,26,0.75)",
                    highlightStroke: "rgba(179,26,50,1)",
                    data: 
                        <?php 
                            echo '[';
                            foreach ($organizations_stats as $value) {
                                echo $value['applicants_count_disapproved'] .', ';
                            }
                            echo '],';
                        ?>
                }
            ]
        };
        var barOptions = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.1)",
            scaleGridLineWidth: 1,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 5,
            barDatasetSpacing: 1,
            responsive: true,
        }
        var ctx = barChart.getContext("2d");
        var myNewChart = new Chart(ctx).Bar(barData, barOptions);
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>