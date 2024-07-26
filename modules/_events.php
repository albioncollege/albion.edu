<?php

/**
 * Events Module
 * 
 * Module partial used to display events from The Events Calendar plugin.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$background_color = get_sub_field( 'background_color' );
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$type             = get_sub_field( 'display_type' );
$number           = 3;

if ($type == 'filtered') {
    $terms = get_sub_field('category');

    if($terms){
        $events = tribe_get_events( [
            'ends_after' => 'now',
            'tax_query' => array(
                array(
                'taxonomy' => 'tribe_events_cat',
                'field'    => 'term_id',
                'terms'    => $terms,
                ),
            ),
            'posts_per_page' => $number,
        ]);
    } else {
        $events = tribe_get_events([
          'ends_after' => 'now',
          'posts_per_page' => $number,
        ]);
    }
} else {
    $events = get_sub_field( 'events' );
}

if ($events) : ?>
    <!-- EVENTS MODULE -->
    <div class="events__component">
        <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
            <div class="container">
                <div class="events">
                    <div class="event__header">
                        <?php if( $subheading ) : ?>
                            <?php if( $subheading_level == 'h2' ) : ?>
                                <h2 class="h3"><?php echo esc_html( $subheading ); ?></h2>
                            <?php elseif( $subheading_level == 'h3' ) : ?>
                                <h3><?php echo esc_html( $subheading ); ?></h3>
                            <?php elseif( $subheading_level == 'h4' ) : ?>
                                <h4 class="h3"><?php echo esc_html( $subheading ); ?></h4>
                            <?php elseif( $subheading_level == 'h5' ) : ?>
                                <h5 class="h3"><?php echo esc_html( $subheading ); ?></h5>
                            <?php elseif( $subheading_level == 'h6' ) : ?>
                                <h6 class="h3"><?php echo esc_html( $subheading ); ?></h6>
                            <?php else : ?>
                                <div class="h3"><?php echo esc_html( $subheading ); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if( have_rows( 'routing_links' ) ) : ?>
                            <div class="events__links large-screen">
                                <?php while( have_rows( 'routing_links' ) ) : the_row();
                                    $link = get_sub_field( 'link' );
                                    if( $link ) : 
                                        $link_url    = $link['url'];
                                        $link_title  = $link['title'];
                                        if ( $link_title ) : ?>
                                            <a href="<?php echo esc_url( $link_url ); ?>" class="events__link" <?php echo link_target( $link ); ?>><?php echo esc_html( $link_title ); ?></a>                
                                        <?php endif; //link_title ?>
                                    <?php endif; //routing_link ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="events__group">
                        <?php foreach( $events as $event ): 
                            $event_title      = get_the_title( $event->ID );
                            $event_link       = get_permalink( $event->ID );
                            $event_multiday   = tribe_event_is_multiday( $event->ID );
                            $event_start_date = tribe_get_start_date( $event->ID, false, 'F j, Y' );
                            $event_end_date   = tribe_get_end_date( $event->ID, false, 'F j, Y' );
                            $event_all_day    = tribe_event_is_all_day( $event->ID );
                            $event_start_time = tribe_get_start_time( $event->ID, tribe_get_time_format() );
                            $event_end_time   = tribe_get_end_time( $event->ID, tribe_get_time_format() );
                            $event_venue      = tribe_get_venue_link( $event->ID, true ); ?>
                            <div class="event__card background--purple-gray">
                                <?php if ( ! $event_multiday ) : ?>
                                    <p class="event__card--date"><?php echo $event_start_date ?></p>
                                <?php else : ?>
                                    <p class="event__card--date"><?php echo $event_start_date ?> <?php echo esc_html_e( '-', 'albion' ); ?> <?php echo $event_end_date ?></p>
                                <?php endif; ?>
                                <?php if ( $event_title ) : ?>
                                    <p class="event__card--title text-large">
                                    <?php if ( $event_link ) : ?>
                                        <a href="<?php echo esc_url( $event_link ); ?>">
                                    <?php endif; ?>
                                        <?php echo esc_html( $event_title ); ?>
                                    <?php if ( $event_link ) : ?>
                                        </a>
                                    <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                <div class="event__details">
                                    <?php if ( $event_start_time ) : ?>
                                        <p class="event__datetime">
                                            <?php echo svgstore('time', 'Time', ''); ?>
                                            <?php echo $event_start_time ?> <?php echo esc_html_e( '-', 'albion' ); ?> <?php echo $event_end_time ?>
                                        </p>
                                    <?php elseif ( $event_all_day ) : ?>
                                        <p class="event__datetime">
                                            <?php echo svgstore('time', 'Time', ''); ?>
                                            <?php echo esc_html_e( 'All day', 'albion' ); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ( $event_venue ) : ?>
                                        <p class="event__location">
                                            <?php echo svgstore('icon-location-pin', 'Location', ''); ?>
                                            <?php echo esc_html( $event_venue ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- mobile links block -->
                    <div class="events__links mobile">
                        <?php while( have_rows( 'routing_links' ) ) : the_row();
                            $link = get_sub_field( 'link' );
                            if( $link ) : 
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                if ( $link_title ) : ?>
                                    <a href="<?php echo esc_url( $link_url ); ?>" class="events__link" <?php echo link_target( $link ); ?>><?php echo esc_html( $link_title ); ?></a>                
                                <?php endif; //link_title ?>
                            <?php endif; //routing_link ?>
                        <?php endwhile; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif; //events. ?>