<?php

$photo = get_sub_field( 'photo' );
if ( !empty( $photo ) ) {
    ?><img src="<?php print $photo ?>" /><?php
}

?>