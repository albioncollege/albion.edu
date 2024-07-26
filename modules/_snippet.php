<?php 
/**
 * Snippet Module
 * 
 * Module partial used to display snippet custom post type.
 *
 */

$snippets = get_sub_field( 'snippet' );

if( $snippets ): 
    $snippet = get_field( 'content', $snippets->ID ); ?>
    <section class="snippet">
        <?php if ( $snippet ) : ?>
            <?php echo $snippet; ?>
        <?php endif; ?>
    </section>
<?php endif; ?>
 