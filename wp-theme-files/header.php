<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <?php wp_head(); ?>

  <title><?php echo esc_html(bloginfo('name')); ?></title>
</head>

<body <?php body_class(); ?>>
  <header id="header">
    <div class="masthead">
      <div class="container">
        <?php get_template_part('partials/social'); ?>
      </div>
    </div>

    <nav id="header-nav" class="navbar navbar-light navbar-expand-lg">
      <div class="container">
        <a href="<?php echo esc_url(home_url()); ?>" class="navbar-brand" aria-label="<?php echo esc_attr(bloginfo('name')) ;?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" class="img-fluid" alt="<?php echo esc_attr(bloginfo('name')); ?>" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <?php
          $header_nav_args = array(
            'theme_location' => 'header-nav',
            'menu' => '',
            'container' => 'div',
            'container_id' => 'navbar',
            'container_class' => 'collapse navbar-collapse',
            'menu_id' => '',
            'menu_class' => 'navbar-nav ml-auto',
            'echo' => true,
            'fallback_cb' => 'mosley_header_fallback_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
            'walker' => new WP_Bootstrap_NavWalker()
          );
          wp_nav_menu($header_nav_args);
        ?>

      </div>
    </nav>
  </header>

  <?php
    $hero_image = get_field('hero_background_image');
    $hero_image_css = get_field('hero_background_image_css');
    if(!$hero_image){
      $hero_image = get_field('default_hero_background_image', 'option');
      $hero_image_css = get_field('default_hero_background_image_css', 'option');
    }
  ?>
  <section id="hero"<?php if(is_front_page()){ echo ' class="hp-hero"'; } ?> style="background-image:url(<?php echo esc_url($hero_image); ?>); <?php echo esc_attr($hero_image_css); ?>">
    <div class="container">
      <div class="hero-caption">
        <?php 
          $hero_caption_image = get_field('hero_caption_image');
          if($hero_caption_image): ?>
            <img src="<?php echo esc_url($hero_caption_image['url']); ?>" class="img-fluid d-block mx-auto mb-5" alt="<?php echo esc_attr($hero_caption_image['alt']); ?>" />
        <?php endif; ?>
        <h2><?php echo wp_kses_post(get_field('hero_caption')); ?></h2>
      </div>
    </div>
    <?php if(is_front_page()): ?>
      <span class="scroll">Scroll</span>
    <?php endif; ?>
    <div class="overlay green"></div>
  </section>
