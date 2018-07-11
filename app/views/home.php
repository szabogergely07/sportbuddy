<?= HTML_START ?>

	<?php isset($success) || isset($logout) || isset($login) ?
		'<div class="alert alert-success" role="alert">
	  		 <?= $success ? $success : $login ?>
		</div>' : ''
	?>
	
	<h1>Welcome to Sportbuddy</h1>
	
<?= HTML_END ?>