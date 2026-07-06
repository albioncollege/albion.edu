<?php

$image = get_sub_field( 'image' );
$content = get_sub_field( 'content' );
$reversed = get_sub_field( 'reversed' );

if ( !empty( $image ) && !empty( $content ) ) :
?>
<div class="split-image-content<?php print ( $reversed ? ' reversed' : '' ); ?>">
    <div class="split-image-content-image">
        <img src="<?php print $image ?>">
    </div>
    <div class="split-image-content-content">
        <?php print $content ?>
    </div>
</div>
<?php
endif;