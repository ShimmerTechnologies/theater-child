<?php

/**


 * @package 	WordPress

 * @subpackage 	Theater

 * @version		1.0.7

 * 

 * Project Single Template

 * Created by CMSMasters

 * 

 */





$cmsmasters_option = theater_get_global_options();





$cmsmasters_project_title = get_post_meta(get_the_ID(), 'cmsmasters_project_title', true);



$cmsmasters_project_features = get_post_meta(get_the_ID(), 'cmsmasters_project_features', true);



$cmsmasters_project_image_show = get_post_meta(get_the_ID(), 'cmsmasters_project_image_show', true);





$cmsmasters_project_link_text = get_post_meta(get_the_ID(), 'cmsmasters_project_link_text', true);

$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);

$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);





$cmsmasters_project_details_title = get_post_meta(get_the_ID(), 'cmsmasters_project_details_title', true);





$cmsmasters_project_features_one_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one_title', true);

$cmsmasters_project_features_one = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one', true);



$cmsmasters_project_features_two_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two_title', true);

$cmsmasters_project_features_two = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two', true);



$cmsmasters_project_features_three_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three_title', true);

$cmsmasters_project_features_three = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three', true);

/* custom project fields */

	$custom = get_post_custom($post->ID);
	
			
	$featureImage = get_the_post_thumbnail($post->ID, 'feature_show');
	$category = get_the_term_list($post->ID, 'show-type');


/* end */


$project_details = '';



if (

	$cmsmasters_option['theater' . '_portfolio_project_like'] || 

	$cmsmasters_option['theater' . '_portfolio_project_date'] || 

	$cmsmasters_option['theater' . '_portfolio_project_cat'] || 

	$cmsmasters_option['theater' . '_portfolio_project_comment'] || 

	$cmsmasters_option['theater' . '_portfolio_project_author'] || 

	$cmsmasters_option['theater' . '_portfolio_project_tag'] || 

	$cmsmasters_option['theater' . '_portfolio_project_link'] || 

	(

		!empty($cmsmasters_project_features[0][0]) || 

		!empty($cmsmasters_project_features[0][1])

	) || (

		!empty($cmsmasters_project_features[1][0]) || 

		!empty($cmsmasters_project_features[1][1])

	)

) {

	$project_details = 'true';

}





$project_sidebar = false;



$cmsmasters_post_format = get_post_format();



$project_tags = get_the_terms(get_the_ID(), 'pj-tags');





$cmsmasters_project_sharing_box = get_post_meta(get_the_ID(), 'cmsmasters_project_sharing_box', true);



$cmsmasters_project_author_box = get_post_meta(get_the_ID(), 'cmsmasters_project_author_box', true);



$cmsmasters_project_more_posts = get_post_meta(get_the_ID(), 'cmsmasters_project_more_posts', true);



?>

<!-- Start Project Single Article -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_open_project'); ?>>

	<?php

	if ($cmsmasters_post_format == 'gallery') {

		$cmsmasters_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_project_images', true))));

		$cmsmasters_project_columns = get_post_meta(get_the_ID(), 'cmsmasters_project_columns', true);

		

		theater_post_type_gallery(get_the_ID(), $cmsmasters_project_images, $cmsmasters_project_columns, 'cmsmasters-project-thumb', 'show-image');

	} elseif ($cmsmasters_post_format == '') {

		$cmsmasters_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_project_images', true))));

		

		if ($cmsmasters_project_image_show == 'true' && $cmsmasters_project_images[0] == '') {

			echo '';

		} else {

			theater_post_type_slider(get_the_ID(), $cmsmasters_project_images, 'show-image');

		}

	}	

	

	echo '<div class="project_content' . (($project_sidebar == 'true') ? ' with_sidebar' : '') . '">';

		

		if ($cmsmasters_post_format == 'video') {

			$cmsmasters_project_video_type = get_post_meta(get_the_ID(), 'cmsmasters_project_video_type', true);

			$cmsmasters_project_video_link = get_post_meta(get_the_ID(), 'cmsmasters_project_video_link', true);

			$cmsmasters_project_video_links = get_post_meta(get_the_ID(), 'cmsmasters_project_video_links', true);

			

			theater_post_type_video(get_the_ID(), $cmsmasters_project_video_type, $cmsmasters_project_video_link, $cmsmasters_project_video_links, 'cmsmasters-project-full-thumb');

		}

		

		

		if (get_the_content() != '') {

			echo '<div class="cmsmasters_project_content entry-content">' . "\n";

				

				the_content();			

				

				wp_link_pages(array( 

					'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . esc_html__('Pages', 'theater') . ':</strong>', 

					'after' => '</div>', 

					'link_before' => '<span>', 

					'link_after' => '</span>' 

				));

				

			echo '</div>';

		}

		

	echo '</div>';

	

	?>

</article>

<!-- Finish Project Single Article -->

<?php 


if ($cmsmasters_project_author_box == 'true') {

	theater_author_box(esc_html__('About author', 'theater'), 'h3', 'h5');

}



if ($project_tags) {

	$tgsarray = array();

	

	foreach ($project_tags as $tagone) {

		$tgsarray[] = $tagone->term_id;

	}  

} else {

	$tgsarray = '';

}


if ($cmsmasters_project_more_posts != 'hide') {

	theater_related( 

		'h3', 

		esc_html__('More projects', 'theater'), 

		esc_html__('No projects found', 'theater'), 

		$cmsmasters_project_more_posts, 

		$tgsarray, 

		$cmsmasters_option['theater' . '_portfolio_more_projects_count'], 

		$cmsmasters_option['theater' . '_portfolio_more_projects_pause'], 

		'project',

		'pj-tags'

	);

}

