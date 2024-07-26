<?php
/**
 * Infographics Module
 * 
 * Module partial used to display infographics.
 *
 */

$subheading       = get_sub_field('subheading');
$subheading_level = get_sub_field('subheading_level');
$infographics     = get_sub_field('infographics');
$intro_text       = get_sub_field('intro_text');


if( have_rows('infographics') ) : 
    $row_count = count( $infographics );
    $row_index = 1;
?>
    <div class="infographic__component">
        <div class="background background--purple-pattern">
            <div class="container container--purple container--narrow">
                <?php if( $subheading ): ?>
                    <?php if( $subheading_level == 'h2' ): ?>
                        <h2><?php echo esc_html( $subheading ); ?></h2>
                    <?php elseif( $subheading_level == 'h3' ): ?>
                        <h3 class="h2"><?php echo esc_html( $subheading ); ?></h3>
                    <?php elseif( $subheading_level == 'h4' ): ?>
                        <h4 class="h2"><?php echo esc_html( $subheading ); ?></h4>
                    <?php elseif( $subheading_level == 'h5' ): ?>
                        <h5 class="h2"><?php echo esc_html( $subheading ); ?></h5>
                    <?php elseif( $subheading_level == 'h6' ): ?>
                        <h6 class="h2"><?php echo esc_html( $subheading ); ?></h6>
                    <?php else : ?>
                        <div class="h2"><?php echo esc_html( $subheading ); ?></div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php echo wp_kses_post( $intro_text ) ; ?>

                <div class="infographic__column-wrapper">
                    <div class="grid--33-33-33 infographic__columns">
                        <?php while( have_rows('infographics') ) : the_row(); 
                            $big_text     = get_sub_field('big_text');
                            $medium_text  = get_sub_field('medium_text');
                            $regular_text = get_sub_field('regular_text');
                        ?>
                            <div class="infographic__column">
                                <?php if ( $big_text || '0' === $big_text) : ?>
                                    <h3 class="title"><?php echo esc_html( $big_text ); ?></h3>
                                <?php endif; ?>
                                <div class="infographic__body">
                                    <?php if ( $medium_text || '0' === $medium_text ) : ?>
                                        <div class="text-large text-gold"><?php echo esc_html( $medium_text ); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if ( $regular_text || '0' === $regular_text ) : ?>
                                    <p class="text-small"><?php echo esc_html( $regular_text ); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ( $row_index < $row_count ) : ?>
                                <div class="infographic__divider">
                                    <div class="infographic__divider--line"></div>
                                </div>
                            <?php endif; ?>
                            <?php $row_index++; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>