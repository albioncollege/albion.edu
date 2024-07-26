<?php
/**
 * Class Notes Module
 * 
 * Module partial used to display class notes from the Class Notes custom post type.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$intro_text       = get_sub_field( 'intro_text' );
$routing_link     = get_sub_field( 'routing_link' );
$type             = get_sub_field( 'display_type' );

if ($type == 'filtered') {
  $terms  = get_sub_field('category');
  $number = get_sub_field( 'number' );

  if( empty( $number ) ){
    $number = 4;
  }
  if($terms){
    $class_notes = get_posts([
      'post_type'     => 'class_notes',
      'tax_query'     => array(
          array(
            'taxonomy' => 'class_notes_category',
            'field'    => 'term_id',
            'terms'    => $terms,
          ),
        ),
      'numberposts' => $number,
    ]);
  } else {
    $class_notes = get_posts([
      'post_type'   => 'class_notes',
      'numberposts' => $number,
    ]);
  }
} else {
    $class_notes = get_sub_field( 'class_notes' );
}
if ($class_notes) : ?>

  <div class="class-notes__component">
    <div class="background background--purple-pattern">
      <div class="container container--purple">
        <?php if( $subheading ) : ?>
          <?php if( $subheading_level == 'h2' ) : ?>
            <h2 class="journey__heading"><?php echo esc_html( $subheading ); ?></h2>
          <?php elseif( $subheading_level == 'h3' ) : ?>
            <h3 class="journey__heading h2"><?php echo esc_html( $subheading ); ?></h3>
          <?php elseif( $subheading_level == 'h4' ) : ?>
            <h4 class="journey__heading h2"><?php echo esc_html( $subheading ); ?></h4>
          <?php elseif( $subheading_level == 'h5' ) : ?>
            <h5 class="journey__heading h2"><?php echo esc_html( $subheading ); ?></h5>
          <?php elseif( $subheading_level == 'h6' ) : ?>
            <h6 class="journey__heading h2"><?php echo esc_html( $subheading ); ?></h6>
          <?php else : ?>
            <div class="journey__heading h2"><?php echo esc_html( $subheading ); ?></div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="text-large"><?php echo esc_html($intro_text); ?></div>

        <div class="grid grid--25-25-25-25">
          <?php foreach( $class_notes as $note ) : 
            $note_heading = get_field( 'heading', $note->ID );
            $note_content = get_field( 'content', $note->ID ); ?>
            <div class="class-notes__column">
              <p class="text-small"><span class="text-teal"><b><?php echo esc_html( $note_heading); ?></b></span> <?php echo wp_kses_post( strip( $note_content ) ); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <?php if( $routing_link ) : 
          $link_url    = $routing_link['url'];
          $link_title  = $routing_link['title'];
          if ( $link_title ) : ?>
            <div class="text-center">
              <a href="<?php echo esc_url( $link_url ); ?>" class="button" <?php echo link_target( $routing_link ); ?>><?php echo esc_html( $link_title ); ?></a>
            </div>            
          <?php endif; //link_title ?>
        <?php endif; //routing_link ?>
      </div>
    </div>
  </div>
<?php endif; ?>