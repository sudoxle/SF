<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-users"></i> Users</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> Persons</a></li>
            <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-tags"></i> User Roles</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <!-- FIRST CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> Users List</h5>
                    <div class="ibox-tools">
                        <a href="#user_modal" data-toggle="modal">
                            <button type="button" class="btn btn-primary dim btn-xs">
                                <i class="fa fa-pencil"></i> Add User
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
                    <div id="users_table">
                        <?= $users_table ?>
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
                    <h5><i class="fa fa-th-list"></i> Persons List</h5>
                    <div class="ibox-tools">
                        <a href="#person_modal" data-toggle="modal">
                            <button type="button" class="btn btn-primary dim btn-xs">
                                <i class="fa fa-pencil"></i> Add Person
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
                    <div id="persons_table">
                        <?= $persons_table ?>
                    </div>
                </div>
                <div class="ibox-footer lazur-bg">
                </div>
            </div>
            <!-- END SECOND CONTENT -->
        </div>
        <div id="tab-3" class="tab-pane">
            <!-- THIRD CONTENT -->
            <div class="ibox float">
                <div class="ibox-title red-bg">
                    <h5><i class="fa fa-th-list"></i> User Roles List</h5>
                    <div class="ibox-tools">
                        <a href="#user_role_modal" data-toggle="modal">
                            <button type="button" class="btn btn-primary dim btn-xs">
                                <i class="fa fa-pencil"></i> Add User Role
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
                    <div id="user_roles_table">
                        <?= $user_roles_table ?>
                    </div>
                </div>
                <div class="ibox-footer lazur-bg">
                </div>
            </div>
            <!-- END THIRD CONTENT -->
        </div>
    </div>
	<!-- END CONTENT -->
    <!-- USER FORM -->
    <?= $user_form_open ?>
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="user_id" />
                <div class="form-group">
                    <label>Person</label>
                    <select class="form-control" name="persons_selection" required></select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>User Role</label>
                    <select class="form-control" name="user_roles_selection" required></select>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" required />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input type="password" class="form-control" name="password1" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password2" required />
                </div>
            </div>
        </div>
    <?= $user_form_close ?>
    <!-- END USER FORM -->
    <!-- PERSON FORM -->
    <?= $person_form_open ?>
        <div class="row">
            <input type="hidden" name="person_id" />
            <div class="col-lg-6">          
                <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="firstname" required />
                </div>
                <div class="form-group">
                    <label>Middlename</label>
                    <input type="text" class="form-control" name="middlename" />
                </div>
                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" class="form-control" name="lastname" required />
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender" required>
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
                        <input type="text" class="form-control" name="birthdate" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <div class="input-group">
                        <span class="input-group-addon">+63</span>
                        <input type="number" class="form-control" name="mobile" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="email" class="form-control" name="email_address" required />
                    </div>
                </div>
            </div>
        </div>
    <?= $person_form_close ?>
    <!-- END PERSON FORM -->
    <!-- USER ROLE FORM -->
    <?= $user_role_form_open ?>
        <input type="hidden" name="user_role_id" />
        <div class="form-group">
            <label>User Role</label>
            <input type="text" class="form-control" name="user_role" required />
        </div>
    <?= $user_role_form_close ?>
    <!-- END USER ROLE FORM -->
    <!-- DELETE MODAL -->
    <?= $user_del_modal ?>
    <?= $person_del_modal ?>
    <?= $user_role_del_modal ?>
    <!-- END DELETE MODAL -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Data Table
        load_tbl_users();
        function load_tbl_users(){
            $('.datatable-users').dataTable({
                responsive: true
            });
        }
        load_tbl_persons();
        function load_tbl_persons(){
            $('.datatable-persons').dataTable({
                responsive: true
            });
        }
        load_tbl_user_roles();
        function load_tbl_user_roles(){
            $('.datatable-user-roles').dataTable({
                responsive: true
            });
        }
        //Selections
        load_sel_persons();
        function load_sel_persons(){
            $.post("<?= site_url('setup/accessibility/users/ajax') ?>", {
                persons_selection:'load'
            })
            .done( function(data){
                $('select[name="persons_selection"]').html(data);
            });
        }
        load_sel_user_roles();
        function load_sel_user_roles(){
            $.post("<?= site_url('setup/accessibility/users/ajax') ?>", {
                user_roles_selection:'load'
            })
            .done( function(data){
                $('select[name="user_roles_selection"]').html(data);
            });
        }
        //User Form
        $('#user_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#user_modal .close').click();
                if(value.users_table!=null){
                    $('#users_table').html(value.users_table);
                    load_tbl_users();
                }
            }
        });
        //Password Show
        $('i[class="fa fa-eye"]').mousedown(function(){
            $('input[name="password1"]').attr('type','text');
        }).mouseup(function(){
            $('input[name="password1"]').attr('type','password');
        });
        //Person Form
        $('#person_form').ajaxForm({
            resetForm: true,
            clearForm: false,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#person_modal .close').click();
                if(value.persons_table!=null){
                    $('#persons_table').html(value.persons_table);
                    load_tbl_persons();
                    load_sel_persons();
                }
            }
        });
        //Date Picker
        $('input[name="birthdate"]').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        //User Role Form
        $('#user_role_form').ajaxForm({
            resetForm: true,
            clearForm: true,
            beforeSubmit: function(){
            },
            success: function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#user_role_modal .close').click();
                if(value.user_roles_table!=null){
                    $('#user_roles_table').html(value.user_roles_table);
                    load_tbl_user_roles();
                    load_sel_user_roles();
                }
            }
        });
        //User Update
        $(document).on("click", '.user_upd_btn', function(e){
            $('#user_form').attr('action', '<?= site_url('setup/accessibility/users/update_user') ?>');
            $('input[name="user_id"]').val($(this).attr('id'));
            $.post("<?= site_url('setup/accessibility/users/ajax') ?>", {
                user_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('select[name="persons_selection"]').val(value.person_id);
                $('select[name="user_roles_selection"]').val(value.user_role_id);
                $('input[name="username"]').val(value.username);
                $('input[name="password1"]').val(value.password);
            });
            $('#user_modal').modal({backdrop: true});
        });
        $('a[href="#user_modal"]').click(function(){
            $('#user_form').attr('action', '<?= site_url('setup/accessibility/users/insert_user') ?>');
            $('#user_form')[0].reset();
        });
        //Person Update
        $(document).on("click", '.person_upd_btn', function(e){
            $('#person_form').attr('action', '<?= site_url('setup/accessibility/users/update_person') ?>');
            $('input[name="person_id"]').val($(this).attr('id'));
            $.post("<?= site_url('setup/accessibility/users/ajax') ?>", {
                person_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('input[name="firstname"]').val(value.firstname);
                $('input[name="middlename"]').val(value.middlename);
                $('input[name="lastname"]').val(value.lastname);
                $('select[name="gender"]').val(value.gender);
                $('input[name="birthdate"]').val(value.birthdate);
                $('textarea[name="address"]').val(value.address);
                $('input[name="mobile"]').val(value.mobile);
                $('input[name="email_address"]').val(value.email_address);
            });
            $('#person_modal').modal({backdrop: true});
        });
        $('a[href="#person_modal"]').click(function(){
            $('#person_form').attr('action', '<?= site_url('setup/accessibility/users/insert_person') ?>');
            $('#person_form')[0].reset();
        });
        //User Role Update
        $(document).on("click", '.user_role_upd_btn', function(e){
            $('#user_role_form').attr('action', '<?= site_url('setup/accessibility/users/update_user_role') ?>');
            $('input[name="user_role_id"]').val($(this).attr('id'));
            $.post("<?= site_url('setup/accessibility/users/ajax') ?>", {
                user_role_id:$(this).attr('id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('input[name="user_role"]').val(value.user_role);
            });
            $('#user_role_modal').modal({backdrop: true});
        });
        $('a[href="#user_role_modal"]').click(function(){
            $('#user_role_form').attr('action', '<?= site_url('setup/accessibility/users/insert_user_role') ?>');
            $('#user_role_form')[0].reset();
        });
        //User Delete
        $(document).on("click", '.user_del_btn', function(e){
            $('#user_delete_yes').attr('data-id', $(this).attr('id'));
            $('#user_delete_modal').modal({backdrop: true});
        });
        $(document).on("click", '#user_delete_yes', function(e){
            $.post("<?= site_url('setup/accessibility/users/delete_user') ?>", {
                user_id:$(this).attr('data-id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#user_delete_modal .close').click();
                if(value.users_table!=null){
                    $('#users_table').html(value.users_table);
                    load_tbl_users();
                }
            });
        });
        //Person Delete
        $(document).on("click", '.person_del_btn', function(e){
            $('#person_delete_yes').attr('data-id', $(this).attr('id'));
            $('#person_delete_modal').modal({backdrop: true});
        });
        $(document).on("click", '#person_delete_yes', function(e){
            $.post("<?= site_url('setup/accessibility/users/delete_person') ?>", {
                person_id:$(this).attr('data-id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#person_delete_modal .close').click();
                if(value.persons_table!=null){
                    $('#persons_table').html(value.persons_table);
                    load_tbl_persons();
                    load_sel_persons();
                }
            });
        });
        //User Role Delete
        $(document).on("click", '.user_role_del_btn', function(e){
            $('#user_role_delete_yes').attr('data-id', $(this).attr('id'));
            $('#user_role_delete_modal').modal({backdrop: true});
        });
        $(document).on("click", '#user_role_delete_yes', function(e){
            $.post("<?= site_url('setup/accessibility/users/delete_user_role') ?>", {
                user_role_id:$(this).attr('data-id')
            })
            .done( function(data){
                var value = JSON.parse(data);
                $('#notification').html(value.notification);
                $('#user_role_delete_modal .close').click();
                if(value.user_roles_table!=null){
                    $('#user_roles_table').html(value.user_roles_table);
                    load_tbl_user_roles();
                    load_sel_user_roles();
                }
            });
        });
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>