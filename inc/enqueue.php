<?php 
	function prolific_register_admin_style($hook){
		//echo $hook;
		if('toplevel_page_allecaded_prolific' == $hook ){

		wp_register_style('prolific_admin_css',get_template_directory_uri().'/css/prolific-admin.css');
		wp_enqueue_style('prolific_admin_css');
		wp_enqueue_media();

		wp_register_script('prolific-script',get_template_directory_uri().'/js/prolific-jquery.js',array('jquery'));
		wp_enqueue_script('prolific-script');
	}
	else if('prolificdevs_page_allecaded_css'==$hook){
		wp_enqueue_style('aces',get_template_directory_uri().'/css/prolific-ace.css');
		wp_enqueue_script('ace',get_template_directory_uri(),'/js/ace/ace.js',array('jquery'),'1.2.1',true);
		wp_enqueue_script('prolific',get_template_directory_uri().'/js/prolific_custom.js',array('jquery'),'',true);

	}
	else{return;}

	}
	add_action('admin_enqueue_scripts','prolific_register_admin_style');


	// theme for front end

	function prolific_style_front_end(){
		wp_enqueue_style('style',get_stylesheet_uri());
		wp_enqueue_style('bootstrap',get_stylesheet_directory_uri().'/vendor/bootstrap/css/bootstrap.min.css');
		wp_enqueue_script('bootstrapcdn',get_stylesheet_directory_uri().'/vendor/bootstrap/js/bootstrap.min.js','','',true);
		wp_enqueue_style('agency',get_template_directory_uri().'/js/agency.min.js');
	}
	add_action('wp_enqueue_scripts','prolific_style_front_end');

	function prolific_add_theme_here(){
		register_nav_menus(array(
			'primary'=>'Header nav menu',
			'footer'=>'Footer nav menu'
			));
	}
	add_action('after_setup_theme','prolific_add_theme_here');