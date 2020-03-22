<?php 

/**

 * @package 	WordPress

 * @subpackage 	Theater

 * @version		1.0.2

 * 

 * Archive Template

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
if(isset($custom["moredates"][0]) && !empty($custom["moredates"][0]) ){
	$moredates = $custom["moredates"][0];
} else {
	$moredates = null;
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


$current_tax = '';



$current_tax .= (has_term('', 'category') ? 'category' : '');

$current_tax .= (has_term('', 'pj-categs') ? 'pj-categs' : '');

$current_tax .= (has_term('', 'product_cat') ? 'product_cat' : '');

$current_tax .= (has_term('', 'tribe_events_cat') ? 'tribe_events_cat' : '');

$current_tax .= (has_term('', 'cp-categs') ? 'cp-categs' : '');

$current_tax .= (has_term('', 'events_category') ? 'events_category' : '');

$current_tax .= (has_term('', 'srm-categs') ? 'srm-categs' : '');

$current_tax .= (has_term('', 'audition_type') ? 'audition_type' : '');



?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_archive_type'); ?>>

	<?php 

	if (!post_password_required() && has_post_thumbnail()) {

		echo '<div class="cmsmasters_archive_item_img_wrap">';

			theater_thumb(get_the_ID(), 'cmsmasters-project-grid-thumb');

		echo '</div>';

	}

	?>

	<div class="cmsmasters_archive_item_cont_wrap">

		<div class="cmsmasters_archive_item_type">

			<?php

			$post_type_obj = get_post_type_object(get_post_type());

			

			echo '<span>' . $post_type_obj->labels->singular_name . '</span>';

			?>

		</div>

		<?php

		

		if (cmsmasters_title(get_the_ID(), false) != get_the_ID()) {

			?>

			<header class="cmsmasters_archive_item_header entry-header">

				<h2 class="cmsmasters_archive_item_title entry-title">

					<a href="<?php esc_url(the_permalink()); ?>">

						<?php cmsmasters_title(get_the_ID(), true); ?>

					</a>

				</h2>

			</header>

			<?php 

		}

		if ( is_post_type_archive('auditions') ){	

			if (isset($dates) && !empty($dates) && $dates != null) {
				?>
					<div class="cmsmasters_archive_item_type audition_meta audition_dates">				
					<h3>Auditions:</h3>
					<span><?php echo $dates; 
						if ( isset($timeStart1) && isset($timeEnd1) ){
							echo "  @  " . $timeRange1;
						}
				?>
					</span>				
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
					<?php 
			}
			if (isset($moredates) && !empty($moredates) && $moredates != null) {
				?>
					<span><?php echo $moredates; ?></span>
					</div>
				<?php 
				} else if (isset($dates) && !empty($dates) && $dates != null) {
					echo '</div>';
				} 
			if (isset($writer) && !empty($writer)) {
				?>
				<div class="cmsmasters_archive_item_type audition_meta">
					<h4>Writer:</h4><span><?php echo $writer ?></span>
				</div>
				<?php 
			}
			if (isset($director) && !empty($director)) {
				?>
				<div class="cmsmasters_archive_item_type audition_meta">
					<h4>Director:</h4><span><?php echo $director ?></span>
				</div>
				<?php 
			} 
			if( isset($synopsis) && !empty($synopsis) ){

				echo cmsmasters_divpdel('<div class="cmsmasters_archive_item_content entry-content">' . "\n" . 

					sprintf($synopsis) . 

				'</div>' . "\n");
				
			} else if (theater_excerpt(55, false) != '') {

				echo cmsmasters_divpdel('<div class="cmsmasters_archive_item_content entry-content">' . "\n" . 

					wpautop(theater_excerpt(55, false)) . 

				'</div>' . "\n");

			}

			echo '<div id="cmsmasters_button_8x097x19tk" class="button_wrap audition_button"><a href="' . get_permalink($post->ID) . '" class="cmsmasters_button" >Read More...</a></div>';
		
		} else {

			if (theater_excerpt(55, false) != '') {

			echo cmsmasters_divpdel('<div class="cmsmasters_archive_item_content entry-content">' . "\n" . 

				wpautop(theater_excerpt(55, false)) . 

			'</div>' . "\n");

			}

		}	

		

		if (get_post_type() == 'post' || $current_tax != '') {

			echo '<footer class="cmsmasters_archive_item_info entry-meta">';

				

				if (get_post_type() == 'post') {

					echo '<span class="cmsmasters_archive_item_date_wrap">' . 

						'<abbr class="published cmsmasters_archive_item_date" title="' . esc_attr(get_the_date()) . '">';

							

							

							if (cmsmasters_title(get_the_ID(), false) == get_the_ID()) {

								echo '<a href="' . esc_url(get_permalink()) . '">' . 

									get_the_date() . 

								'</a>';

							} else {

								echo get_the_date();

							}

							

							

						echo '</abbr>' . 

						'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 

							get_the_modified_date() . 

						'</abbr>' . 

					'</span>' . 

					'<span class="cmsmasters_archive_item_user_name">' . 

						esc_html__('by', 'theater') . ' ' . 

						'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author" title="' . esc_attr__('Posts by', 'theater') . ' ' . get_the_author_meta('display_name') . '">' . get_the_author_meta('display_name') . '</a>' . 

					'</span>';

				}

				

				

				if ($current_tax != '') {

					echo '<span class="cmsmasters_archive_item_category">' . 

						esc_html__('In', 'theater') . ' ' . 

						theater_get_the_category_list(get_the_ID(), $current_tax, ', ') . 

					'</span>';

				}

				

			echo '</footer>';

		}

		?>

	</div>

</article>