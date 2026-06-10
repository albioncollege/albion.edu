<?php
/**
 * Campus Map Module
 * 
 * Module partial used to display Albion Map
 *
 */
   $tour_link     = get_sub_field( 'tour_link' );
   $popup_content = get_sub_field( 'popup_content' );
   $locations      = get_sub_field( 'locations' );
?>
<div class="campus-map" id="campus-map">
	<div class="map-wrapper">
		
		<div id="map" data-locations="<?php echo esc_attr( wp_json_encode( $locations ) ); ?>"></div>
		
		<div class="info-wrapper container--purple">
			<div id="info">
				<div id="property-info">
				</div>
				<div id="map-info">
					<div class="popup-content">
					<?php if ( $popup_content ) : ?>
						<?php echo $popup_content;?>
					<?php endif; ?>
					</div>
					<button class='button' id='view-map'>View Map</button>
					<?php 
					if ( $tour_link ):
						$link_url = $tour_link['url'];
						$link_title = $tour_link['title'];
						$link_target = $tour_link['target'] ? $tour_link['target'] : '_self';
						?>
						<a class='button' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	
	<dialog id="dialog" class="container--purple">
		<div id="dialog-wrapper"></div>
		<button class="button" commandfor="dialog" command="close">Close</button>
	</dialog>
	
	<script
	  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6Yrr8fIi91K4ucFlIXdvxWXukHyfmDiU&callback=initMap&v=weekly"
	  defer
	></script>
	
</div>