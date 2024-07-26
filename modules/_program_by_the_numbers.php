<?php
/**
 * Program Template Module: By the Numbers
 * 
 * Module partial used to display the program infographic section "by the numbers".
 *
 */

$numbers_h2         = get_field( 'numbers_h2' );
$numbers_intro_text = get_field( 'numbers_intro_text' );
$infographics       = get_field( 'infographics' );

if( have_rows('infographics') ) : 
    $row_count = count( $infographics );
    $row_index = 1;
?>
    <div class="infographic__component">
        <div class="background background--purple-pattern">
            <div class="container container--purple container--narrow">
                <?php if ( $numbers_h2 ) : ?>
                    <h2><?php echo esc_html( $numbers_h2 ); ?></h2>
                <?php endif; ?>
                <?php if ( $numbers_intro_text ) : ?>
                    <?php echo wp_kses_post( $numbers_intro_text ); ?>
                <?php endif; ?>
                
                <div class="infographic__column-wrapper">
                    <div class="grid--33-33-33 infographic__columns">
                        <?php while( have_rows('infographics') ) : the_row();
                            $big_text     = get_sub_field('big_text');
                            $medium_text  = get_sub_field('medium_text');
                            $regular_text = get_sub_field('regular_text');
                        ?>
                            <div class="infographic__column">
                                <?php if ( $big_text ) : ?>
                                    <h3 class="title"><?php echo esc_html( $big_text ); ?></h3>
                                <?php endif; ?>
                                <div class="infographic__body">
                                    <?php if ( $medium_text ) : ?>
                                        <div class="text-large text-gold"><?php echo esc_html( $medium_text ); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if ( $regular_text ) : ?>
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