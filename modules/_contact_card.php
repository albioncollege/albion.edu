<?php
/**
 * Contact Card Module
 * 
 * Module partial used to display contact cards custom post type.
 *
 */

$contact_cards = get_sub_field( 'contact_card' );

if( $contact_cards ): ?>
    <ul class="list--person">
<?php
    $image           = get_field( 'image', $contact_cards->ID );
    $heading         = get_field( 'heading', $contact_cards->ID );
    $position_title  = get_field( 'position_title', $contact_cards->ID );
    $secondary_title = get_field( 'secondary_title', $contact_cards->ID );
    $blurb           = get_field( 'blurb', $contact_cards->ID );
    $office          = get_field( 'office', $contact_cards->ID );
    $email           = get_field( 'email', $contact_cards->ID );
    $phone           = get_field( 'phone', $contact_cards->ID );
    $fax             = get_field( 'fax', $contact_cards->ID );
?>
        <li class="list__person">

            <?php 
            if( $image ) : 
                $image_url = wp_get_attachment_url( $image );
                $image_style   = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"';
            ?>
                <div class="list__person__image" <?php echo $image_style; ?>></div>
                <div class="list__content--person list__content--hasImage">
            <?php else : ?>
                <div class="list__content--person">
            <?php endif; ?>
            <?php if ( $heading ) : ?>
                <p class="list__person__name"><?php echo esc_html( $heading ); ?></p>
            <?php endif; ?>
            <?php if ( $position_title ) : ?>
                <p class="list__person__title"><?php echo esc_html( $position_title ); ?></p>
            <?php endif; ?>
            <?php if ( $secondary_title ) : ?>
                <p class="list__person__secondary__title"><?php echo esc_html( $secondary_title ); ?></p>
            <?php endif; ?>
            <?php if ( $blurb ) : ?>
                <p class="list__person__body"><?php echo wp_kses_post( $blurb ); ?></p>
            <?php endif; ?>
            <?php if ( ( $office ) || ( $email ) || ( $phone ) || ( $fax ) ) : ?>
                <p class="list__person__contact">
                <?php if ( $office ) : ?>
                    <strong><?php esc_html_e( 'Office:', 'albion' ); ?></strong> <?php echo esc_html( $office ); ?><br>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                    <strong><?php esc_html_e( 'Email:', 'albion' ); ?></strong> <a href="mailto:<?php echo sanitize_email( $email ); ?>"><?php echo sanitize_email( $email ); ?></a><br>
                <?php endif; ?>
                <?php if ( $phone ) : ?>
                    <strong><?php esc_html_e( 'Phone:', 'albion' ); ?></strong> <?php echo sanitize_text_field( $phone ); ?><br>
                <?php endif; ?>
                <?php if ( $fax ) : ?>
                    <strong><?php esc_html_e( 'Fax:', 'albion' ); ?></strong> <?php echo sanitize_text_field( $fax ); ?>
                <?php endif; ?>
                </p>
            <?php endif; ?>
            </div>
        </li>
    </ul>
<?php endif; // card ?>