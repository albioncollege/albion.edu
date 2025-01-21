<?php

if ( have_rows( 'slides' ) ) : ?>
<div class="showcase-container">
    <div class="showcase">
    <?php 
    $slide_controls = '';

    while ( have_rows( 'slides' ) ) : the_row();
        $row_index = get_row_index();
        $slide_image = get_sub_field( 'photo' );
        $slide_heading = get_sub_field( 'heading' );
        $slide_subheading = get_sub_field( 'subheading' );
        $slide_link = get_sub_field( 'link' );

        $image_style = 'style="background-image: url( ' . esc_url( $slide_image ) . ' );"';
        ?>
    <div data-slide="<?php print $row_index; ?>" class="slide<?php print ( get_row_index()==1 ? ' active' : '' ); ?>" <?php echo $image_style; ?>>
        <?php if ( $slide_link ) : ?><a href="<?php print $slide_link ?>"><?php endif; ?>
        <div class="slide_content container--purple">
            <?php if ( !empty( $slide_heading ) ) { ?>
                <h1 class="slide_content_headlines"><?php print $slide_heading; ?>
                <?php if ( !empty( $slide_subheading ) ) { ?><span><?php print $slide_subheading ?></span></h1><?php } ?>
            <?php } ?>
        </div>
        <?php if ( $slide_link ) : ?></a><?php endif; ?>
    </div>
        <?php
        $slide_controls .= '<a data-slide="' . $row_index . '"></a>';
    endwhile;
    ?>
    </div>
    <div class="controls-container">
        <div class="controls">
            <a class="prev">&raquo; Prev</a>
            <?php print $slide_controls; ?>
            <a class="next">Next &raquo;</a>
        </div>
    </div>
</div>
<?php endif; ?>


