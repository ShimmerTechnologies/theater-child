<?php

/**

 * @package 	WordPress

 * @subpackage 	Theater

 * @version		1.0.5

 * 

 * Single Post Template

 * Created by CMSMasters

 * 

 */

$custom = get_post_custom($post->ID);

if( isset($custom["dates"][0]) && !empty($custom["dates"][0]) ){
	$dates = $custom["month"][0] . " " . $custom["dates"][0] . ", " . $custom["year"][0];
} else {
	$dates = null;
}
if(isset($custom["dates2"][0]) && !empty($custom["dates2"][0]) ){
	if($custom["month2"][0] == null || $custom["dates2"][0] == null || $custom["year2"][0] == null ) {
		$dates2 = null;							
	} else {							
		$dates2= $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];
	}
} else {
	$dates2 = null;
}

if(isset($custom["time"][0])){
	$timeStart1 = $custom["time"][0] . " " . $custom["ampm"][0];
}
if(isset($custom["timeEnd"][0])){
	$timeEnd1 = $custom["timeEnd"][0] . " " . $custom["ampmEnd"][0];
}
if(isset($custom["time2"][0])){
	$timeStart2 = $custom["time2"][0] . " " . $custom["ampm2"][0];
}
if(isset($custom["timeEnd2"][0])){
	$timeEnd2 = $custom["timeEnd2"][0] . " " . $custom["ampmEnd2"][0];
}

if(isset($custom["time"][0]) && isset($custom["ampm"][0]) ){
	$timeRange1 = $custom["time"][0] . "" . $custom["ampm"][0] . " - " . $custom["timeEnd"][0] . "" . $custom["ampmEnd"][0]; 
}
if(isset($custom["time2"][0]) && isset($custom["ampm2"][0]) ){
	$timeRange2 = $custom["time2"][0] . "" . $custom["ampm2"][0] . " - " . $custom["timeEnd2"][0] . "" . $custom["ampmEnd2"][0]; 
}
if(isset($custom["moredates"][0])){
	$moredates = $custom["moredates"][0];
}
if(isset($custom["writer"][0])){
	$writer = $custom["writer"][0];
}
if(isset($custom["director"][0])){
	$director = $custom["director"][0];
}
if(isset($custom["synopsis"][0])){
	$synopsis = $custom["synopsis"][0];
}

if(isset($custom["address"][0])){
	$address = $custom["address"][0];
}
if(isset($custom["city"][0])){
	$city = $custom["city"][0];
}
if(isset($custom["state"][0])){
	$state = $custom["state"][0];
}
if(isset($custom["zip"][0])){
	$zip = $custom["zip"][0];
}
if(isset($custom["moreinfo"][0])){
	$moreinfo = $custom["moreinfo"][0];
}
if(isset($custom["link"][0])){
	$link = $custom["link"][0];
}
if(isset($custom["extlink"][0])){
	$extlink = $custom["extlink"][0];
}

if(isset($custom["contact"][0])){
	$contact = $custom["contact"][0];
}
if(isset($custom["email"][0])){
	$email = $custom["email"][0];
}
if(isset($custom["phone"][0])){
	$phone = $custom["phone"][0];
}

$featureImage = get_the_post_thumbnail($post->ID, 'feature_audition');
$category = get_the_term_list($post->ID, 'audition-type');

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

	echo '<div class="blog opened-article">';	


				$cmsmasters_option = theater_get_global_options();



				$cmsmasters_post_title = get_post_meta(get_the_ID(), 'cmsmasters_post_title', true);



				$cmsmasters_post_sharing_box = get_post_meta(get_the_ID(), 'cmsmasters_post_sharing_box', true);



				$cmsmasters_post_author_box = get_post_meta(get_the_ID(), 'cmsmasters_post_author_box', true);



				$cmsmasters_post_more_posts = get_post_meta(get_the_ID(), 'cmsmasters_post_more_posts', true);


				list($cmsmasters_layout) = theater_theme_page_layout_scheme();



				if ($cmsmasters_layout == 'fullwidth') {

					$cmsmasters_image_thumb_size = 'cmsmasters-full-masonry-thumb';

				} else {

					$cmsmasters_image_thumb_size = 'cmsmasters-masonry-thumb';

				}



				?>

				<!-- Start Post Single Article -->

				<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_open_post'); ?>>

					<?php 

					global $post;

					if ( $post->post_parent ){

						the_content();

					} else {		


					if ( has_post_thumbnail() ) {
						echo '<div class="audition_image_thumb">';
						the_post_thumbnail('medium');
						echo '</div>';
					} 


					echo '<header class="cmsmasters_project_header entry-header">';			

							
							if (isset($writer) && !empty($writer)) {
								?>
								<div class="audition_writer audition_meta">
									<h4>Writer:</h4><span><?php echo $writer ?></span>
								</div>
								<?php 
							}
							if (isset($director) && !empty($director)) {
								?>
								<div class="audition_director audition_meta">
									<h4>Director:</h4><span><?php echo $director ?></span>
								</div>
								<?php 
							} 

							if (isset($dates) && !empty($dates) && $dates != null) {
								?>
									<div class="audition_dates audition_meta">				
									<h4>Auditions:</h4>
									<span><?php echo $dates; 
										if ( isset($timeStart1) && isset($timeEnd1) ){
											echo "  @  " . $timeRange1;
										}
								?>
									</span>
									<br>				
								<?php 
							}
							if (isset($dates2) && !empty($dates2) && $dates2 != null) {

								?>
									<span><?php echo $dates2; 
										if ( isset($timeStart2) && isset($timeEnd2) ){
											echo "  @  " . $timeRange2;
										}
								?>
									</span>
									<br>
									<?php 
							}
							if ( isset($moredates) && !empty($moredates) ) {
								?>
									<span><?php echo $moredates; ?></span>
									<br>
									</div>
								<?php 
								} else {
									echo '</div>';
							}
						

						if(isset($extlink) && !empty($extlink) && $extlink != null) {

							echo '<div id="cmsmasters_button_8x097x19tk" class="button_wrap audition_meta"><a href="'. $extlink .'" class="cmsmasters_button" ><span>Sign Up</span></a></div>';

						} else if(isset($link) && !empty($link) && $link != null)  {

							echo '<div id="cmsmasters_button_8x097x19tk" class="button_wrap audition_meta"><a href="'. $link .'" class="cmsmasters_button" ><span>Sign Up</span></a></div>';

						} else {
							echo '';
						}

						echo '</header>';


						echo '<div class="audition_meta_content">';

							?>
									<?php if (isset($address) && !empty($address)): ?>
									<div class="address">
										<h3>Location:</h3>
										<p><?php echo $address; ?></p>
										<p><?php if (isset($city)) : echo $city;  endif; if (isset($state)): echo ", " . $state; endif; ?></p>
										<p><?php if (isset($zip)) : echo $zip; endif; ?></p>
									</div>
									<br>
									<span class="bold"><?php if (isset($moreinfo) && !empty($moreinfo)): 
												echo $moreinfo; 
										endif;
										?>
									</span>	
									<?php
									endif;

									if (isset($synopsis) && !empty($synopsis)): ?>

									<div class="synopsis">
										<h3>Synopsis:</h3>
										<p><?php echo $synopsis; ?></p>
									</div>

									<?php 

									endif; 	

									if (isset($contact) && !empty($contact)): ?>

									<div class="contact">
										<h3>Questions?</h3>
										<p>
										<?php echo '<span class="bold">Contact Director: </span>'. $contact; ?>
										<br>
										<?php if(isset($email)): echo '<span class="bold">Email: </span><a href="mailto:' . $email . '">' . $email . '</a>'; endif; ?>
										<br>
										<?php if(isset($phone) && !empty($phone)): echo '<span class="bold">Phone: </span>' . $phone; endif; ?>
										</p>
									</div>

									<?php 

									endif; 					


					echo '</div>';
					

					if (get_the_content() != '') {

						echo '<div class="cmsmasters_post_content entry-content">';

							echo '<h3>Characters:</h3>';
			
							the_content();
							

							wp_link_pages(array( 

								'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . esc_html__('Pages', 'theater') . ':</strong>', 

								'after' => '</div>', 

								'link_before' => '<span>', 

								'link_after' => '</span>' 

							));

							

						echo '</div>';

					}




				}

				?>

				</article>

				<!-- Finish Post Single Article -->

				<?php



				if ($cmsmasters_post_sharing_box == 'true') {

					theater_sharing_box(esc_html__('Like this post?', 'theater'));

				}

				if ( !$post->post_parent ){

					if ($cmsmasters_option['theater' . '_blog_post_nav_box']) {

						$order_cat = (isset($cmsmasters_option['theater' . '_blog_post_nav_order_cat']) ? $cmsmasters_option['theater' . '_blog_post_nav_order_cat'] : false);				

						new_theater_prev_next_posts($order_cat, 'category');

					}

				}



				if ($cmsmasters_post_author_box == 'true') {

					theater_author_box(esc_html__('About author', 'theater'), 'h3', 'h5');

				}





				if (get_the_tags()) {

					$tgsarray = array();

					

					foreach (get_the_tags() as $tagone) {

						$tgsarray[] = $tagone->term_id;

					}

				} else {

					$tgsarray = '';

				}





				if ($cmsmasters_post_more_posts != 'hide') {

					theater_related( 

						'h3', 

						esc_html__('More posts', 'theater'), 

						esc_html__('No posts found', 'theater'), 

						$cmsmasters_post_more_posts, 

						$tgsarray, 

						$cmsmasters_option['theater' . '_blog_more_posts_count'], 

						$cmsmasters_option['theater' . '_blog_more_posts_pause'], 

						'post' 

					);

				}





				echo theater_get_pings(get_the_ID(), 'h2');





				comments_template(); 

	

	

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




