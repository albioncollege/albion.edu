<?php 
/**
 * Program Template Module: Faculty Quotes
 * 
 * Module partial used to display faculty quotes from the Quotes custom post type.
 *
 */

if( have_rows( 'quotes' ) ): ?>
    <div class="testimonial-slider-program__component">
        <div class="background">
            <div class="testimonial-slider">
                <div class="testimonial-slider__container container--purple">
                    <div class="testimonial-slider__items">
                        <div class="testimonial-slider__nav">
                            <button class="testimonial-slider__button testimonial-slider__previous">
                                <?php echo svgstore('icon-arrow-left', 'Left Arrow', ''); ?>
                            </button>
                            <button class="testimonial-slider__button testimonial-slider__next">
                                <?php echo svgstore('icon-arrow-right', 'Right Arrow', ''); ?>
                            </button>
                        </div>
                        <?php while ( have_rows('quotes') ) : the_row();
                            $faculty_quotes = get_sub_field( 'quote');
                            $quote_image    = get_field( 'image', $faculty_quotes->ID );
                            $video          = get_field( 'video', $faculty_quotes->ID, false );
                            $image_size     = 'quote';  
                            if( $quote_image ) : ?>
                                <div class="testimonial-slider__media">
                                    <?php echo wp_get_attachment_image( $quote_image, $image_size ); ?>
                                    <?php if( $video ) : ?>
                                        <a class="testimonial__icon" href="<?php echo esc_url( $video ); ?>" data-minimodal="">
                                            <?php echo svgstore('icon-play', 'Play', ''); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; //end $quote_image. ?>
                        <?php endwhile; ?>
                    </div>

                    <div class="testimonial-slider__contents">
                        <?php while ( have_rows('quotes') ) : the_row(); 
                            $faculty_quotes = get_sub_field( 'quote');
                            $quote          = get_field( 'quote', $faculty_quotes->ID );
                            $attribution_1  = get_field( 'attribution', $faculty_quotes->ID );
                            $attribution_2  = get_field( 'attribution2', $faculty_quotes->ID ); ?>
                            <?php if( $quote ) : ?>
                                <div class="testimonial-slider__content">
                                    <div class="blockquote__icon"></div>
                                    <p class="testimonial__text"><?php echo wp_kses_post( $quote ); ?></p>
                                    <?php if ( $attribution_1 ) : ?>
                                        <div class="testimonial__cite"><?php echo esc_html( $attribution_1 ); ?></div>
                                    <?php endif; ?>
                                    <?php if ( $attribution_2 ) : ?>
                                        <div class="testimonial__attr"><?php echo esc_html( $attribution_2 ); ?></div>
                                    <?php endif; ?>
                                    <?php $links = get_field( 'links', $faculty_quotes->ID );
                                    if ( $links ) : ?>
                                        <p class="blockquote__link">
                                        <?php foreach( $links as $link ) :
                                            $quote_link = $link['link'];
                                            if ( $quote_link ) : ?>
                                                <a href="<?php echo $quote_link['url']; ?>" class="button__link" <?php echo link_target( $quote_link ); ?>><?php echo $quote_link['title']; ?></a>
                                            <?php endif; //$quote_link. ?>
                                        </p>
                                        <?php endforeach; //$links. ?>
                                    <?php endif; //$links. ?>
                                </div>
                            <?php endif; //$quote. ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; //$quotes ?>
 