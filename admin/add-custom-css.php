<h1>Prolific Custom Css</h1>
<?php settings_errors();?>
	
<form method="post" action="options.php">
	<?php settings_fields('prolific-add-css');?>
	<?php do_settings_sections('allecaded_css');?>
	<?php submit_button();?>
</form>