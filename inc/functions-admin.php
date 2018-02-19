<?php 

	function prolific_add_menu_page(){
		add_menu_page('prolifics theme options','Prolificdevs','manage_options','allecaded_prolific','prolific_create_page');
		add_submenu_page('allecaded_prolific','prolifics theme options','General','manage_options','allecaded_prolific','prolific_create_page');
		add_submenu_page('allecaded_prolific','prolific theme options','Theme Options','manage_options','allecaded_theme','prolific_add_theme');
		add_submenu_page('allecaded_prolific','prolific theme options','setting','manage_options','allecaded_setting','prolific_add_setting');
		add_submenu_page('allecaded_prolific','Prolific Contact options','Contact Form','manage_options','allecaded_contact','prolific_add_contact');
		add_submenu_page('allecaded_prolific','Prolific CSS options',' CSS Customize','manage_options','allecaded_css','prolific_add_custom_css');

	}
	add_action('admin_menu','prolific_add_menu_page');
	//activate custom setting
		add_action('admin_init' ,'prolific_custom_setting');

	function prolific_custom_setting(){
		//register sidebar
		register_setting('prolific-setting-group','picture_file');

		register_setting('prolific-setting-group','first_name');
		register_setting('prolific-setting-group','last_name');
		register_setting('prolific-setting-group','twitter_handler','prolific_sanitizer_twitter');
		add_settings_section('prolific-setting-section','Sidebar Options','prolifics_sidebar_options','allecaded_prolific');

		add_settings_field('sidebar-media','Profile picture','prolific_sidebar_media','allecaded_prolific','prolific-setting-section');

		add_settings_field('sidebar-name','Full Name','prolific_sidebar_name','allecaded_prolific','prolific-setting-section');
		add_settings_field('sidebar-twitter','Twiter Handler','prolific_sidebar_twitter','allecaded_prolific','prolific-setting-section');
		//register theme
		register_setting('prolific-theme-group','post_formats');
		register_setting('prolific-theme-group','post_header');
		add_settings_section('prolific-theme-section','Theme Options','prolifics_theme_options','allecaded_theme');
		add_settings_field('theme-options','Post Name','prolific_theme_name','allecaded_theme','prolific-theme-section');
		add_settings_field('theme-header','Header Name','prolific_theme_header','allecaded_theme','prolific-theme-section');

		//adding contact option
		register_setting('prolific-add-contact','activate_contact');
		add_settings_section('prolific-contact-section','Contact Form','prolific_contact_options','allecaded_contact');
		add_settings_field('activate-options','Active Contact Form','prolific_activate_contact','allecaded_contact','prolific-contact-section');

		//adding Custom Css
		register_setting('prolific-add-css','prolific_css');
		add_settings_section('prolific-css-section','Custom CSS','prolific_css_section_callback','allecaded_css');
		add_settings_field('custom-css-field','Insert your Custom CSS','prolific_custom_css_field','allecaded_css','prolific-css-section');


	}

	//for custom css
	function prolific_add_custom_css(){
		require_once(get_template_directory().'/admin/add-custom-css.php');
	}
	function prolific_css_section_callback(){
		echo "Customize your Own CSS";
	}
	function prolific_custom_css_field(){
		$css=get_option('prolific_css');
		$css=(empty($css) ? '/* prolific  Theme Custom Css */':$css);
		echo '<div id="customCss">'.$css.'</div>';
	}

	//for contact
	function prolific_add_contact(){
		require_once(get_template_directory().'/admin/add-contact.php');
	}
	function prolific_contact_options(){
		echo"sabin";
	}
	function prolific_activate_contact(){
		$options=get_option('activate_contact');
			$checked=(@$options==1 ? 'checked':'');
			echo '<label><input type="radio" id="activate_contact" name="activate_contact" value="1"'.$checked.'/></label><br>';
	}

	//for theme
	


	function prolifics_theme_options(){
		echo'<p>Custom theme options</p>';
	}
	function prolific_theme_name(){
		$options=get_option('post_formats') ;
		$formats=array('aside','gallery','link','video','audio','image','status','quote','chat');
		$output='';
		foreach($formats as $format){
			$checked=(@$options[$format]==1 ? 'checked':'');
			$output .= '<label><input type="radio" id="'.$format.'" name="post_formats['.$format.']" value="1"'.$checked.'/>'.$format.'</label><br>';
		}
		echo $output;
	}
	function prolific_theme_header(){
		$options=get_option('post_header');
			$checked=(@$options==1 ? 'checked':'');
			echo '<label><input type="radio" id="post_header" name="post_header" value="1"'.$checked.'/>Activate</label><br>';
	}

	//activate sidebar 

	function prolific_sidebar_media(){
		$picture=esc_attr(get_option('picture_file'));
		if(empty($picture)){
			echo '<input type="button" value="Upload" id="upload-button"><input type="hidden" id="profile-picture" value="" name="picture_file" />';
		}
		else{
		echo '<input type="button" value="Replace profile picture" id="upload-button"><input type="hidden" id="profile-picture" value="'.$picture.'" name="picture_file" /><input type="button" value="Remove" id="delete-picture" />';
	       }

	}


	function prolific_sidebar_name(){
		$firstname=esc_attr(get_option('first_name'));
		$lastname=esc_attr(get_option('last_name'));
		echo '<input type="text" value="'.$firstname.'" name="first_name" placeholder="FirstName"/><input type="text" value="'.$lastname.'" name="last_name" placeholder="LastName"/>';
	}
	function prolific_sidebar_twitter(){
		$twitterhand=esc_attr(get_option('twitter_handler'));
		echo '<input type="text" value="'.$twitterhand.'" name="twitter_handler" placeholder="twitterHandler"/><p class="description">input twitter id without @ character</p>';
	}
	//sanitize settings
	function prolific_sanitizer_twitter($input){
		$output = sanitize_text_field($input);
		$output = str_replace('@', '',$output);
		return $output;
	}

	function prolifics_sidebar_options(){
		//

	}
	function prolific_add_setting(){
		
	}
	//for theme 
	function prolific_add_theme(){
		require_once(get_template_directory().'/admin/prolific-theme.php');
	}
	//for sidebar
	function prolific_create_page(){
		require_once(get_template_directory().'/admin/prolific-sidebar.php');
	}