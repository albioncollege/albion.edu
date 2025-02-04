<?php 
if ( get_post_type() == 'contact_card' ) : 
	print $_SESSION['contactListing'];
?>
	<nav class="breadcrumb" aria-label="Page Breadcrumb">
		<span><span><a href="https://albion.jpederson.io/">Home</a></span> ― <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span>
	</nav>
<?php 
elseif (!get_field('hide_breadcrumbs')) : 
?>
	<nav class="breadcrumb" aria-label="Page Breadcrumb">
		<?php yoast_breadcrumb(); ?>
	</nav>
<?php 
endif; 
?>