<?php

// get the mode
$mode = get_sub_field( 'mode' );
$search = get_sub_field( 'search' );

$meta_query = array(
    'relation' => 'AND',
    'name_first' => array(
        'key' => 'name_first',
        'compare' => 'EXISTS',
    ),
    'name_last' => array(
        'key' => 'name_last',
        'compare' => 'EXISTS',
    ), 
);

$orderby = array( 
    'name_last' => 'ASC',
    'name_first' => 'ASC',
);


// mode switch
if ( $mode == 'filtered' ) {

    // if we're filtering by a category
    $group = get_sub_field( 'group' );

    // set up query args
    $args = array(
        'post_type' => 'contact_card',
        'post_status' => 'publish',
        'posts_per_page' => 300,
        'meta_query' => $meta_query,
        'orderby' => $orderby,
        'tax_query' => array(
            array(
                'taxonomy' => 'group',
                'field'    => 'slug',
                'terms'    => $group->slug
            )
        )
    );

} else { 
    
    // otherwise, this is a curated list
    $cards = get_sub_field( 'cards' );
    
    // some empty variables before our custom loop
    $card_ids = array();
    $card_content = '';

    // loop through cards and build our own listing because
    foreach ( $cards as $card ) {
        $card_ids[] = $card->ID;
        $image = get_field( 'image', $card->ID );
        $heading = get_field( 'heading', $card->ID );
        $position_title = get_field( 'position_title', $card->ID );
        $do_link = get_field( 'link', $card->ID );

        $card_content .= '<div class="person-entry visible">
            ' . ( $do_link ? '<a href="/bio/' .  $card->post_name . '/">' : '' ) . '
            ' . wp_get_attachment_image( $image, 'quote' ) . '
            <div class="info">
                <h6>' . $heading . '</h6>
                <p class="person-title">' . $position_title . '</p>
            </div>
            ' . ( $do_link ? '</a>' : '' ) . '
        </div>';
    }
    
    // set up query args
    $args = array(
        'post_type' => 'contact_card',
        'post_status' => 'publish',
        'post__in' => $card_ids
    );

}

// set up the query
$card_query = new WP_Query( $args );

$is_one_column = ( stristr( get_page_template(), 'one-column' ) ? true : false );

/*
if ( $is_one_column ): ?><div class="background"><div class="container container--narrow"><?php endif;
*/
?>
<section class="people">
    <?php if ( $search ) : ?><div class="people-search"><input type="text" name="people-search-term" id="s" placeholder="Search Name, Academic Department, or Title"></div><?php endif; ?>
<?php

// loop through the contacts if we have them.
if ( $card_query->have_posts() ): ?>
    <div class="people-listing">
    <?php

    if ( $mode == 'filtered' ) {
        while ( $card_query->have_posts() ): $card_query->the_post();

            // get the fields
            $image = get_field( 'image' );
            $heading = get_field( 'heading' );
            $position_title = get_field( 'position_title' );
            $email = get_field( 'email' );

            $do_link = get_field( 'link' );
            ?>

            <div class="person-entry visible">
                <?php if ( $do_link ) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
                <?php print wp_get_attachment_image( $image, 'quote' ); ?>
                <div class="info">
                    <h6><?php print $heading; ?></h6>
                    <p class="person-title"><?php print $position_title; ?></p>
                    <!--<?php print ( !empty( $email ) ? '<p class="person-email"><a href="mailto:' . $email . '">Email Me</a></p>' : '' ); ?>-->
                </div>
                <?php if ( $do_link ) {?></a><?php } ?>
            </div>
            <?php
        endwhile;
    } else {
        print $card_content;
    }
    ?>
    </div>
    <?php
endif;

?>
</section>

<?php
/*
if ( $is_one_column ): ?></div></div><?php endif;
*/

wp_reset_postdata();
