<?php
/**
 * Feature Grid Module v2.0
 * 
 * Module partial used to display a grid of feature cards.
 *
 */

$background_color = get_sub_field('background_color');
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$intro_text       = get_sub_field( 'intro_text' );
$heading_class    = (is_page_template( 'page--home.php' )) ? 'large-headline' : 'h3';
$columns          = get_sub_field( 'columns' );

if( have_rows('cards') ) : ?>
    <div class="feature__component grid_v2">
        <div class="background<?php echo esc_attr( $bg_color_class ); ?>">  
            <div class="container container--narrow">
                <?php if( $subheading ) : ?>
                    <<?= $subheading_level ?> class="<?= $heading_class; ?>"><?= esc_html( $subheading ); ?></<?= $subheading_level ?>>
                <?php endif; ?>
                <?php if ( $intro_text ) : ?>
                    <?= wp_kses_post( $intro_text ); ?>
                <?php endif; ?>
                <div class="grid-container columns__<?= $columns ?>">
                    <?php while( have_rows('cards') ) : the_row();
                        $card_subheading        = get_sub_field( 'subheading' );
                        $card_subheading_level  = get_sub_field( 'subheading_level' );
                        $card_subheading_link   = get_sub_field( 'subheading_link' );
                        $card_background_image  = get_sub_field( 'background_image' );
						$card_background_color  = get_sub_field( 'background_color' );
                        $card_blurb             = get_sub_field( 'blurb' );
						$card_button_link       = get_sub_field( 'button_link' );
						$card_style = '';
						$card_class = 'grid__card';
						$color = strtolower( $card_background_color );
							if ( $card_background_image ) {
								$url = wp_get_attachment_image_url( $card_background_image, 'large' );
								if ( $url ) {
									$card_style = 'background-image: url(' . esc_url( $url ) . ');';
								}
							} elseif ( $card_background_color ) {
								$color = strtolower( $card_background_color );
								if ( $color === '#4b306a' ) {
									$card_class .= ' background--purple container--purple';
								} elseif ( $color === '#edeaf0' ) {
									$card_class .= ' background--purple-gray container--purple-gray';
								} elseif ( $color === '#ffc845' ) {
									$card_class .= ' background--gold container--gold';
								} else {
									$card_style = 'background-color: ' . esc_attr( $card_background_color ) . ';';
								}
							}
						?>
                        <?php if ( $card_subheading ) : ?>
                            <div class="<?= $card_class ?>" style="<?= $card_style ?>">
                                <?php if ( $card_subheading_link ) { echo '<a href="'.$card_subheading_link.'">'; } ?>
                                <<?= $card_subheading_level ?> class="<?= $card_subheading_level ?>"><span><?= esc_html( $card_subheading ); ?></span></<?= $card_subheading_level ?>>
                                <?php if ( $card_subheading_link ) { echo '</a>'; } ?>
								<?php if ( $card_blurb ) : ?>
									<div class="blurb"><?php echo wp_kses_post( $card_blurb ); ?></div>
								<?php endif; ?>
								<div>
									<?php if ( $card_button_link ) : ?>
										<a href="<?php echo esc_url( $card_button_link['url'] ); ?>" class="button" <?php echo link_target( $card_button_link ); ?>>
											<?php echo esc_html( $card_button_link['title'] ); ?>
										</a>
									<?php endif; ?>
								</div>
                            </div>
						<?php endif; ?>
                    <?php endwhile; //cards ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>