<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 * 
 * @cmsmasters_package 	Theater
 * @cmsmasters_version 	1.0.0
 * 
 */


if (!defined('ABSPATH')) {
	die('-1');
}


function theater_event_meta_info_col_num() {
	$col_num = 1;
	global $post;
	
	$custom = get_post_custom($post->ID);
	if( isset($writer)){
		$writer = $custom["writer"][0];
	} else {
		$writer = null;
	}

	if( isset($writer)){
		$director = $custom["director"][0];
	} else {
		$director = null;
	}

	if (tribe_has_venue()) {
		$col_num += 1;
	}
	
	if (tribe_has_organizer() || ! empty($director) || ! empty($writer) ){
		$col_num += 1;
	}
	
	if (function_exists('tribe_get_custom_fields') && tribe_get_custom_fields()) {
		$col_num += 1;
	}

	return $col_num;
}

$cmsmasters_event_meta_info_col = 'cmsmasters_event_meta_info_col_' . theater_event_meta_info_col_num();


do_action('tribe_events_single_meta_before');

echo '<div class="tribe-events-single-section tribe-events-event-meta cmsmasters_single_event_meta ' . $cmsmasters_event_meta_info_col . '">';
	
	do_action('tribe_events_single_event_meta_primary_section_start');
	
	tribe_get_template_part('modules/meta/details');
	
	
	if (tribe_has_venue()) {
		tribe_get_template_part('modules/meta/venue');
	}
	

	tribe_get_template_part('modules/meta/organizer');

	
	do_action('tribe_events_single_event_meta_primary_section_end');

echo '</div>';

do_action( 'tribe_events_single_meta_after' );
?>