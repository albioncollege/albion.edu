<?php
/**
 * Dashboard Panel Module
 * 
 * Module partial used to display an admissions dashboard panel.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
?>
<div class="background background--purple">
    <div class="container">
        <div class="journey__wrapper">
            <?php if( $subheading ) : ?>
                <?php if( $subheading_level == 'h2' ) : ?>
                    <h2 class="journey__heading"><?php echo esc_html( $subheading ); ?></h2>
                <?php elseif( $subheading_level == 'h3' ) : ?>
                    <h3 class="journey__heading"><?php echo esc_html( $subheading ); ?></h3>
                <?php elseif( $subheading_level == 'h4' ) : ?>
                    <h4 class="journey__heading"><?php echo esc_html( $subheading ); ?></h4>
                <?php elseif( $subheading_level == 'h5' ) : ?>
                    <h5 class="journey__heading"><?php echo esc_html( $subheading ); ?></h5>
                <?php elseif( $subheading_level == 'h6' ) : ?>
                    <h6 class="journey__heading"><?php echo esc_html( $subheading ); ?></h6>
                <?php else : ?>
                    <div class="journey__heading"><?php echo esc_html( $subheading ); ?></div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( have_rows( 'primary_block' ) || have_rows( 'secondary_blocks' ) ) : ?>
                <div class="journey__grid">
                    <?php if( have_rows( 'primary_block' ) ) : ?>
                        <div>
                            <?php while( have_rows( 'primary_block' ) ) : the_row();
                                $month       = get_sub_field( 'month' );
                                $day         = get_sub_field( 'day' );
                                $image       = get_sub_field( 'image' );
                                $subheading  = get_sub_field( 'subheading' );
                                $text        = get_sub_field( 'text' );
                                $link        = get_sub_field( 'link' ); ?>
                                <div class="journey__main">
                                    <?php if( $image ) : 
                                        $image_url     = wp_get_attachment_url( $image );
                                        $image_style   = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"'; ?>
                                        <div class="journey__main__photo" <?php echo ( $image_style ); ?>>
                                    <?php endif; ?>
                                            <?php if( $month && $day ) : ?>
                                                <div class="journey__main__date">
                                                    <div><?php echo esc_html( $month ); ?></div>
                                                    <div><?php echo esc_html( $day ); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php if( $subheading || $text || $link ) : ?>
                                        <div class="journey__main__content">
                                            <?php if ( $subheading ) : ?>
                                                <h4><?php echo esc_html( $subheading ); ?></h4>
                                            <?php endif; ?>
                                            <?php if ( $text ) : ?>
                                                <?php echo wp_kses_post( $text ); ?>
                                            <?php endif; ?>
                                            <?php if ( $link ) :  
                                                $link_url    = $link['url'];
                                                $link_title  = $link['title']; ?>
                                                <a href="<?php echo esc_url( $link_url ); ?>" class="button"><?php echo esc_html( $link_title ); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; //primary_block ?>
                        </div>
                    <?php endif; //primary_block ?>

                    <?php if( have_rows( 'secondary_blocks' ) ) : ?>
                        <div>
                            <?php while( have_rows( 'secondary_blocks' ) ) : the_row();
                                $image           = get_sub_field( 'image' );
                                $image_position  = get_sub_field( 'image_position' );
                                $eyebrow         = get_sub_field( 'eyebrow' );
                                $link            = get_sub_field( 'link' ); ?>
                                <div class="journey__item">
                                    <div class="journey__item__content">
                                        <?php if( $eyebrow ) : ?>
                                            <div class="journey__item__date">
                                                <?php echo esc_html( $eyebrow ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( $link ) :
                                            $link_url        = $link['url'];
                                            $link_title      = $link['title']; ?>                                       
                                            <div class="journey__item__link">
                                                <a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_html( $link_title ); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if( $image ) : 
                                        $image_url     = wp_get_attachment_url( $image );
                                        $image_style   = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"'; ?>
                                        <div class="journey__item__photo" <?php echo ( $image_style ); ?>></div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; //secondary_blocks ?>
                        </div>
                    <?php endif; //secondary_block ?>
                </div>
            <?php endif; //primary or secondary conditional ?>
        </div>
    </div>
</div>