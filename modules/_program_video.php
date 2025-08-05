<?php

$video = get_field('program_video');

if ( !empty( $video ) ) : ?>
<div class="program__video">
    <?php the_field('program_video') ?>
</div>
<?php endif; ?>
