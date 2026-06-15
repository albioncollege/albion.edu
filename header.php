<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <?php wp_head(); ?>
    <script src="https://25live.collegenet.com/pro/embedding-client-code/embedded25.js"></script>
  </head>
  <body <?php body_class(); ?>>
    <nav aria-label="Skip to Sections">
      <a class="skip-link" href="#main-nav">Skip to Navigation</a>
      <a class="skip-link toggle-search" href="#main-search">Skip to Search</a>
      <a class="skip-link" href="#main-content">Skip to Main Content</a>
      <a class="skip-link" href="#footer">Skip to Footer Links</a>
    </nav>
    <!-- <div class="canvas"> -->
      <?php get_template_part( 'modules/_header' ); ?>
      