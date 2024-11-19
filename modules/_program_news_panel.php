<?php
/**
 * News Panel Module
 * 
 * Module partial used to display a selected number of featured news by category or curated.
 *
 */

$subheading                 = get_field( 'subheading' );
$subheading                 = ( empty( $subheading ) ? 'Related Posts' : $subheading );

$subheading_level           = get_field( 'subheading_level' );
$background_color           = get_field('background_color');
$bg_color_class             = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$routing_link               = get_field( 'routing_link' );
$display_type               = get_field('display_type');
$number_of_posts_to_display = get_field('number_of_posts_to_display') ? get_field('number_of_posts_to_display') : 3; 


if ($display_type == 'filtered') {
    $terms = get_field('category');

    if ( $terms ) {
        $news = get_posts([
            'post_type'      => 'post',
            'posts_per_page' => $number_of_posts_to_display,
            'tax_query'      => array(
                array(
                  'taxonomy' => 'category',
                  'field'    => 'term_id',
                  'terms'    => $terms,
                ),
              ),
        ]);
    } else {
        $news = get_posts([
            'post_type'      => 'post',
            'posts_per_page' => $number_of_posts_to_display
        ]);
    }
} else {
    $news = get_field( 'news_posts' );
}

if ( $news ) : ?>                 
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="container container--narrow">
            <div class="news__heading">
                <?php if( $subheading ) : ?>
                    <?php if( $subheading_level == 'h2' ) : ?>
                        <h2 class="h3"><?php echo esc_html( $subheading ); ?></h2>
                    <?php elseif( $subheading_level == 'h3' ) : ?>
                        <h3><?php echo esc_html( $subheading ); ?></h3>
                    <?php elseif( $subheading_level == 'h4' ) : ?>
                        <h4 class="h3"><?php echo esc_html( $subheading ); ?></h4>
                    <?php elseif( $subheading_level == 'h5' ) : ?>
                        <h5 class="h3"><?php echo esc_html( $subheading ); ?></h5>
                    <?php elseif( $subheading_level == 'h6' ) : ?>
                        <h6 class="h3"><?php echo esc_html( $subheading ); ?></h6>
                    <?php else : ?>
                        <div class="h3"><?php echo esc_html( $subheading ); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( $routing_link ) : 
                    $link_url    = $routing_link['url'];
                    $link_title  = $routing_link['title'];
                    if ( $link_title ) : ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="button__link" <?php echo link_target( $routing_link ); ?>><?php echo esc_html( $link_title ); ?></a>                
                    <?php endif; //link_title ?>
                <?php endif; //routing_link ?>
            </div>

            <div class="news__wrapper">
                <?php foreach( $news as $post ) : ?>
                    <?php setup_postdata( $post ); ?>
                    <?php $external_link = get_field( "external_link", get_the_id()); ?>
                    <div class="news__block">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="news__image" style="background-image: url('<?php the_post_thumbnail_url( 'news' ); ?>' );"></div>
                        <?php endif; ?>
                        <div class="news__content">
                            <div class="news__link">
                                <a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    </div> 
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>