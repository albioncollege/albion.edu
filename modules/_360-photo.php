<?php
$photo = get_sub_field( 'photo' );
$intro = get_sub_field( 'intro-text' );
$cta = get_sub_field( 'cta' );
?>
<div class="photo-360">
    <iframe allowfullscreen src="<?php bloginfo('template_url') ?>/dist/js/lib/360-photo.php?360=<?php print $photo ?>"></iframe>
    <div class="intro">
        <h4><?php print $intro ?></h4>
        <?php if ( !empty( $cta ) ) { ?><a href="<?php print $cta['url'] ?>" class="button"><?php print $cta['title'] ?></a><?php } ?>
    </div>
</div>