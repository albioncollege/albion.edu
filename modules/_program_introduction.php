<?php
/**
 * Program Template Module: Introduction
 * 
 * Module partial used to display introduction for the program.
 *
 */

$intro        = get_field( 'introduction' );
$routing_link = get_field( 'routing_link' );
?>
<div class="hero hero--program">
    <div class="hero__container container--purple">
        <!-- REGION: Breadcrumb -->
        <?php get_template_part('modules/_breadcrumbs'); ?>
        <!-- /REGION: Breadcrumb -->
        <h1 class="hero__title"><?php the_title(); ?></h1>
        <?php if ( $routing_link ) : ?>
            <div class="hero__link">
                <a href="<?php echo esc_url( $routing_link['url'] ); ?>" class="button__link"><?php echo esc_html( $routing_link['title'] ); ?></a>
            </div>
        <?php endif; ?>
        <?php if ( $intro ) : ?>
            <p><?php echo esc_html( $intro ); ?></p>
        <?php endif; ?>
    </div>
</div>