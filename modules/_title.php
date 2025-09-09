<?php

$title = get_sub_field( 'title' );
$breadcrumbs = get_sub_field( 'show_breadcrumbs' );

?>

    <div class="hero">
		<div class="hero__container container--purple">
	    <!-- REGION: Breadcrumb -->
	      <?php if ( $breadcrumbs ) get_template_part('modules/_breadcrumbs'); ?>
	    <!-- /REGION: Breadcrumb -->
			<h1 class="hero__title"><?php print $title; ?></h1>
		</div>
	</div>
