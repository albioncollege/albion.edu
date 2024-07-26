<?php 
/**
 * Quote Module
 * 
 * Module partial used to display quotes custom post type.
 *
 */

$quotes = get_sub_field( 'quote' );

if( $quotes ): 
    $quote         = get_field( 'quote', $quotes->ID );
    $quote_image   = get_field( 'image', $quotes->ID );
    $size          = 'blockquote';
    $attribution_1 = get_field( 'attribution', $quotes->ID );
    $attribution_2 = get_field( 'attribution2', $quotes->ID ); ?>
    <blockquote>
    <div class="blockquote__content">
        <div class="blockquote__icon"></div>
        <?php if ( $quote ) : ?>
            <div class="blockquote__quote">
                <p><?php echo wp_kses_post( $quote ); ?></p>
            </div>
        <?php endif; ?>
        <div class="blockquote__author__wrapper">
            <div class="blockquote__author__photo">
                <?php if( $quote_image ) : ?>
                    <?php echo wp_get_attachment_image( $quote_image, $size ); ?>
                <?php endif; ?>
            </div>
            <div class="blockquote__author__details">
                <?php if ( $attribution_1 ) : ?>
                    <p class="blockquote__author"><?php echo esc_html( $attribution_1 ); ?></p>
                <?php endif; ?>
                <?php if ( $attribution_2 ) : ?>
                    <p class="blockquote__position"><?php echo esc_html( $attribution_2 ); ?></p>
                <?php endif; ?>
                <?php
                $links = get_field( 'links', $quotes->ID );
                if ( $links ) : ?>
                    <p class="blockquote__link">
                    <?php foreach( $links as $link ) :
                        $quote_link = $link['link'];
                        if ( $quote_link ) : ?>
                            <a href="<?php echo $quote_link['url']; ?>" class="button__link"><?php echo $quote_link['title']; ?></a>
                        <?php endif; //$quote_link ?>
                    </p>
                <?php
                    endforeach; 
                endif; //$links ?>
            </div>
        </div>
    </div>
</blockquote>
<?php endif; // quotes ?>