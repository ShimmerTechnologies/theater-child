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

	if(isset($custom["writer"][0])){
		$writer = $custom["writer"][0];
	} else if(isset($custom["teacher"][0])) {
		$teacher = $custom["teacher"][0];
	} else {
		$writer = null;
	}
	if(isset($custom["director"][0])){
		$director = $custom["director"][0];
	} else {
		$director = null;
	}
	if(isset($custom["ticket"][0])){
		$ticket = $custom["ticket"][0];
	}
	$price = $custom["price"][0];
	$dates= $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];;
	if($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null ) {
		$dates2 = null;							
	} else {							
		$dates2= $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
	}
	if(isset($custom["credits"][0])){
		$credits = $custom["credits"][0];
	}
	if(isset($custom["info"])){
            $info= $custom["info"][0];
    } 
    if(isset($custom["page_id"])){
                    $page_id= $custom["page_id"][0];
                    $link = $custom["link"][0];
        } else {
        	$page_id = null;
        	$link = null;
    }
			
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





$project_sidebar = '';



if (

	$project_details == 'true' || 

	(

		!empty($cmsmasters_project_features_one[0][0]) || 

		!empty($cmsmasters_project_features_one[0][1])

	) || (

		!empty($cmsmasters_project_features_one[1][0]) || 

		!empty($cmsmasters_project_features_one[1][1])

	) || (

		!empty($cmsmasters_project_features_two[0][0]) || 

		!empty($cmsmasters_project_features_two[0][1])

	) || (

		!empty($cmsmasters_project_features_two[1][0]) || 

		!empty($cmsmasters_project_features_two[1][1])

	) || (

		!empty($cmsmasters_project_features_three[0][0]) || 

		!empty($cmsmasters_project_features_three[0][1])

	) || (

		!empty($cmsmasters_project_features_three[1][0]) || 

		!empty($cmsmasters_project_features_three[1][1])

	)

) {

	$project_sidebar = 'true';

}





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

	

	if ($cmsmasters_project_title == 'true') {

		echo '<div class="project-info">';	

		echo '<header class="cmsmasters_project_header entry-header">';			

			if(!empty($dates) && !empty($dates2)){

				echo '<div class="showDates bold" >' . $dates . ' - ' . $dates2 . '</div>';
			}

			theater_project_title_nolink(get_the_ID(), 'h2');

			if(isset($teacher) && $teacher != null) {

				echo '<div class="authors bold">Teacher: ' . $teacher . '</div>';

			} else if(isset($writer)) {

				echo '<div class="authors bold">'; 

				if(isset($director) && $director != null) {

						echo 'Directed by ' . $director. ", ";

				}

				echo 'Written by ' . $writer;

				echo ' </div>';

			} else if(isset($director) && $director != null) {

				echo '<div class="authors bold">';

				if(isset($writer)) {

					echo 'Written by ' . $writer . ", "; 
					
				}

				echo 'Directed by ' . $director;
				echo ' </div>';

			} 
			//teacher and writer are not set echo html
			else {

				echo '<div class="authors bold"></div>';

			}

			if(isset($credits)) {
				echo '<div class="morecredits bold">' . $credits . '</div>';
			}

			if(isset($price)) {
				echo '<div class="price">' . $price . '</div>';
			}

		echo '</header>';

		if(isset($page_id) && !empty($page_id)) {

			echo '<button class="tickets" onclick="location.href=\'' . $link  . '\'" type="button">Sign Up</button>';

		} else if(isset($ticket) && !empty($ticket)) {

			echo '<button class="tickets" onclick="location.href=\'' . $ticket  . '\'" type="button">Sign Up</button>';

		} 

		echo '</div>';	



	}

	

	

	echo '<div class="project_content' . (($project_sidebar == 'true') ? ' with_sidebar' : '') . '">';

		

		if ($cmsmasters_post_format == 'video') {

			$cmsmasters_project_video_type = get_post_meta(get_the_ID(), 'cmsmasters_project_video_type', true);

			$cmsmasters_project_video_link = get_post_meta(get_the_ID(), 'cmsmasters_project_video_link', true);

			$cmsmasters_project_video_links = get_post_meta(get_the_ID(), 'cmsmasters_project_video_links', true);

			

			theater_post_type_video(get_the_ID(), $cmsmasters_project_video_type, $cmsmasters_project_video_link, $cmsmasters_project_video_links, 'cmsmasters-project-full-thumb');

		}

		
		?>
		<p class="bold">
		<?php if (isset($info) && !empty($info)): 
				echo nl2br($info); 
			endif;
		?>
		</p>

		<?php

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

	

	

	if ($project_sidebar == 'true') {

		echo '<div class="project_sidebar">';

			

			if ($project_details == 'true') {

				if ($cmsmasters_project_details_title != '') {

					echo '<h5 class="project_details_title">' . esc_html($cmsmasters_project_details_title) . '</h5>';

				}

				

				echo '<div class="project_details entry-meta">';

					

					theater_get_project_likes('post');

					

					theater_get_project_comments('post');

					

					theater_get_project_author('post');

					

					theater_get_project_date('post');

					

					theater_get_project_category(get_the_ID(), 'pj-categs', 'post');

					

					theater_get_project_tags(get_the_ID(), 'pj-tags');

					

					new_theater_get_project_features('details', $cmsmasters_project_features, false, 'h5', true);

					

					theater_project_link($cmsmasters_project_link_text, $cmsmasters_project_link_url, $cmsmasters_project_link_target);

					

				echo '</div>';

			}

			

			

			new_theater_get_project_features('features', $cmsmasters_project_features_one, $cmsmasters_project_features_one_title, 'h5', true);

			

			new_theater_get_project_features('features', $cmsmasters_project_features_two, $cmsmasters_project_features_two_title, 'h5', true);

			

			new_theater_get_project_features('features', $cmsmasters_project_features_three, $cmsmasters_project_features_three_title, 'h5', true);

			

		echo '</div>';

	}

	?>

</article>

<!-- Finish Project Single Article -->

<?php 



if ($cmsmasters_project_sharing_box == 'true') {

	theater_sharing_box(esc_html__('Like this project?', 'theater'));

}





if ($cmsmasters_option['theater' . '_portfolio_project_nav_box']) {

	$order_cat = (isset($cmsmasters_option['theater' . '_portfolio_project_nav_order_cat']) ? $cmsmasters_option['theater' . '_portfolio_project_nav_order_cat'] : false);

	

	new_theater_prev_next_posts($order_cat, 'pj-categs');

}





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
