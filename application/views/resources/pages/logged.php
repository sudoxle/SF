<?php $this->load->view('resources/layout/body_header'); ?>
	<center>
		<h2 class="text text-danger">
			<i class="fa fa-warning"></i> Oops! Page Not Found.
		</h2>
		<p>
			Please contact Administrator for more information. 
			<br/><br/>
			<a class="btn btn-primary" href="<?= site_url() ?>">
				<i class="fa fa-home"></i> Home 
			</a>
		</p>
	</center>
<?php $this->load->view('resources/layout/body_footer'); ?>

<?php $this->load->view('resources/layout/body_end'); ?>