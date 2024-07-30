<?php

$menu_name = get_field( 'nav-menu' );

$menu = wp_get_nav_menu_object( $menu_name );
if ( is_object( $menu ) ) {
    if ( $menu->count > 0 ) {
        ?>
<nav class="subnav has-submenu" aria-label="Side Navigation">
    <button class="subnav__toggle" aria-haspopup="true" aria-expanded="false">In this section</button>
    <h2 class="subnav__heading">In this section</h2>
    <?php wp_nav_menu( array( 'menu' => $menu_name, 'menu_class' => 'subnav__list' ) ); ?>
</nav>
        <?php 
    }
}
