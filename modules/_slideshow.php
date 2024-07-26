<?php 
/**
 * Slideshow Module
 * 
 * Module partial used to display a slideshow.
 *
 */

$images = get_sub_field('images');
if( $images ): ?>
    <div class="media media--slider">
        <?php foreach( $images as $image ): ?>
            <div class="media__slide">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php if ($image['caption']) : ?>
                    <p class="media__caption"><?php echo esc_html($image['caption']); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>