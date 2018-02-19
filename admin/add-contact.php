<h1>Theme options</h1>
<?php settings_errors();?>
	
<form method="post" action="options.php">
	<?php settings_fields('prolific-add-contact');?>
	<?php do_settings_sections('allecaded_contact');?>
	<?php submit_button();?>
</form>