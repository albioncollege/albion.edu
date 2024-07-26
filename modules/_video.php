<?php 
/**
 * Video Module
 * 
 * Module partial used to display video and caption.
 *
 */

$video = get_sub_field( 'video_url' );
$caption = get_sub_field( 'caption' );
?>
<?php if ( $video ) : ?>
	<div class="media">
		<div class="video">
			<?php echo $video; ?>
		</div>
	  	<?php if ( $caption ) : ?>
		  <p class="media__caption">
		    <?php echo $caption; ?>
		  </p>		
		<?php endif; ?>
	</div>
<?php endif; ?>