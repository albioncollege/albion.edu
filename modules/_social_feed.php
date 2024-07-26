<?php 
/**
 * Social Feed Module
 * 
 * Module partial used to display juicer feed.
 *
 */

$juicerid = get_sub_field('juicer_id'); 
$heading_level = get_sub_field('heading_level');
$heading = get_sub_field('heading');
$intro_text = get_sub_field('intro_text');
$insta_link = get_sub_field('instagram_link');

if( $juicerid ): ?>
    <div class="social-slider__component">
	  <div class="container--purple">
	    <div class="container social-slider__header">
	      <div class="social-slider__heading">
	        <?php if($heading): ?>
		      <?php if($heading_level == 'h2'): ?>
		        <h2 class="large-headline"><?php echo $heading; ?></h2>
		      <?php elseif($heading_level == 'h3'): ?>
		        <h3 class="large-headline"><?php echo $heading; ?></h3>
		      <?php elseif($heading_level == 'h4'): ?>
		        <h4 class="large-headline"><?php echo $heading; ?></h4>
		      <?php elseif($heading_level == 'h5'): ?>
		        <h5 class="large-headline"><?php echo $heading; ?></h5>
		      <?php elseif($heading_level == 'h6'): ?>
		        <h6 class="large-headline"><?php echo $heading; ?></h6>
		      <?php else : ?>
		        <div class="large-headline"><?php echo $heading; ?></div>
		      <?php endif; ?>
		    <?php endif; ?>
		    <?php if($intro_text): ?>
	        	<p class="text-teal"><?php echo $intro_text; ?></p>
	        <?php endif; ?>
	      </div>
	      <div class="social-slider__nav">
	        <button class="social-slider__button social-slider__previous"><?php echo svgstore('icon-arrow-left', 'previous', '') ?></button>
	        <button class="social-slider__button social-slider__next"><?php echo svgstore('icon-arrow-right', 'next', '') ?></button>
	      </div>
	    </div>
	    <div class="social-slider">
	      <div class="social-slider__container container--purple">
	        <div class="social-slider__contents social__grid" data-feedUrl="<?php echo $juicerid ? $juicerid : 'albioncollege'; ?>">

	        </div>
	      </div>
	      <div class="social-slider__links">
	        <?php if( $insta_link ) : ?>
	            <a href="<?php echo $insta_link['url']; ?>" class="button__link social-slider__insta"  <?php echo link_target( $insta_link ); ?>><?php echo $insta_link['title']; ?></a>
	        <?php endif; ?>
	      </div>
	    </div>
	  </div>
	</div>
<?php endif; ?>
 