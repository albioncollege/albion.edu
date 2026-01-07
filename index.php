<?php // Silence is golden.
if ( is_search() ) :
    print 'search';
    include( 'search.php' );
else:
    include( 'archive.php' );
endif;
