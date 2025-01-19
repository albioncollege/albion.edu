<?php
/*
Template Name: Home
Template Post Type: page
*/

get_header(); 

?>
<main class="page" id="main-content">

<?php
if ( !get_field( 'modules_only' ) ) :

    $hero_image       = get_field( 'hero_image' );
    $background_video = get_field( 'background_video' );
    $heading          = get_field ( 'heading' );
    $subheading       = get_field ( 'subheading' );
    if( $hero_image ) : 
        $image_url   = wp_get_attachment_url( $hero_image );
        $image_style = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"'; 
    ?>
        <div class="splash" <?php echo $image_style; ?>>
            <?php if ( $background_video ) : ?>
                <button class="splash__control" aria-label="Toggle Video">
                </button>
                <div class="splash__video">
                    <video muted="" loop="" autoplay="" playsinline="">
                        <source src="<?php echo esc_url( $background_video['url'] ); ?>" type="<?php echo esc_attr( $background_video['mime_type'] ); ?>" />
                    </video>
                </div>
            <?php endif; ?>
            <?php if ( $heading ) : ?>
                <div class="splash__content">
                    <h1 class="splash__content__headlines">
                        <?php echo esc_html( $heading ); ?>
                        <?php if ( $subheading ) : ?>
                            <span><?php echo esc_html( $subheading ); ?></span>
                        <?php endif; ?>
                    </h1>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php
    $intro_subheading       = get_field ( 'intro_subheading' );
    $intro_subheading_level = get_field ( 'intro_subheading_level' );
    $intro_subheading_link  = get_field ( 'intro_subheading_link' );
    $intro_image            = get_field ( 'intro_image' );
    $intro_image_size       = 'callout';
    $intro_text             = get_field ( 'intro_text' );
    $intro_links            = get_field ( 'links' ); 

    if ( $intro_subheading || $intro_text ) : ?>
        <div class="callout__component">
            <div class="background background--purple-pattern">
                <div class="callout__container container--purple">
                    <div class="callout__content">
                        <?php if ( $intro_subheading ) : ?>
                            <?php if ( $intro_subheading_link ) : ?>
                                <a href="<?php echo esc_url( $intro_subheading_link ); ?>">
                            <?php endif; ?>
                            <?php if ($intro_subheading_level == 'h2' ): ?>
                                <h2 class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></h2>
                            <?php elseif( $intro_subheading_level == 'h3' ): ?>
                                <h3 class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></h3>
                            <?php elseif( $intro_subheading_level == 'h4' ): ?>
                                <h4 class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></h4>
                            <?php elseif( $intro_subheading_level == 'h5' ): ?>
                                <h5 class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></h5>
                            <?php elseif( $intro_subheading_level == 'h6' ): ?>
                                <h6 class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></h6>
                            <?php else : ?>
                                <div class="callout__headline"><?php echo esc_html( $intro_subheading ); ?></div>
                            <?php endif; ?>
                            <?php if ( $intro_subheading_link ) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $intro_subheading ) : ?>
                            <p class="callout__paragraph"><?php echo wp_kses_post( strip( $intro_text ) ); ?></p>
                        <?php endif; ?>
                        <?php if ( $intro_links ) : ?>
                            <div class="button-group">
                            <?php foreach( $intro_links as $link ) :
                                $intro_link = $link['link'];
                                if ( $intro_link ) : ?>
                                    <a href="<?php echo esc_url( $intro_link['url'] ); ?>" class="button" <?php echo link_target( $intro_link ); ?>><?php echo esc_html( $intro_link['title'] ); ?></a>
                                <?php endif; //$intro_link ?>
                            <?php endforeach;?>
                            </div>
                        <?php endif; //$intro_links ?>
                        
                    </div>
                    <?php if( $intro_image ) : ?>
                        <div class="callout__media">
                            <?php echo wp_get_attachment_image( $intro_image, $intro_image_size ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php while (have_rows('modules')) : the_row(); ?>
            <?php $layout = get_row_layout(); ?>
            <?php if (in_array($layout, ['horizontal_rule'], true )) : ?>
                <div class="container">
                    <?php get_template_part('modules/_' . get_row_layout()); ?>
                </div>
            <?php else: ?>
                <?php get_template_part('modules/_' . get_row_layout()); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endwhile; endif; wp_reset_postdata(); ?>
</main>
<?php get_footer(); ?>