<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
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



$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$cost = tribe_get_formatted_cost();

global $post;
$custom = get_post_custom($post->ID);
if( isset($custom["website"])){
	$website = $custom["website"][0];
} else  {
	$website = null;
}

if( isset($custom["price"])){
	$price = $custom["price"][0];
} else {
	$price = null;
}
if( isset($custom["month"]) && isset($custom["dates"]) ){
	$dates = $custom["month"][0] . " " . $custom["dates"][0];
} else {
	$dates = null;
}

if( isset($custom["month2"]) && isset($custom["dates2"]) && isset($custom["year2"]) ){
					
	$dates2 = $custom["month2"][0] . " " . $custom["dates2"][0] . ", " . $custom["year2"][0];

} else {

	$dates2 = null;	

}
?>

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h5 class="tribe-events-single-section-title"><?php esc_html_e( 'Details', 'the-events-calendar' ) ?></h5>
	<div class="cmsmasters_event_meta_info">
		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Start:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php 
					
					if( ! empty($dates) ):
						echo esc_html( $dates );
					else:
						echo esc_html( $start_date );
					endif;
					
					?> </abbr>
				</span>
			</div>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'End:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr dtend" title="<?php echo esc_attr( $end_ts ) ?>"> <?php 
					if( ! empty($dates2) ):
						echo esc_html($dates2);
					else:					
						echo esc_html( $end_date );
					endif;
					
					?> </abbr>
				</span>
			</div>

		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Date:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php 

					if( ! empty($dates) ):
						echo esc_html( $dates );
					else:
						echo esc_html( $start_date );
					endif;

					?> </abbr>
				</span>
			</div>

		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Start:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php 

					
					if( ! empty($dates) ):
						echo esc_html( $dates );
					else:
						echo esc_html( $start_datetime );
					endif;


					?> </abbr>
				</span>
			</div>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'End:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr dtend" title="<?php echo esc_attr( $end_ts ) ?>"> <?php 

					if( ! empty($dates2) ):
						echo esc_html($dates2);
					else:					
						echo esc_html( $end_datetime );
					endif;					

					?> </abbr>
				</span>
			</div>

		<?php
		// Single day events
		else :
			?>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Date:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $start_ts ) ?>"> <?php 

					echo esc_html( $start_date ) 


					?> </abbr>
				</span>
			</div>
			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Time:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr">
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $end_ts ) ?>">
						<?php 

						if ( $start_time == $end_time ) {
							echo esc_html( $start_time );
						} else {
							echo esc_html( $start_time . $time_range_separator . $end_time );
						} 


						?>
					</abbr>
				</span>
			</div>

		<?php endif ?>

		<?php
		// Event Cost
		if ( ! empty( $cost ) || ! empty( $price ) ) : ?>

			<div class="cmsmasters_event_meta_info_item">
				<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Cost:', 'the-events-calendar' ) ?></span>
				<span class="cmsmasters_event_meta_info_item_descr tribe-events-event-cost">
				<?php 
					if( ! empty($price) ):				
						echo esc_html( $price );
					else:
						echo esc_html( $cost ); 
					endif;
				?>
				</span>
			</div>
		<?php endif;

		if (get_the_terms(get_the_id(), 'tribe_events_cat')) {
			$cmsmasters_tribe_events_cat_count = sizeof(get_the_terms(get_the_id(), 'tribe_events_cat'));
			
			
			echo '<div class="cmsmasters_event_meta_info_item">' . 
				'<span class="cmsmasters_event_meta_info_item_title">' . 
					sprintf(_n('%s Category', '%s Categories', $cmsmasters_tribe_events_cat_count, 'the-events-calendar'), tribe_get_event_label_singular()) . 
				'</span>' . 
				'<span class="cmsmasters_event_meta_info_item_descr tribe-events-event-categories">' . 
					theater_get_the_category_list(get_the_id(), 'tribe_events_cat', ', ') . 
				'</span>' . 
			'</div>';
		}
		
		
		$cmsmasters_event_tags = tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'the-events-calendar' ), tribe_get_event_label_singular() ), ', ', false );
		
		if ($cmsmasters_event_tags) {
			echo '<div class="cmsmasters_event_meta_info_item cmsmasters_event_tags">' . 
				'<dl>' . tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'the-events-calendar' ), tribe_get_event_label_singular() ), ', ', false ) . '</dl>' . 
			'</div>';
		}
		?>

		<?php
		// Event Website
		if ( ! empty( $website ) ) : 
		?>					
					<div class="cmsmasters_event_meta_info_item">
					<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Website:', 'the-events-calendar' ) ?></span>
					<span class="cmsmasters_event_meta_info_item_descr tribe-events-event-url"><a href="<?php echo $website; ?>"><?php echo wp_kses( $website, 'post' ); ?></a></span>
					</div>
	
	<?php 
		
		endif; 
		do_action( 'tribe_events_single_meta_details_section_end' ); ?>

	</div>
</div>