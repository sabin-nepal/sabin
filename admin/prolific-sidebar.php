<h1>sidebar options</h1>
<?php settings_errors();?>
<?php 
		$picture=esc_attr(get_option('picture_file'));
	$firstname=esc_attr(get_option('first_name'));
		$lastname=esc_attr(get_option('last_name'));
		$fullname=$firstname.' '.$lastname;
		$twitterhand=esc_attr(get_option('twitter_handler'));
		

?>
	<div class="display-data">
	<div class="img-container">
		<div class="img-fluid">
		<img src="<?php print $picture;?>"/></div>
		</div>
		<h1><?php print $fullname;?></h1>
		</div>
<form method="post" action="options.php" class="prolific-general-form">
	<?php settings_fields('prolific-setting-group');?>
	<?php do_settings_sections('allecaded_prolific');?>
	<?php submit_button('Save Changes','primary','btnSubmit');?>
</form>