<?php
/**
 * Tabs Module
 * 
 * Module partial used to display tabs.
 *
 */

if( have_rows('tabs') ): ?>
    <div class="tabs">
        <div class="tabs-nav">
            <?php while ( have_rows('tabs') ) : the_row();
                $title         = get_sub_field('title');
                $heading_level = get_sub_field('heading_level');
                $row_count     = get_row_index(); ?>
                

                <?php if ( $title ) : ?>
                    <?php if( $heading_level == 'h2' ): ?>
                        <h2 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h2>
                    <?php elseif( $heading_level == 'h3' ): ?>
                        <h3 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h3>
                    <?php elseif( $heading_level == 'h4' ): ?>
                        <h4 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h4>
                    <?php elseif( $heading_level == 'h5' ): ?>
                        <h5 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h5>
                    <?php elseif( $heading_level == 'h6' ): ?>
                        <h6 class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></h6>
                    <?php else : ?>
                        <div class="tabs__toggle" tabindex="0" role="button" aria-expanded="true" id="tab-<?php echo $row_count ?>"><?php echo esc_html( $title ); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endwhile; ?> 
        </div>         
        <div class="tabs-content container--purple">
            <?php while ( have_rows('tabs') ) : the_row();
                $title         = get_sub_field('title');
                $content = get_sub_field('content'); ?>
                <?php if ( $title ) : ?>
                    <button class="tabs__mobile__toggle" aria-expanded="false">
                        <?php echo esc_html( $title ); ?>
                        <span aria-hidden="true">
                            <span class="tabs__icon tabs__icon--inactive">
                                <?php echo svgstore('icon-accordion-open', 'Open', ''); ?>
                            </span>
                            <span class="tabs__icon tabs__icon--active">
                                <?php echo svgstore('icon-accordion-close', 'Close', ''); ?>
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
<?php endif; ?>



