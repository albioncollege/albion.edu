<?php
/*
Template Name: Program
Template Post Type: page
*/
?>

<?php get_header(); ?>
<main class="page" id="main-content">
    <!-- REGION: Alert -->

    <!-- /REGION: Alert -->
    <?php get_template_part('modules/_program_introduction'); ?>

    <div class="main main--program">
        <div class="main__inner">
            <?php get_template_part('modules/_program_calls_to_action'); ?>
            <div class="main__side">
                <div class="program__intro">
                    <?php 
                    $image = get_field('image');
                    $size  = 'routing';
                    if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size, '', array( "class" => "program__header__image" ) ); ?>
                    <?php endif; ?>
                    <?php get_template_part('modules/_program_overview'); ?>
                    <?php get_template_part('modules/_program_learning_objectives'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('modules/_program_attributes'); ?>

    <?php get_template_part('modules/_program_highlights'); ?>

    <?php get_template_part('modules/_program_faculty_quotes'); ?>

    <?php get_template_part('modules/_program_feature'); ?>

    <?php get_template_part('modules/_program_careers_outcomes'); ?>

    <?php get_template_part('modules/_program_by_the_numbers'); ?>

    <?php get_template_part('modules/_program_additional_information'); ?>

    <?php get_template_part('modules/_program_related_programs'); ?>

    <?php get_template_part('modules/_program_news_panel'); ?>

</main>

<?php get_footer(); ?>