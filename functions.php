<?php

/**

 * @package 	WordPress

 * @subpackage 	Theater Child

 * @version		1.0.0

 * 

 * Child Theme Functions File

 * Created by CMSMasters

 * 

 */

function theater_enqueue_styles() {

    wp_enqueue_style('theater-child-style', get_stylesheet_uri(), array(), '1.0.0', 'screen, print');

}
add_action('wp_enqueue_scripts', 'theater_enqueue_styles', 99);

get_template_part('show-manager');

get_template_part('audition-manager');

function custom_widget_featured_image() {
	global $post;

	echo tribe_event_featured_image( $post->ID, 'thumbnail' );
}
add_action( 'tribe_events_list_widget_before_the_event_title', 'custom_widget_featured_image' );

//the ticket button for the shows & event pages
function add_notes(){

	global $post;
	$custom = get_post_custom($post->ID);
	if( isset($custom["info"]) ){
		$notes = $custom["info"][0];
	} else {
		$notes = null;
	}

	if ( $notes != "" && $notes != null  ) { 
		echo '<p><strong>' . esc_html( $notes ) . '</strong></p>';
	}

}
add_action('tribe_events_single_event_after_the_content', 'add_notes');


if ( function_exists( 'register_sidebar' ) ) 
	{ 
		register_sidebar( array (
			'name' => esc_html__('Subscribe', 'theater'), 
			'id' => 'sidebar_subscribe',
			'description' => esc_html__('Subscriptions widget should be added here to be shown in the footer', 'theater'), 
            'before_widget' => '<aside id="%1$s" class="subscribe-widget widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
			) );
		register_sidebar( array (
			'name' => esc_html__('Support', 'theater'), 
			'id' => 'sidebar_support',
			'description' => esc_html__('Widgets should be added here to be shown on the support us page', 'theater'), 
            'before_widget' => '<div id="sidebar-support"><aside id="%1$s" class="support-widget widget %2$s">', 
            'after_widget' => '</aside></div>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
			) );
		register_sidebar( array (
			'name' => esc_html__('Workshops', 'theater'), 
			'id' => 'sidebar_projects',
			'description' => esc_html__('Widgets should be added here to be shown on the Theater Workshops page', 'theater'), 
            'before_widget' => '<div id="sidebar-projects"><aside id="%1$s" class="projects-widget widget %2$s">', 
            'after_widget' => '</aside></div>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
		) );
		register_sidebar( array (
			'name' => esc_html__('Auditions', 'theater'), 
			'id' => 'sidebar_auditions',
			'description' => esc_html__('Widgets should be added here to be shown on the Auditions page', 'theater'), 
            'before_widget' => '<div id="sidebar-auditions"><aside id="%1$s" class="auditions-widget widget %2$s">', 
            'after_widget' => '</aside></div>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
		) );


}

remove_action('cmsmasters_after_header_mid_search', 'theater_woocommerce_cart_dropdown');

remove_action('cmsmasters_after_header_bot', 'theater_woocommerce_cart_dropdown');

function new_theater_register_css_styles() {

	if (!is_admin()) {

		global $post, 

			$wp_styles;	
		

		$cmsmasters_option = theater_get_global_options();

		

		wp_enqueue_style('theater-theme-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'screen, print');

		

		wp_enqueue_style('theater-style', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/style.css', array(), '1.0.0', 'screen, print');

		

		wp_enqueue_style('theater-adaptive', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/adaptive.css', array(), '1.0.0', 'screen, print');

		

		wp_enqueue_style('theater-retina', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/retina.css', array(), '1.0.0', 'screen');

		

		

		if (is_rtl()) {

			wp_enqueue_style('theater-rtl', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/rtl.css', array(), '1.0.0', 'screen');

		}

		

		

		wp_enqueue_style('theater-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');

		

		wp_enqueue_style('theater-icons-custom', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/fontello-custom.css', array(), '1.0.0', 'screen');

		

		wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0', 'screen');

		

		

		// iLightBox skins

		$ilightbox_skin = $cmsmasters_option['theater' . '_ilightbox_skin'];

		

		wp_enqueue_style('ilightbox', get_template_directory_uri() . '/css/ilightbox.css', array(), '2.2.0', 'screen');

		

		wp_enqueue_style('ilightbox-skin-' . $ilightbox_skin, get_template_directory_uri() . '/css/ilightbox-skins/' . $ilightbox_skin . '-skin.css', array(), '2.2.0', 'screen');

		

		

		// Fonts and Colors styles

		function fn_get_upload_dir_var( $param, $subfolder = '' ) {
		    $upload_dir = wp_upload_dir();
		    $url = $upload_dir[ $param ];
		 
		    if ( $param === 'baseurl' && is_ssl() ) {
		        $url = str_replace( 'http://', 'https://', $url );
		    }
		 
		    return $url . $subfolder;
		}

		$upload_dir = fn_get_upload_dir_var('basedir');
		$upload_url = fn_get_upload_dir_var('baseurl');
		

		$style_dir = str_replace('\\', '/', $upload_dir . '/cmsmasters_styles');	
		

		$cmsmasters_styles_dir = get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/styles/';	
		

		if (is_dir($style_dir) && get_option('cmsmasters_style_exists_' . 'theater')) {

			$cmsmasters_styles_dir = $upload_url . '/cmsmasters_styles/';

		}			

		wp_enqueue_style('theater-fonts-schemes', $cmsmasters_styles_dir . 'theater' . '.css', array(), '1.0.0', 'screen');

	}

}


remove_action('wp_enqueue_scripts', 'theater_register_css_styles');
add_action('wp_enqueue_scripts', 'new_theater_register_css_styles');

/* Auditions M



/* Get Profiles Features Function */

function new_theater_get_profile_features($features_position = 'features', $features = '', $features_title = false, $tag = 'h2', $show = true) {

	global $post;
	$custom = get_post_custom($post->ID);

	if(isset($custom["website"])){
		$website = $custom["website"][0];
	}

	if (

		(
			!empty($features[0][0]) || 	!empty($features[0][1])

		) || (

			!empty($features[1][0]) || 	!empty($features[1][1])

		)

	) {

		$out = '';		

		if ($features_position == 'features') {

			$out .= '<div class="profile_features entry-meta">' . 

				($features_title ? '<' . esc_html($tag) . ' class="profile_features_title">' . esc_html($features_title) . '</' . esc_html($tag) . '>' : '');

		}
	

		foreach ($features as $feature) {

			$out .= '<div class="profile_' . esc_attr($features_position) . '_item' . ($feature[0] == '' || $feature[1] == '' ? ' profile_' . esc_attr($features_position) . '_one_item' : '') . '">';



				if ($feature[0] != '') {

					$out .= '<div class="profile_' . esc_attr($features_position) . '_item_title">' . esc_html($feature[0]) . '</div>';

				}				

				

				if ($feature[1] != '') {

					$feature_lists = explode("\n", $feature[1]);					

					

					$out .= '<div class="profile_' . esc_attr($features_position) . '_item_desc">';

						

						foreach ($feature_lists as $feature_list) {

							$out .= trim($feature_list);

						}

						

					$out .= '</div>';

				}

				$out .= '</div>';
	
		}

		if( ! empty($website) && $features_position == 'details' ){

					$out .= '<div class="profile_details_item">';

	
						$out .= '<div class="profile_details_item_title">Website</div>';
			

						$out .= '<div class="profile_details_item_desc">';							

						$out .= 	'<a href="' . $website . '">' . wp_kses( $website, 'post' ) . '</a>';							

						$out .= '</div>';

					$out .= '</div>';

		}
		

		if ($features_position == 'features') {

			$out .= '</div>';

		} 		

		if ($show) {

			print $out;

		} else {

			return $out;

		}

	}

}

/* Get Page Heading Function */

function new_theater_page_heading() {

	if (is_404() || is_home() || is_page(array(7366, 'home')) ) {

		echo "<div class=\"headline\">

			<div class=\"headline_outer cmsmasters_headline_disabled\"></div>

		</div>";

	} else {

		$cmsmasters_option = theater_get_global_options();
		

		if (is_singular()) {

			$cmsmasters_page_id = get_the_ID();

		} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {

			$cmsmasters_page_id = wc_get_page_id('shop');

		}
		

		$cmsmasters_heading = '';	

		if (

			is_singular() || 

			(CMSMASTERS_WOOCOMMERCE && is_shop())

		) {

			//$cmsmasters_heading = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading', true);
			$cmsmasters_heading = 'default';
			
		}
		

		if (

			$cmsmasters_heading != '' && 

			(

				is_singular() || 

				(CMSMASTERS_WOOCOMMERCE && is_shop())

			)

		) {

			//$cmsmasters_heading_block_disabled = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_block_disabled', true);
			$cmsmasters_heading_block_disabled = false;

			$cmsmasters_header_overlaps = get_post_meta($cmsmasters_page_id, 'cmsmasters_header_overlaps', true);
			
			$cmsmasters_heading_alignment = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_alignment', true);

			$cmsmasters_heading_scheme = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_scheme', true);

			

			$cmsmasters_heading_title = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_title', true);

			$cmsmasters_heading_subtitle = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_subtitle', true);

			$cmsmasters_heading_icon = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_icon', true);

			

			$cmsmasters_breadcrumbs = get_post_meta($cmsmasters_page_id, 'cmsmasters_breadcrumbs', true);

		} else {

			$cmsmasters_heading = 'default';

			$cmsmasters_heading_block_disabled = 'false';

			$cmsmasters_header_overlaps = $cmsmasters_option['theater' . '_header_overlaps'] ? 'true' : 'false';

			

			$cmsmasters_heading_alignment = $cmsmasters_option['theater' . '_heading_alignment'];

			$cmsmasters_heading_scheme = $cmsmasters_option['theater' . '_heading_scheme'];

			

			$cmsmasters_breadcrumbs = $cmsmasters_option['theater' . '_breadcrumbs'] ? 'true' : 'false';

		}		

		

		if (

			CMSMASTERS_TRIBE_EVENTS && 

			tribe_is_event_query() && 

			is_archive() 

		) {

			$cmsmasters_heading = 'disabled';

		}		

		

		list($cmsmasters_layout) = theater_theme_page_layout_scheme();		

	

		if (

			$cmsmasters_heading_block_disabled == 'true' && 

			$cmsmasters_layout == 'fullwidth' && 

			$cmsmasters_header_overlaps == 'true' 

		) {

			echo "";

		} else {

			echo "<div class=\"headline cmsmasters_color_scheme_{$cmsmasters_heading_scheme}\">

				<div class=\"headline_outer" . ($cmsmasters_heading == 'disabled' ? ' cmsmasters_headline_disabled' : '') . "\">

					<div class=\"headline_color\"></div>";

			

			

			if ($cmsmasters_heading != 'disabled') {

				echo "<div class=\"headline_inner align_{$cmsmasters_heading_alignment}\">

					<div class=\"headline_aligner\"></div>" . 

					'<div class="headline_text' . (($cmsmasters_heading == 'custom') ? (($cmsmasters_heading_icon != '') ? ' headline_icon ' . $cmsmasters_heading_icon : '') . (($cmsmasters_heading_subtitle != '') ? ' headline_subtitle' : '') : '') . '">';

				

				

				if ($cmsmasters_heading == 'custom') {

					if ($cmsmasters_heading_title != '') {

						echo '<h1 class="entry-title">' . esc_html($cmsmasters_heading_title) . '</h1>';

					}
					

					if ($cmsmasters_heading_subtitle != '') {

						echo '<h4 class="entry-subtitle">' . esc_html($cmsmasters_heading_subtitle) . '</h4>';

					}

				} elseif (CMSMASTERS_WOOCOMMERCE && is_woocommerce() && !is_singular()) {

					echo '<h1 class="entry-title">';
					

						esc_html(woocommerce_page_title());
						

					echo '</h1>';

				} elseif (is_archive() || is_search()) {

					echo '<h1 class="entry-title">';

					if (is_search()) {

						global $wp_query;

						if (!empty($wp_query->found_posts)) {

							echo sprintf(esc_html(_n('%1$d search result for: %2$s', '%1$d search results for: %2$s', $wp_query->found_posts, 'theater')), $wp_query->found_posts, get_search_query());

						} else {

							echo sprintf(esc_html__('0 search results for: %s', 'theater'), get_search_query());

						}

					} elseif (is_archive()) {

						if (is_author()) {

							if (get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '') {

								echo sprintf(esc_html__('Author: %1$s (%2$s %3$s)', 'theater'), '<span class="vcard">' . get_the_author() . '</span>', get_the_author_meta('first_name'), get_the_author_meta('last_name'));

							} else {

								echo sprintf(esc_html__('Author: %s', 'theater'), '<span class="vcard">' . get_the_author() . '</span>');

							}

						} else {
							
							if ( is_post_type_archive('auditions') ){
							    
							    echo esc_html(post_type_archive_title( '', false ));

							} else if ( is_post_type_archive('project') ){

								echo esc_html("Classes & Workshops"); 
								//esc_html(post_type_archive_title( '', false ));

							} else {

								echo esc_html(get_the_archive_title());

							}

						}

					}

					echo '</h1>';

				} elseif ($cmsmasters_heading == 'default') {

					echo the_title('<h1 class="entry-title">', '</h1>', false);

				}

				echo '</div>';

				if ( 

					!is_front_page() && 

					$cmsmasters_breadcrumbs == 'true' && 

					!(

						CMSMASTERS_TRIBE_EVENTS && 

						(

							tribe_is_list_view() || 

							tribe_is_month() || 

							tribe_is_day() || 

							(function_exists('tribe_is_past') && tribe_is_past()) || 

							(function_exists('tribe_is_upcoming') && tribe_is_upcoming()) || 

							(function_exists('tribe_is_week') && tribe_is_week()) || 

							(function_exists('tribe_is_map') && tribe_is_map()) || 

							(function_exists('tribe_is_photo') && tribe_is_photo()) 

						)

					)

				) {

					echo '<div class="cmsmasters_breadcrumbs">' . 

						'<div class="cmsmasters_breadcrumbs_aligner"></div>' . 

						'<div class="cmsmasters_breadcrumbs_inner">';
	

					if (CMSMASTERS_WOOCOMMERCE && is_woocommerce()) {

						woocommerce_breadcrumb();

					} elseif (function_exists('yoast_breadcrumb')) {

						$yoast_enable = get_option('wpseo_internallinks');
										

						if ($yoast_enable['breadcrumbs-enable']) {

							yoast_breadcrumb();

						} else {

							if( function_exists( 'bcn_display' ) ) { bcn_display(); } 
							//theater_breadcrumbs();

						}

					} else {

							if( function_exists( 'bcn_display' ) ) { bcn_display(); } 
							//theater_breadcrumbs();
					}		


					echo '</div>' . 

					'</div>';

				}			
				

				echo "</div>";

			}			
			

				echo "</div>

			</div>";

		}

	}

}

// define the bcn_breadcrumb_title callback 
function filter_bcn_breadcrumb_title( $title, $this_type, $this_id ) { 
        
    if ( is_post_type_archive('project') ){
       $title = __('Theater Workshops');
    }

    return $title; 
}; 
             
// add the filter 
add_filter( 'bcn_breadcrumb_title', 'filter_bcn_breadcrumb_title', 10, 3 ); 

function new_theater_prev_next_posts($order_cat = false, $tax_name = 'category') {

	$cmsmasters_post_type = get_post_type();

	$published_posts = wp_count_posts($cmsmasters_post_type)->publish;


	$next_post = get_next_post();
	
	if(!empty($next_post)){

		$parentNext = $next_post->post_parent;

		$templateNext = get_post_meta($next_post->ID,'_wp_page_template',true);

	}


	$prev_post = get_previous_post();

	if(!empty($prev_post)){

		$parentPrev = $prev_post->post_parent;

		$templatePrev = get_post_meta($prev_post->ID,'_wp_page_template',true);

	
	}


	if ($published_posts > 1) {

		if($cmsmasters_post_type == 'project'){
	
				echo '<aside class="post_nav">';

				if(!empty($prev_post)){	

					if( $parentPrev > 0 || $templatePrev == 'single-project.php' ){

						return;

					} else {

						previous_post_link('<span class="cmsmasters_prev_post"><span class="post_nav_sub">' . esc_html__('Previous Link', 'theater') . '</span>%link<span class="cmsmasters_prev_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);

					}	

				}	

				if(!empty($next_post)){

					if( $parentNext > 0 || $templateNext == 'single-project.php' ){

						return;

					} else {			

						next_post_link('<span class="cmsmasters_next_post"><span class="post_nav_sub">' . esc_html__('Next Link', 'theater') . '</span>%link<span class="cmsmasters_next_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);	

					}	

				}			

				echo '</aside>';

		
		} else if($cmsmasters_post_type == 'auditions'){

				echo '<aside class="post_nav">';

				if(!empty($prev_post)){	

					if( $parentPrev > 0 || $templatePrev == 'single-project.php' ){

						return;

					} else {

						previous_post_link('<span class="cmsmasters_prev_post"><span class="post_nav_sub">' . esc_html__('Previous Link', 'theater') . '</span>%link<span class="cmsmasters_prev_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);

					}	

				}	

				if(!empty($next_post)){

					if( $parentNext > 0 || $templateNext == 'single-project.php' ){

						return;

					} else {			

						next_post_link('<span class="cmsmasters_next_post"><span class="post_nav_sub">' . esc_html__('Next Link', 'theater') . '</span>%link<span class="cmsmasters_next_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);	

					}	

				}			

				echo '</aside>';


		} else {

				echo '<aside class="post_nav">';			

				previous_post_link('<span class="cmsmasters_prev_post"><span class="post_nav_sub">' . esc_html__('Previous Link', 'theater') . '</span>%link<span class="cmsmasters_prev_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);
			

				next_post_link('<span class="cmsmasters_next_post"><span class="post_nav_sub">' . esc_html__('Next Link', 'theater') . '</span>%link<span class="cmsmasters_next_arrow"><span></span></span></span>', '%title', $order_cat, '', $tax_name);
						

				echo '</aside>';

		}

	}

}

/* Get Projects Features Function */

function new_theater_get_project_features($features_position = 'features', $features = '', $features_title = false, $tag = 'h2', $show = true) {

	if (

		(

			!empty($features[0][0]) || 

			!empty($features[0][1])

		) || (

			!empty($features[1][0]) || 

			!empty($features[1][1])

		)

	) {

		$out = '';

		

		if ($features_position == 'features') {

			$out .= ($features_title ? '<' . esc_html($tag) . ' class="project_features_title">' . esc_html($features_title) . '</' . esc_html($tag) . '>' : '') . 

			'<div class="project_features entry-meta">';

		}

		

		

		foreach ($features as $feature) {

			$out .= '<div class="project_' . esc_attr($features_position) . '_item' . ($feature[0] == '' || $feature[1] == '' ? ' project_' . esc_attr($features_position) . '_one_item' : '') . '">';

				

				if ($feature[0] != '') {

					$out .= '<div class="project_' . esc_attr($features_position) . '_item_title">' . esc_html($feature[0]) . '</div>';

				}

				

				

				if ($feature[1] != '') {

					$feature_lists = explode("\n", $feature[1]);

					

					

					$out .= '<div class="project_' . esc_attr($features_position) . '_item_desc">';

						

						foreach ($feature_lists as $feature_list) {

							$out .= trim(nl2br($feature_list));

						}

						

					$out .= '</div>';

				}

				

			$out .= '</div>';

		}

		

		

		if ($features_position == 'features') {

			$out .= '</div>';

		}

		

		if ($show) {

			print $out;

		} else {

			return $out;

		}

	}

}

?>