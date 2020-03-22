<?php

/**

Template Name: Single Workshop Form
Template Post Type: project

 * @package 	WordPress

 * @subpackage 	Theater

 * @version		1.0.5

 * 

 * Single Project Template

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





if (have_posts()) : the_post();

	echo '<div class="portfolio opened-article">';

	$parent = $post->post_parent;

	$template = get_post_meta($post->ID,'_wp_page_template',true);

	if ($parent < 1){

		if( $template == 'single-project.php' ){

			get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/postType/portfolio/project-single-form');

		} else {

			get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/postType/portfolio/project-single');
		}


	}


	
	

	echo '</div>';

endif;





echo '</div>' . "\n" . 

'<!-- Finish Content -->' . "\n\n";





if ($cmsmasters_layout == 'r_sidebar') {

	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 

	'<div class="sidebar">' . "\n";

	

	

	get_sidebar();

	

	

	echo "\n" . '</div>' . "\n" . 

	'<!-- Finish Sidebar -->' . "\n";

} elseif ($cmsmasters_layout == 'l_sidebar') {

	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 

	'<div class="sidebar fl">' . "\n";

	

	

	get_sidebar();

	

	

	echo "\n" . '</div>' . "\n" . 

	'<!-- Finish Sidebar -->' . "\n";

}





get_footer();

