<?php
/**
 * Jumbo Panel Module
 * 
 * Module partial used to display tabs with a large headline and background image.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$background_image = get_sub_field( 'image' );
if ( have_rows('tabs') ) : ?>
    <div class="tabs-carousel__component">
      <div class="background">
            <?php if ( $subheading ) : ?>
                <div class="container">
                    <h2 class="large-headline"><?php echo esc_html( $subheading ); ?></h2>
                </div>
            <?php endif; ?>
            <?php
            if ( $background_image ) : 
                $image_url   = wp_get_attachment_url( $background_image );
                $image_style = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"'; ?>        
                <div class="tabs-carousel__photo" id="picArea" <?php echo $image_style; ?>></div>
            <?php endif; ?>

            <div class="tabs-carousel__container">
                <div class="tabs">
                    <div class="tabs-nav">
                        <?php while ( have_rows('tabs') ) : the_row();
                            $title         = get_sub_field('title');
                            $row_count     = get_row_index(); ?>

                            <?php if ( $title ) : ?>
                                <h3 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h3>
                            <?php endif; ?>
                        <?php endwhile; ?> 
                    </div>         
                    <div class="tabs-content container--purple">
                        <?php while ( have_rows('tabs') ) : the_row();
                            $title   = get_sub_field('title');
                            $content = get_sub_field('content'); ?>
                            <?php if ( $title ) : ?>
                                <button class="tabs__mobile__toggle" aria-expanded="false">
                                    <?php echo esc_html( $title ); ?>
                                    <span aria-hidden="true">
                                        <span class="tabs__icon tabs__icon--inactive">
                                            <?php echo svgstore('icon-accordion-open', 'Open', 'svgstore--icon-accordion-open'); ?>
                                        </span>
                                        <span class="tabs__icon tabs__icon--active">
                                            <?php echo svgstore('icon-accordion-close', 'Close', 'svgstore--icon-accordion-close'); ?>
                                        </span>
                                    </span>
                                </button>
                            <?php endif; ?>             

                            <div class="tabs__content__item" aria-expanded="true">
                                <?php echo wp_kses_post( $content ); ?>
                                <?php while (have_rows('tab_links')) : the_row(); ?>
                                    <?php get_template_part('modules/_' . get_row_layout()); ?>
                                <?php endwhile; ?>   
                            </div>  
                        <?php endwhile; ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>