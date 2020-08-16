<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="row animated fadeInRight">
        <?= empty($notification) ? '':$notification ?>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content profile-content">
                        <h3><strong> <?= $applicant_firstname .' '. $applicant_middlename .' '. $applicant_lastname ?> </strong></h3>
                        <p><i class="fa fa-map-marker"></i> <?= $applicant_address ?></p>
                        <h5>
                            About me
                        </h5>
                        <p>
                            <?= $applicant_gender .', '. $applicant_birthdate .'. <br>Mobile No.: '. $applicant_mobile .' <br>Email Address: '. $applicant_email_address ?>
                        </p>
                        <h5> Date Registered: <?= $applicant_date_registered ?> </h5>
                        <h5> Username: <?= $applicant_username ?> </h5>
                    </div>
	            </div>
	        </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Organization Applications</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
                            <?= $applicant_organizations_list ?>
                        </div>
                    </div>
                </div>
                <!-- END FEED -->
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- APPLICANT FORM -->
    <?= $applicant_form_open ?>
        <div class="row">
            <div class="col-lg-12">
                <h2>List of Requirements</h2>
                <hr>
                <input type="hidden" name="organization_id">
                <input type="hidden" name="applicant_organization_id">
                <div id="organization_requirements"></div>
            </div>
        </div>
    <?= $applicant_form_close ?>
    <!-- END APPLICANT FORM -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		//Applicant Form
        $(document).on("click", '.applicant_apply_btn', function(e){
            $('input[name="organization_id"]').val($(this).attr('id'));
            $('input[name="applicant_organization_id"]').val($(this).attr('value'));
            $.post("<?= site_url('system/ajax') ?>", {
                organization_requirements:$(this).attr('id'),
            })
            .done( function(data){
                $('#organization_requirements').html(data);
                load_fileinput();
            });
            $('#applicant_modal').modal({backdrop: true});
        });
        function load_fileinput(){
            $('input[name^="applicant_requirement_file_path"]').fileinput({
                dropZoneEnabled: true,
                showUpload: false,
                showRemove: false,
                allowedFileExtensions: ["jpg", "jpeg", "png", "docx", "doc", "xls", "xlsx", "ppt", "pptx", "pdf"]
            });
        }
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>