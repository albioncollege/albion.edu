<?php

// get the mode
$mode = get_sub_field( 'mode' );
$search = get_sub_field( 'search' );

// mode switch
if ( $mode == 'filtered' ) {

    // if we're filtering by a category
    $group = get_sub_field( 'group' );

    // set up query args
    $args = array(
        'post_type' => 'contact_card',
        'post_status' => 'publish',
        'posts_per_page' => 300,
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
    
    // set up query args
    $args = array(
        'post_type' => 'contact_card',
        'post_status' => 'publish',
        'post__in' => $cards
    );

}

// set up the query
$card_query = new WP_Query( $args );

$is_one_column = ( stristr( get_page_template(), 'one-column' ) ? true : false );

if ( $is_one_column ): ?><div class="background"><div class="container container--narrow"><?php endif;

?>
<section class="people">
    <?php if ( $search ) : ?><div class="people-search"><input type="text" name="people-search-term" id="s" placeholder="Search Name, Academic Department, or Title"></div><?php endif; ?>
<?php

// loop through the contacts if we have them.
if ( $card_query->have_posts() ): ?>
    <div class="people-listing">
    <?php
	while ( $card_query->have_posts() ): $card_query->the_post();

        // get the fields
        $image = get_field( 'image' );
        $heading = get_field( 'heading' );
        $position_title = get_field( 'position_title' );
        $email = get_field( 'email' );
        ?>

        <div class="person-entry visible">
            <?php print wp_get_attachment_image( $image, 'quote' ); ?>
            <div class="info">
                <h6><?php print $heading; ?></h6>
                <p class="person-title"><?php print $position_title; ?></p>
                <?php print ( !empty( $email ) ? '<p class="person-email"><a href="mailto:' . $email . '">Email Me</a></p>' : '' ); ?>
            </div>
        </div>
        <?php
    endwhile;
    ?>
    </div>
    <?php
endif;

?>
</section>

<?php
if ( $is_one_column ): ?></div></div><?php endif;

wp_reset_postdata();
