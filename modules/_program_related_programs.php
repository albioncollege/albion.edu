<?php
/**
 * Program Template Module: Related Programs
 * 
 * Module partial used to display the related programs.
 *
 */

$related_programs_background_color = get_field('related_programs_background_color');
$bg_color_class                    = ( $related_programs_background_color == 'gray' ) ? ' background--purple-gray' : '';
$related_programs_panel_link       = get_field('related_programs_panel_link');

if( have_rows('related_programs') ): ?>

    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="container container--narrow">
            <div class="panel__headline__wrapper">
                <div class="grid grid--70-30">
                    <div class="panel__headline__details">
                        <h3><?php esc_html_e( 'Related Programs', 'albion' ); ?></h3>
                    </div>
                    <?php if ( $related_programs_panel_link ) : ?>
                        <div class="panel__headline__right">
                            <a href="<?php echo esc_url( $related_programs_panel_link['url'] ); ?>" class="button"><?php echo esc_html( $related_programs_panel_link['title'] ); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="grid grid--33-33-33">
                    <?php while( have_rows('related_programs') ) : the_row();
                        $programs = get_sub_field('program');
                        if( $programs ): 
                            $program_title = $programs->post_title;
                            $permalink     = get_the_permalink( $programs ); 
                            $program_image = get_field('image', $programs->ID);
                            ?>
                            <div>
                                <?php if( $program_image ) : ?>
                                    <?php echo wp_get_attachment_image( $program_image, 'programs' ); ?>
                                <?php endif; ?>
                                <p>
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="button__link"><?php echo esc_html( $program_title ); ?></a>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
