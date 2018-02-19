<?php 
//remove version from js and css
function prolific_remove_wp_version($src){
	global $wp_version;
	parse_str(parse_url($src,PHP_URL_QUERY),$query );
	if(!empty($query['ver'] && $query['ver'] === $wp_version)){
		$src= remove_query_arg('ver',$src);

	}
	return $src;
}
add_filter('script_loader_src','prolific_remove_wp_version');
add_filter('style_loader_src','prolific_remove_wp_version');

//remove version from meta 
function sunset_meta_remove_version(){
	return '';
}
add_filter('the_generator','sunset_meta_remove_version');