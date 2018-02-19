<?php 

?>
<article id="post-<?php the_ID();?>"<?php post_class();?>>
<h1><a href="<?php esc_url( get_permalink());?>"><?php the_title();?></a></h1>
	<?php echo  prolific_posted_meta();?>
	<?php the_content();?>
	<?php echo prolific_posted_footer();?>