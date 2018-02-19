<?php 
$options=get_option('post_formats') ;
		$formats=array('aside','gallery','link','video','audio','image','status','quote','chat');
		$output=array();
		foreach($formats as $format){
			$output[]=(@$options[$format]==1 ? $format:'');
		}
		if(!empty($options)){
			add_theme_support('post-formats',$output);
		}

		$header=get_option('post_header');
			if(@$header==1){
				add_theme_support('custom-header');
			}


	//function to show meta tag

		function prolific_posted_meta(){
			$posted_on= human_time_diff( get_the_time('U'), current_time( 'timestamp' ) );
			$categories = get_the_category();
			$output ='';
			$seperator=', ';
			if(!empty($categories)){
				foreach($categories as $category){

				$output .='<a href="'.esc_url(get_category_link( $category->term_id)).'">'. $category->name.'</a>'.$seperator ;
			}
		}
			return '<span>Posted <a href="'. esc_url(get_permalink()).'">'.$posted_on .  '</a>ago</span>|' .trim($output,$seperator) ;

			
		}

		function prolific_posted_footer(){
			$comments_num = get_comments_number();
			if(comments_open()){
				if($comments_num ==0){
					$comments=__('No Comments');
				}
				elseif($comments_num > 1){
					$comments=$comments_num.__('Comments');
				}
				else{
					$comments =__('1 Comment');
				}
				$comments='<a href="'.get_comment_link().'">'.$comments.'</a>';
				}
			else{
				$comments=__('Comments are closed');
			}
			return $comments;
		}
