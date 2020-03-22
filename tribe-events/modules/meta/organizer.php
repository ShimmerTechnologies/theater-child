<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
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

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

global $post;
$custom = get_post_custom($post->ID);
if(isset($custom["writer"])){
	$writer = $custom["writer"][0];
} else {
	$writer = null;
}
if(isset($custom["director"])){
	$director = $custom["director"][0];
} else {
	$director = null;
}


if ( tribe_has_organizer() ) {

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();

?>

	<div class="tribe-events-meta-group tribe-events-meta-group-organizer">

			<h5 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h5>
			<div class="cmsmasters_event_meta_info">
				<?php
				do_action( 'tribe_events_single_meta_organizer_section_start' );

				foreach ( $organizer_ids as $organizer ) {
					if ( ! $organizer ) {
						continue;
					}

					?>
					<div class="cmsmasters_event_meta_info_item">
						<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Organizer Name:', 'theater'); ?></span>
						<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo tribe_get_organizer_link( $organizer ); ?></span>
					</div>

					<?php
				}
				if ( ! $multiple ) { // only show organizer details if there is one
					if ( ! empty( $phone ) ) {
						?>
						<div class="cmsmasters_event_meta_info_item">
							<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?></span>
							<span class="cmsmasters_event_meta_info_item_descr tel"><?php echo esc_html( $phone ); ?></span>
						</div>
						<?php
					}//end if

					if ( ! empty( $email ) ) {
						?>
						<div class="cmsmasters_event_meta_info_item">
							<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Email:', 'the-events-calendar' ) ?></span>
							<span class="cmsmasters_event_meta_info_item_descr email"><?php echo esc_html( $email ); ?></span>
						</div>
						<?php
					}//end if

					if ( ! empty( $website ) ) {
						?>
						<div class="cmsmasters_event_meta_info_item">
							<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e( 'Website:', 'the-events-calendar' ) ?></span>
							<span class="cmsmasters_event_meta_info_item_descr url"><?php echo wp_kses( $website, 'post' ); ?></span>
						</div>
						<?php
					}//end if
				}//end if

				if ( $writer != null ):

					?>
					<div class="cmsmasters_event_meta_info_item">
						<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Writer:', 'theater'); ?></span>
						<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo $writer; ?></span>

					</div>

				<?php endif;
				if ( $director != null ):

					?>
					<div class="cmsmasters_event_meta_info_item">
						<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Director:', 'theater'); ?></span>
						<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo $director; ?></span>

					</div>

				<?php endif;

				do_action( 'tribe_events_single_meta_organizer_section_end' );
				?>

			</div>
	</div>
<?php

} else if( $director != null || $writer != null ) {

?>
		<div class="tribe-events-meta-group tribe-events-meta-group-organizer">

			<h5 class="tribe-events-single-section-title">Credits</h5>
			<div class="cmsmasters_event_meta_info">
				<?php
				do_action( 'tribe_events_single_meta_organizer_section_start' );

				if ( $writer != null ):

					?>
					<div class="cmsmasters_event_meta_info_item">
						<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Writer:', 'theater'); ?></span>
						<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo $writer; ?></span>

					</div>

				<?php endif;
				if ( $director != null ):

					?>
					<div class="cmsmasters_event_meta_info_item">
						<span class="cmsmasters_event_meta_info_item_title"><?php esc_html_e('Director:', 'theater'); ?></span>
						<span class="cmsmasters_event_meta_info_item_descr fn org"><?php echo $director; ?></span>

					</div>

				<?php endif; 

				do_action( 'tribe_events_single_meta_organizer_section_end' );
				?>

			</div>
	</div>

<?php
}
?>