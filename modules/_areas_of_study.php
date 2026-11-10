<?php

$type = get_sub_field( 'type' );
$color = get_sub_field( 'color' );
$category = get_sub_field( 'area_category' );
$specific = get_sub_field( 'area_specific' );

$is_one_column = ( stristr( get_page_template(), 'one-column' ) ? true : false );
if ( $color != 'white' ): ?><div class="background--purple-grey"><?php endif;
if ( $is_one_column ): ?><div class="container-areas"><?php endif;

if ( ( $type == 'curated' && !empty( $specific ) ) || ( $type == 'filtered' && !empty( $category ) ) ) : 
    ?>
<div class="areas-container <?php print $color; ?>">
    <?php

    // set some query vars
    $vars = array( 
        "posts_per_page" => 200,
        "post_type" => 'area',
        "orderby" => 'title',
        "order" => 'ASC',
        "post_status" => 'publish',
    );

    if ( $type == 'curated' ) :
        $vars["post__in"] = $specific;
    else:
        $vars["tax_query"] = array(
            array (
                'taxonomy' => 'area-categories',
                'field' => 'id',
                'terms' => $category,
            )
        );
    endif;

    // run the query
    $p = new WP_Query( $vars );
    
    if ( $p->have_posts() ) : ?>
    <div class="area-filters">
        <div class="area-filter search">
            <label for="area-filter-search">Search</label>
            <input type="text" class="area-filter-search" placeholder="Search by Name">
        </div>
        <div class="area-filter category">
            <label for="area-filter-category">Category</label>
            <select class="area-filter-category">
                <option value="">All Areas</option>
                <?php
                $terms = get_terms( array(
                    'taxonomy' => 'area-categories',
                    'hide_empty' => true,
                ) );
                foreach ( $terms as $term ) {
                    printf( '<option value="%s">%s</option>', $term->slug, $term->name );
                }
                ?>
            </select>
        </div>
    </div>
    <div class="area-listing">

    <?php while ( $p->have_posts() ) : $p->the_post(); 
        $thumbnail = get_the_post_thumbnail_url();
        if ( empty( $thumbnail ) ) { $thumbnail = get_bloginfo( 'template_url') . '/img/placeholder-area.jpg'; } ?>
        <a href="<?php the_permalink(); ?>" class="visible">
        <div class="area-entry" style="background-image: url(<?php print $thumbnail; ?>);" data-category="<?php
            $terms = get_the_terms( get_the_ID(), 'area-categories' );
            print implode( ' ', wp_list_pluck( $terms, 'slug' ) );
        ?>" data-description="<?php print wp_strip_all_tags( get_the_excerpt(), true ); ?>">
            <div class="area-name"><?php the_title(); ?></div>
        </div>
        </a>
    <?php endwhile; ?>

    </div>
    
    <?php else: ?>
    <p>No areas found in database.</p>
    <?php endif; ?>

</div>
    <?php
endif;

wp_reset_postdata();

if ( $is_one_column ): ?></div><?php endif;
if ( $color != 'white' ): ?></div><?php endif;
