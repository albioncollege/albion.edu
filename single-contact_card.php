<?php 


// add a the one-column class to the body tag.
function add_one_col_class($classes) {
    $classes[] = 'page-template-page--one-column';
    return $classes;
}

add_filter('body_class', 'add_one_col_class');

get_header(); 

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$title_primary = get_field( 'position_title' );
		$title_secondary = get_field( 'secondary_title' );
		$office = get_field( 'office' );
		$email = get_field( 'email' );
		$phone = get_field( 'phone' );
		$fax = get_field( 'fax' );
		$blurb = get_field( 'blurb' );
		$education = get_field( 'education' );
		$courses = get_field( 'courses' );
		$areas_of_interest = get_field( 'areas_of_interest' );
?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
	    <!-- REGION: Breadcrumb -->
	      <?php get_template_part('modules/_breadcrumbs'); ?>
	    <!-- /REGION: Breadcrumb -->
			<h1 class="hero__title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="main">
		<div class="main__inner">
			<div id="sidebar" class="sidebar sidebar--header">
				<?php print wp_get_attachment_image( get_field( 'image' ), 'full' ); ?>
				<div class="contact-items">
					<?php if ( !empty( $office ) ) { ?><p class="contact-item"><strong>Office:</strong><br> <?php print $office ?></p><?php } ?>
					<?php if ( !empty( $email ) ) { ?><p class="contact-item"><strong>Email:</strong><br> <a href="mailto:<?php print $email ?>"><?php print $email ?></a></p><?php } ?>
					<?php if ( !empty( $phone ) ) { ?><p class="contact-item"><strong>Phone:</strong><br> <a href="tel:<?php print preg_replace("/[^0-9]/", "", $phone ) ?>"><?php print $phone ?></a></p><?php } ?>
					<?php if ( !empty( $fax ) ) { ?><p class="contact-item"><strong>Fax:</strong><br> <a href="tel:<?php print preg_replace("/[^0-9]/", "", $fax ) ?>"><?php print $phone ?></a></p><?php } ?>
				</div>
			</div>
			<div class="main__side">
				<?php if ( !empty( $title_primary ) ) { ?><h4 class="title-primary"><?php print $title_primary ?></h4><?php } ?>
				<?php if ( !empty( $title_secondary ) ) { ?><h5 class="title-secondary"><?php print $title_secondary ?></h5><?php } ?>
				<div class="bio"><?php print $blurb; ?></div>
				<?php if ( !empty( $education ) ) { ?>
				<h5>Education</h5>
				<div class="education"><?php print $education; ?></div>
				<?php } ?>
				<?php if ( !empty( $courses ) ) { ?>
				<h5>Courses</h5>
				<div class="courses"><?php print $courses; ?></div>
				<?php } ?>
				<?php if ( !empty( $areas_of_interest ) ) { ?>
				<h5>Areas of Interest</h5>
				<div class="areas-of-interest"><?php print $areas_of_interest; ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php 
	if ( have_rows('modules') ) :
		while ( have_rows('modules') ) : the_row();
			$layout = get_row_layout();
			if ( in_array($layout, ['button', 'call_to_action_link', 'intro_text', 'table','subheading', 'snippet', 'quote', 'paragraph', 'contact-list'], true ) ) :
				print '<div class="container container--extranarrow container--paragraph">';
				get_template_part('modules/_' . get_row_layout());
				print '</div>';
			elseif ( in_array( $layout, ['horizontal_rule','accordion','tabs'], true ) ) :
				print '<div class="container container--extranarrow">';
				get_template_part('modules/_' . get_row_layout());
				print '</div>';
			else:
				get_template_part('modules/_' . get_row_layout());
			endif;
		endwhile; 
	endif;
	?>
</main>
<?php 
	endwhile;
endif;

get_footer(); ?>