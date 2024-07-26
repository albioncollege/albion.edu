<?php
/**
 * Header Module
 * 
 * Module partial used to display content in the header.
 *
 */

?>

<header id="main-nav" class="header">
    <div class="header__topbar header__topbar--sticky">
        <?php if( have_rows('action_buttons', 'options') ): ?>
            <ul class="header__topbar__left">
            <?php 
                while( have_rows('action_buttons', 'options') ) : the_row();
                    $button_link = get_sub_field( 'link' );
                    $svg_select  = get_sub_field( 'svg_select' );
                    $sticky_nav_text  = get_sub_field( 'sticky_nav_text' );
                    if( $button_link ): 
                        $link_url    = $button_link['url'];
                        $link_title  = $sticky_nav_text ? $sticky_nav_text : $button_link['title'];
                        if ( $link_title ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $link_url ); ?>" <?php echo link_target( $button_link ); ?>>
                                    <?php echo svgstore('icon-' . $svg_select, $svg_select, 'header__topbar__icon'); ?>
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            </li>
                <?php
                        endif;
                    endif;
                endwhile; 
                ?>
            </ul>
        <?php endif; ?>
        <a href="<?php echo esc_url( home_url() ); ?>" class="header__topbar__logolink">
            <?php echo svgstore('pin-logo', 'Albion College', 'header__topbar__logo'); ?>
        </a>
        <ul class="header__topbar__right">
            <li>
                <button class="header__toggle--search toggle-search" aria-controls="main-search" aria-expanded="false" aria-label="Reveal Search">
                    <?php echo svgstore('icon-search', 'Search', ''); ?>
                </button>
            </li>
            <li>
                <button class="header__toggle--menu toggle-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Reveal Navigation">
                    <?php echo svgstore('icon-menu', '', ''); ?>
                </button>
            </li>
        </ul>
    </div>

    <div class="header__topbar">
        <?php if( have_rows('action_buttons', 'options') ): ?>
            <ul class="header__topbar__left">
            <?php 
                while( have_rows('action_buttons', 'options') ) : the_row();
                    $button_link = get_sub_field( 'link' );
                    $svg_select  = get_sub_field( 'svg_select' );
                    if( $button_link ): 
                        $link_url    = $button_link['url'];
                        $link_title  = $button_link['title'];
                        if ( $link_title ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $link_url ); ?>" <?php echo link_target( $button_link ); ?>>
                                    <?php echo svgstore('icon-' . $svg_select, $svg_select, 'header__topbar__icon'); ?>
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            </li>
                <?php
                        endif;
                    endif;
                endwhile; 
                ?>
            </ul>
        <?php endif; ?>
        <?php
            if ( has_nav_menu( 'audience' ) ) {
                wp_nav_menu([
                    'theme_location' => 'audience',
                    'menu_class'     => 'header__topbar__right',
                ]);
            }
        ?>
    </div>
    
    <div class="header__container">
        <!-- REGION: Header Nav -->
        <div class="header__wrap">
            <div class="header__left">
                <button class="header__toggle--search toggle-search" aria-controls="main-search"
                    aria-expanded="false" aria-label="Reveal Search">
                    <?php echo svgstore('icon-search', 'Search', ''); ?>
                    <span class="header__nav__text">Search</span>
                </button>
            </div>
            <a href="<?php echo esc_url( home_url() ); ?>" class="header__logo">
                <?php echo svgstore('logo', 'Albion College', 'header__logo--default'); ?>
            </a>
            <div class="header__right">
                <button class="header__toggle--menu toggle-menu" aria-controls="main-menu" aria-expanded="false"
                    aria-label="Reveal Navigation">
                    <span class="header__nav__text">Menu</span>
                    <?php echo svgstore('icon-menu', '', ''); ?>
                </button>

                <ul class="header__cta">
                    <li><a href="#" class="button__link">Give</a></li>
                    <li><a href="#" class="button__link">Visit</a></li>
                    <li><a href="#" class="button__link">Apply Now</a></li>
                </ul>
            </div>
        </div>

        <div class="header__flyout container--purple">
            <div class="header__menu">
                <div class="header__scroll">
                    <div class="header__main">
                        <nav class="nav" id="main-menu">
                            <button class="header__link toggle-menu" aria-label="Close Navigation" aria-expanded="true">Close</button>
                            <div class="nav__grid">
                                <div>
                                    <?php
                                        if ( has_nav_menu( 'primary' ) ) {
                                            wp_nav_menu([
                                                'theme_location' => 'primary',
                                                'menu_class'     => 'nav__primary',
                                                'li_class'       => 'nav__primary__item',
                                                'link_class'     => 'nav__primary__link',
                                            ]);
                                        }
                                    ?>
                                </div>

                                <div>
                                    <?php
                                        if ( has_nav_menu( 'audience' ) ) {
                                            wp_nav_menu([
                                                'theme_location' => 'audience',
                                                'menu_class'     => 'nav__secondary',
                                                'li_class'       => 'nav__secondary__item',
                                                'link_class'     => 'nav__secondary__link',
                                            ]);
                                        }
                    
                                        if ( has_nav_menu( 'action' ) ) {
                                            wp_nav_menu([
                                                'theme_location' => 'action',
                                                'menu_class'     => 'nav__secondary nav__secondary--light',
                                                'li_class'       => 'nav__secondary__item',
                                                'link_class'     => 'nav__secondary__link',
                                            ]);
                                        }
                                    ?>
                                    <?php 
                                        $give_button = get_field('give_button', 'options'); 
                                        if( $give_button ): 
                                            $link_url    = $give_button['url'];
                                            $link_title  = $give_button['title'];
                                            if ( $link_title ) : ?>
                                                <a href="<?php echo esc_url( $link_url ); ?>" class="button button--icon" <?php echo link_target( $give_button ); ?>>
                                                    <?php echo svgstore('icon-gift', $link_title, 'button--svg'); ?>
                                                    <?php echo esc_html( $link_title ); ?>
                                                </a>
                                            <?php
                                            endif;
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="header__search">
                <div class="header__scroll">
                    <div class="header__main">
                        <div class="search" id="main-search">
                            <button class="header__link toggle-search" aria-label="Close Search" aria-expanded="false">Close</button>
                            <form class="search__container" method="get" action="<?php echo home_url('/search/'); ?>">
                                <div class="search__input__container">
                                    <label for="site-search" class="screen-reader-text">Search</label>
                                    <input id="site-search" type="search" name="q" class="search__input"
                                        placeholder="Search Albion">
                                    <button type="submit" class="button">SEARCH</button>
                                </div>

                                <?php if( have_rows('explore_more', 'options') ): ?>
                                    <p class="search__results__label"><?php esc_html_e( 'Explore More:', 'albion' ); ?></p>
                                    <div class="link-carousel">
                                        <ul>
                                        <?php 
                                            while( have_rows('explore_more', 'options') ) : the_row();
                                                $link  = get_sub_field( 'link' );
                                                $image = get_sub_field('image');
                                                $size  = 'explore-more'; 
                                                if( $link ): 
                                                    $link_url    = $link['url'];
                                                    $link_title  = $link['title'];
                                                    if ( $link_title ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $link_url ); ?>" class="nav__secondary__link" <?php echo link_target( $link ); ?>>
                                                                <?php 
                                                                if( $image ) : 
                                                                    $image_url = wp_get_attachment_url( $image );
                                                                    $image_style   = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"';
                                                                ?>

                                                                    <div class="link-carousel__image" <?php echo $image_style; ?>></div>
                                                                <?php endif;?>
                                                                <div class="link-carousel__name">
                                                                    <?php echo esc_html( $link_title ); ?>
                                                                </div>
                                                            </a>
                                                        </li>
                                            <?php
                                                    endif;
                                                endif;
                                            endwhile; 
                                            ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /REGION: Header Nav -->
    </div>
</header>