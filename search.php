<?php


get_header(); 

global $wp_query;
if ( $paged > 0 ) {
	$result_range_start = ( ( $paged - 1 ) * 40 ) + 1;
	$result_range_end = ( $result_range_start + 39 );
	if ( $wp_query->found_posts > $result_range_end ) {
		$result_range = $result_range_start . ' - ' . $result_range_end; 
	} else {
		$result_range = $result_range_start . ' - ' . $wp_query->found_posts;
	}
} else {
	if ( $wp_query->found_posts > 40 ) {
		$result_range = '1 - 40';
	} else {
		$result_range = '1 - ' . $wp_query->found_posts;
	}
}

?>
<div id="content" class="search-list" role="main">
    <div class="hero">
		<div class="container container--purple">
	    <!-- REGION: Breadcrumb -->
	      	<nav class="breadcrumb" aria-label="Page Breadcrumb">
		<a href="https://www.albion.edu/">Home</a> — Search Results</nav>
	    <!-- /REGION: Breadcrumb -->
			<h1 class="hero__title">Search '<?php print htmlspecialchars( $_REQUEST['s'] ) ?>'</h1>
					</div>
	</div>
    <div class="container">
        <?php include( 'searchform.php' ); ?>
        <div class="quiet total-results">
            Found <strong><?php echo $wp_query->found_posts; ?></strong> total results. Showing results <strong><?php print $result_range; ?></strong>.
        </div>
        <div class="entries">
        <?php
        if ( have_posts() ) {
            $count = 1;
            while ( have_posts() ) : the_post();
                ?>
                <div class="entry <?php print $post->post_type ?>">
                    <div class="title"><strong><a href="<?php the_permalink() ?>"><?php relevanssi_the_title(); ?></a></strong></div>
                    <div class="excerpt"><?php 

                    // output the excerpt
                    relevanssi_the_excerpt();
                    
                    ?>
                    </div>
                </div>
                <?php
                $count++;
            endwhile;
            ?>
            <?php
        } else {
            print "<p>Sadly, your search returned no results. Please try another or navigate using the main menu.</p>";
        }

        ?>
        </div>
    </div>
</div><!-- #content -->
<div class="pagination">
    <?php paginate(); ?>
</div>
<?php 


get_footer();

