<?php

/**

 * @package 	WordPress

 * @subpackage 	Theater

 * @version		1.0.5

 * 

 * Blog Archives Page Template

 * Created by CMSMasters

 * 

 */





get_header();





list($cmsmasters_layout) = theater_theme_page_layout_scheme();





echo '<!-- Start Content -->' . "\n";





if ($cmsmasters_layout == 'r_sidebar') {

	echo '<div class="content entry">' . "\n\t";

} elseif ($cmsmasters_layout == 'l_sidebar') {

	echo '<div class="content entry fr">' . "\n\t";

} else {

	echo '<div class="middle_content entry">';

}





echo '<div class="cmsmasters_archive">' . "\n";





if (!have_posts()) : 

	if ( is_post_type_archive('project') ):

		echo '<h2>' . esc_html__('There are currently no workshops at this time', 'theater') . '</h2>';

	elseif ( is_post_type_archive('auditions') ):

		echo '<h2>' . esc_html__('There are currently no auditions at this time', 'theater') . '</h2>';

	else:

		echo '<h2>' . esc_html__('No posts found', 'theater') . '</h2>';

	endif;

else : 

	while (have_posts()) : the_post();

	$parent = $post->post_parent;

	$template = get_post_meta($post->ID,'_wp_page_template',true);

	if ($parent < 1){

		if( is_post_type_archive('auditions') || ( is_post_type_archive('project') && $template != 'single-project.php' ) ){

			get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/template/archive-custom');

		} else if($template != 'single-project.php') {

			get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/template/archive');
		}


	}

		

	endwhile;
	

	echo cmsmasters_pagination();

endif;





echo '</div>' . "\n" . 

'</div>' . "\n" . 

'<!-- Finish Content -->' . "\n\n";





if ($cmsmasters_layout == 'r_sidebar') {

	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 

	'<div class="sidebar">' . "\n";

	if ( is_post_type_archive('auditions') ) {

		get_sidebar('auditions');

	} else if ( is_post_type_archive('project') ){

		get_sidebar('workshops');

	} else {

		get_sidebar();

	}

	

	echo "\n" . '</div>' . "\n" . 

	'<!-- Finish Sidebar -->' . "\n";

} elseif ($cmsmasters_layout == 'l_sidebar') {

	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 

	'<div class="sidebar fl">' . "\n";
	

	if ( is_post_type_archive('auditions') ) {

		get_sidebar('auditions');

	} else if ( is_post_type_archive('project') ){

		get_sidebar('workshops');

	} else {

		get_sidebar();

	}

	

	echo "\n" . '</div>' . "\n" . 

	'<!-- Finish Sidebar -->' . "\n";

}





get_footer();



