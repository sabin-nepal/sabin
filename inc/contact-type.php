<?php 

	$contact=get_option('activate_contact');
			 if(@$contact==1){
			 	add_action('init','prolific_contact_custom_post_type');
			 	add_filter('manage_prolific-contact_posts_columns','prolific_set_contact_columns');
			 	add_action('manage_prolific-contact_posts_custom_column','prolific_contact_custom_columns',10,2);
			 	add_action('add_meta_boxes','prolific_contact_add_meta_boxes');
			 	add_action('save_post','prolific_save_contact_email_data');
			 }

	function prolific_contact_custom_post_type(){
		$labels=array(
			'name'=>'Message',
			'singular_name'=>'Message',
			'menu_name'=>'Message',
			'name_admin_bar'=>'Message'

		);
		$args=array(
			'labels'=>$labels,
			'show_ui'=>true,
			'show_in_menu'=>true,
			'capability_type'=>'post',
			'hierarchical'=>false,
			'menu_position'=>26,
			'menu_icon'=>'dashicons-email-alt',
			'hierarchical'=>false,
			'supports'=>array('title','editor','author')

			

		);
		register_post_type('prolific-contact',$args);
	}

	function prolific_set_contact_columns($columns){
		$newColumns = array();
		$newColumns['title']='Full Name';
		$newColumns['message']='Message';
		$newColumns['email']='Email';
		$newColumns['date']='Date';
		return $newColumns;
	}

	function prolific_contact_custom_columns($column,$post_id){
		switch($column){
			case'message':
				echo get_the_excerpt();
				break;
			case'email':
				$email=get_post_meta($post_id,'_contact_email_value_key',true);
				echo $email;
				break;
		}
	}
/*COntact meta Boxes*/

	function prolific_contact_add_meta_boxes(){
		add_meta_box('contact_email','User Email','prolific_contact_email_callback','prolific-contact','side');
	}
	function prolific_contact_email_callback($post){
		wp_nonce_field('prolific_save_contact_email_data','prolific_contact_email_nonce');
		$value= get_post_meta($post->ID,'_contact_email_value_key',true);
		echo '<label for="prolific_contact_email_field">User Email address</label>';
		echo '<input type="text" id="prolific_contact_email_field" name="prolific_contact_email_field" value="'.esc_attr($value).'" />';
	}
	function prolific_save_contact_email_data($post_id){
		if(!isset($_POST['prolific_contact_email_nonce'])){
			return;
		}
		if(!wp_verify_nonce($_POST['prolific_contact_email_nonce'],'prolific_save_contact_email_data')){
			return;
		}
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
			return;
		}
		if(!current_user_can('edit_post',$post_id)){
			return;
		}
		if(!isset($_POST['prolific_contact_email_field'])){
			return;
		}
		$my_data= sanitize_text_field($_POST['prolific_contact_email_field']);
		update_post_meta($post_id,'_contact_email_value_key',$my_data);
	}