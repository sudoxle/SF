<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
	<div class="ibox float">
		<div class="ibox-title red-bg">
			<h5><i class="fa fa-search"></i> Organization Preview</h5>
			<div class="ibox-tools">
				<a href="<?= site_url('organizations/organizations') ?>">
					<button type="button" class="btn btn-primary dim btn-xs">
						<i class="fa fa-th-list"></i> Back to Organizations List
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
            <!-- MAIN CONTENT -->
            <div class="row">
                <div class="col-md-5">
                    <img src="
                        <?php
                            if(!empty($organization_value['organization_image_file_path']))
                                echo base_url('assets/upload/'.$organization_value['organization_image_file_path']);
                            else
                                echo base_url('assets/images/default.png');
                        ?>" style="width: 80%; height: 80%;">
                </div>
                <div class="col-md-7">
                    <h2 class="font-bold m-b-xs">
                        <?= $organization_value['organization_address'] ?>
                    </h2>
                    <small>Email Address: <?= $organization_value['organization_email_address'] ?></small>
                    <div class="m-t-md">
                        <h2 class="product-main-price"><?= $organization_value['organization_contact_no'] ?> </h2>
                    </div>
                    <hr>
                    <h4>No. of Applicants: <?= $applicants_count ?></h4>
                    <h4><?= $organization_value['organization_type'] ?></h4>
                    <?= $organization_value['organization_scholarship_description'] ?>
                    <br/><hr>
                    <h4>Scholarship Offered by Courses: </h4>
                    <?php
                        foreach ($organization_value['organization_courses'] as $value) {
                            echo '<b>'. $value['organization_course'] .'</b> ('. $value['organization_course_type'] .')<br>';
                        }
                    ?>
                    <hr>
                    <h4>Scholarship Requirements: </h4>
                    <?php
                        foreach ($organization_value['organization_requirements'] as $value) {
                            echo '<b> * '. $value['organization_requirement_description'] .'</b> <br>';
                        }
                    ?>
                    <hr>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
		</div>
		<div class="ibox-footer lazur-bg">
		</div>
	</div>
	<!-- END CONTENT -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>