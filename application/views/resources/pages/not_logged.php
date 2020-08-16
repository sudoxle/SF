<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $web_title ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/logo.png">
    <?php $this->load->view('resources/scripts/css'); ?>
</head>
<body>
	<center>
		<br><br><br>
		<h2 class="text text-danger">
			<i class="fa fa-warning"></i> Oops! Page Not Found.
		</h2>
		<p>
			<a href="<?= site_url() ?>"><i class="fa fa-home"></i> Click Here for Home!</a>
		</p>
		<img src="<?= base_url() ?>assets/images/logo_404.png" style="height: 164px;">
	</center>
</body>
</html>