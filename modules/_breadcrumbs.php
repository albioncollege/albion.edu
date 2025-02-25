<?php if ( get_post_type() == 'contact_card' ) : ?>
	<nav class="breadcrumb" aria-label="Page Breadcrumb">
		<span><span><a href="/">Home</a></span> &mdash; <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span></span>
	</nav>
<?php else : ?>
	<nav class="breadcrumb" aria-label="Page Breadcrumb">
		<?php do_page_breadcrumbs(); ?>
	</nav>
<?php endif; ?>