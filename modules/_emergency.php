<?php

$content = get_sub_field( 'content' );
$color = get_sub_field( 'color' );

if ( !empty( $content ) ) {
    ?>
<div class="emergency <?php print $color ?>">
    <!--<a class="close">X</a>-->
    <?php print $content ?>
</div>
    <?php
}

?>