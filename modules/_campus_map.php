<?php
/**
 * Campus Map Module
 * 
 * Module partial used to display Albion Map
 *
 */
   $tour_link     = get_sub_field( 'tour_link' );
   $popup_content = get_sub_field( 'popup_content' );
   $location      = get_sub_field( 'locations' );
?>
<div class="map-wrapper">
	
	<div id="map" data-locations="<?php echo esc_attr( wp_json_encode( $location ) ); ?>"></div>
	
	<div class="info-wrapper">
		<div id="info">
			<?php 
			  if ( $tour_link ):
				$link_url = $tour_link['url'];
				$link_title = $tour_link['title'];
				$link_target = $tour_link['target'] ? $tour_link['target'] : '_self';
				?>
				<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
			<button id="view-map">View Albion's Map</button>
		</div>
	</div>
	
</div>