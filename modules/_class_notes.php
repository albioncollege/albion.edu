<?php

$current_yr = ( isset( $_REQUEST['y'] ) ? $_REQUEST['y'] : 0 );
$current_cat = ( isset( $_REQUEST['c'] ) ? $_REQUEST['c'] : 0 );
$current_search = ( isset( $_REQUEST['t'] ) ? $_REQUEST['t'] : '' );


$meta_query = array();

// if they've set a year
if ( $current_yr != 0 ) {
    $meta_query[] = array(
		'key'   => '_p_alum_year', 
		'value' => $current_yr,
	);
}

// if they've chosen a category
if ( $current_cat ) {
    $args['tax_query'] = array( array(
		'taxonomy' => 'note_category', 
		'terms' => $current_cat,
		'field' => 'slug',
		'include_children' => true,
        'operator' => 'IN'
	) );
}

// get all the categories
$terms = get_terms([
    'taxonomy' => 'note_category',
    'hide_empty' => false,
]);

// if they've searched by name
if ( $current_search != '' ) {
    $meta_query[] = array(
		'relation' => 'OR',
		array(
			'key'   => '_p_alum_name_first', 
			'value' => $current_search,
			'compare' => 'LIKE'
		),
		array(
			'key'   => '_p_alum_name_last', 
			'value' => $current_search,
			'compare' => 'LIKE'
		),
		array(
			'key'   => '_p_alum_name_maiden', 
			'value' => $current_search,
			'compare' => 'LIKE'
		)
	);
}

if ( !empty( $meta_query ) ) {

	array_unshift( $meta_query, array( 
		'relation' => 'AND',
	) );
    
    $args["meta_query"] = $meta_query;
}

// get the page number
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args['paged'] = $paged;

// set main args
$args["post_type"] = 'note';
$args["post_status"] = 'publish';
$args["orderby"] = 'modified';
$args["order"] = 'DESC';
$args["posts_per_page"] = 20;

$alum_query = new WP_Query( $args );

?>

	<section class="alumni-container">

		<div class="alumni-inner">
			
			<div class="alum-info">
				<div class="class-header">
					<div class="class-header-column">
						<?php print ( $current_yr != 0 ? '<h2 class="page-title alum-title"><span class="class-title"> &raquo; Class of ' . $current_yr : '</span></h2>' ); ?>
					</div>
					<div class="class-header-column">
						<div class="alum-buttons">
							<?php if ( !empty( $meta_query ) ) { ?><button class="alum-reset">Reset Search</button><?php } ?>
						</div>
					</div>
				</div>
				<?php if ( !empty( $current_yr ) ) { ?>
				<div class="class-information group">
					<div class="column">
						<?php if ( !empty( $year_info['president'] ) ) { ?><p><strong>President:</strong><br><?php print $year_info['president'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['grad_date'] ) ) { ?><p><strong>Graduation Date:</strong><br><?php print $year_info['grad_date'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['commencement_theme'] ) ) { ?><p><strong>Commencement Theme:</strong><br><?php print $year_info['commencement_theme'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['commencement_speakers'] ) ) { ?><p><strong>Commencement Speakers:</strong><br><?php print $year_info['commencement_speakers'] ?></p><?php } ?>
					</div>
					<div class="column">
						<!--<span class="year-more-details">-->
						<?php if ( !empty( $year_info['grad_seniors'] ) ) { ?><p><strong>Graduating Seniors:</strong><br><?php print $year_info['grad_seniors'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['honorary_degrees'] ) ) { ?><p><strong>Honorary Degrees:</strong><br><?php print $year_info['honorary_degrees'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['medal'] ) ) { ?><p><strong>Medals of Merit:</strong><br><?php print $year_info['medal'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['agent_current_name'] ) ) { ?>
						<p><strong>Current Class Agent(s):</strong><br>
						<?php if ( !empty( $year_info['agent_current_email'] ) ) { ?><a href="mailto:<?php print $year_info['agent_current_email'] ?>"><?php } ?><?php print $year_info['agent_current_name'] ?><?php if ( !empty( $year_info['agent_current_email'] ) ) { ?></a><?php } ?><?php if ( !empty( $year_info['agent_current_name_2'] ) ) { ?><?php if ( !empty( $year_info['agent_current_email_2'] ) ) { ?>, <a href="mailto:<?php print $year_info['agent_current_email_2'] ?>"><?php } ?><?php print $year_info['agent_current_name_2'] ?><?php if ( !empty( $year_info['agent_current_email_2'] ) ) { ?></a><?php } ?><?php if ( !empty( $year_info['agent_current_email_3'] ) ) { ?>, <a href="mailto:<?php print $year_info['agent_current_email_3'] ?>"><?php } ?><?php print $year_info['agent_current_name_3'] ?><?php if ( !empty( $year_info['agent_current_email_3'] ) ) { ?></a><?php } ?><?php if ( !empty( $year_info['agent_current_email_4'] ) ) { ?>, <a href="mailto:<?php print $year_info['agent_current_email_4'] ?>"><?php } ?><?php print $year_info['agent_current_name_4'] ?><?php if ( !empty( $year_info['agent_current_email_4'] ) ) { ?></a><?php } ?>
						</p><?php } ?><?php } ?>
					</div>
					<div class="column year-buttons">
						<?php if ( !empty( $year_info['photo'] ) ) { print '<img src="' . $year_info['photo'] . '" class="class-photo" />'; } ?>
						<!--<?php 
						if ( !empty( $year_info['memories'] ) ) { 
							$memories_output = implode(' | ', array_map(
							    function ( $v, $k ) { return "<a href='" . $v . "'>" . $k . "th</a>"; },
							    $year_info['memories'],
							    array_keys( $year_info['memories'] )
							));
							?><p><strong>Memory Books (by Reunion):</strong><br><?php print $memories_output ?></p><?php } ?>-->
						<?php if ( !empty( $year_info['has_memory'] ) ) { ?><div class="class-memory-book"><a href="mailto:alumni@ripon.edu">Request Memory Book<span>email alumni@ripon.edu</span></a></div><?php } ?>
						<?php if ( !empty( $year_info['has_green'] ) ) { ?><div class="class-green-list"><a href="mailto:alumni@ripon.edu">Request Green List<span>email alumni@ripon.edu</span></a></div><?php } ?>
						<?php if ( !empty( $year_info['photo_reunion'] ) ) { ?><div class="reunion-photo"><a href="<?php print $year_info['photo_reunion']; ?>" class="lightbox-photo">Reunion Photo</a></div><?php } ?>
						<?php if ( !empty( $year_info['facebook'] ) ) { ?><div class="class-facebook"><a href="<?php print $year_info['facebook']; ?>"><img src="<?php bloginfo( 'template_url' ) ?>/img/social-facebook.png"><span>Facebook</span></a></div><?php } ?>
					</div>
				</div>
				<?php } ?>
				<div class="alum-filter">
					<form name="alum-filters" action="<?php print $_SERVER['REQUEST_URI']; ?>" method="get">
						<select name="y" class="alum-year">
							<option value="0">All Years</option>
							<?php
							$yr = 1944;
							$yr_now = date( 'Y' );
							while ( $yr < $yr_now ) {
								print "<option value='" . $yr . "'" . ( $yr == $current_yr ? ' selected="selected"' : '' ) . ">" . $yr . "</option>";
								$yr++;
							}
							?>
						</select>
						<select name="c" class="alum-category">
							<option value="0">All Categories</option>
							<?php
							foreach ( $terms as $term ) {
								print $current_cat;
								print $term->slug
								?><option value='<?php print $term->slug ?>'<?php print ( $current_cat === $term->slug ? ' selected="selected"' : '' ); ?>><?php print $term->name ?></option><?php
							}
							?>
							
						</select>
						<input type="text" name="t" class="alum-search" placeholder="Search" value="<?php print $current_search; ?>" />
						<input type="submit" value="Filter" />
					</form>
				</div>
			</div>

			<?php 

			if ( $alum_query->have_posts() ) : 
				?>

			<div class="alum-listing">
			<?php

				// Start the Loop.
				while ( $alum_query->have_posts() ) : $alum_query->the_post(); 
					?>
				<div class="alum">
					<div class="photo">
						<a href="#alum-<?php the_ID(); ?>" class="open-alum-link">
							<?php the_post_thumbnail( 'thumbnail' );?>
						</a>
					</div>
					<div class="info group">
						<h5><?php the_title(); ?></h5>
						<?php if ( get_field( '_p_alum_submitter' ) ) { ?><div class="quiet">Submitted by: <?php the_field( '_p_alum_submitter' ) ?></div><?php } ?>
						<?php if ( get_field( '_p_alum_year' ) > 0 ) { ?><div class="alum-year"><?php the_field( '_p_alum_year' ) ?></div><?php } ?>
						<div class="alum-location"><?php the_field( '_p_alum_city' ); ?>, <?php the_field( '_p_alum_state' ) ?></div>
					</div>
					<div class="alum-details mfp-hide" id="alum-<?php the_ID(); ?>">
						<h3><?php the_title(); ?></h3>
						<div class="details">
							<div class="details-photo">
								<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail();
								}
								?>
							</div>
							<h5><?php the_field( '_p_alum_name_first' ); ?> <?php the_field( '_p_alum_name_last' ) ?></h5>
							<div class="alum-year"><strong>Class of <?php the_field( '_p_alum_year' ) ?></strong></div>
							<div class="alum-location"><?php the_field( '_p_alum_city' ); ?>, <?php the_field( '_p_alum_state' ) ?></div>
							<div class="alum-category alum-category-<?php the_field( '_p_alum_category' ) ?>"><?php print ucwords( str_replace( '-', ' ', get_field( '_p_alum_category' ) ) ); ?></div>
							<div class="details-content">
								<p><?php the_content(); ?></p>
								<?php if ( get_field( '_p_alum_submitter' ) ) { ?><p class="quiet">Submitted by: <?php the_field( '_p_alum_submitter' ) ?></p><?php } ?>
							</div>
						</div>
					</div>
				</div>
					<?php

				endwhile;
                ?>
                </div>
                <div class="pagination">
                    <?php paginate_links(); ?>
                </div>

            <?php else : ?>
				<p>No results for that criteria. Try selecting fewer filters or changing your search term.</p>
				<?php

			endif;
			?>

		</div>

	</section><!-- #primary -->

<?php wp_reset_query(); ?>