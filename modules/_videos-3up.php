<?php

$title = get_sub_field( 'title' );
$intro = get_sub_field( 'intro' );
$color = get_sub_field( 'color' );
$videos = get_sub_field( 'video' );

if ( count( $videos ) > 0 ) {

}
?>
<div class="videos-3up background--<?php print $color; ?>">
    <div class="container container--narrow container--paragraph intro_text">
        <?php if ( !empty( $title ) ) : ?><h2><?php print $title ?></h2><?php endif; ?>
        <?php if ( !empty( $intro ) ) : ?><div class="intro"><?php print $intro ?></div><?php endif; ?>
        <div class="videos-3up-inner">
        <?php foreach ( $videos as $video ) : ?>
            <div class="vid">
            <video width='720' height='1280' controls>
                <source src="<?php print $video['url']; ?>" type="video/mp4">
            </video>
            <?php if ( !empty( $video['title'] ) && !empty( $video['caption'] ) ) : ?>
            <div class="vid-caption">
                <h4><?php print $video['title']; ?></h4>
                <p><?php print $video['caption']; ?></p>
            </div>
            <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>