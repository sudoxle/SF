<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
		<div class="ibox-title red-bg">
			<h5><i class="fa fa-th-list"></i> Organizations List</h5>
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
            <!-- ORGANIZATIONS TABLE -->
            <div id="organizations_table">
				<?= $organizations_table ?>
			</div>
		</div>
		<div class="ibox-footer lazur-bg">
		</div>
	</div>
	<!-- END CONTENT -->
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
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Data Table
		load_tbl_organizations();
		function load_tbl_organizations(){
			$('.datatable').dataTable({
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
            $('#organization_requirement_form').attr('action', '<?= site_url('organizations/organization_requirements/update') ?>');
            $('input[name="organization_id"]').val($(this).attr('id'));
            $.post("<?= site_url('organizations/organization_requirements/ajax') ?>", {
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
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>