<?php
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'mosley_scripts');
function mosley_scripts(){
  wp_register_script(
    'bootstrap-popper',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'bootstrap-scripts',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
    array('jquery', 'bootstrap-popper'),
    '',
    true
  );

  wp_register_script(
    'mosley-scripts',
    get_stylesheet_directory_uri() . '/js/custom-scripts.min.js',
    array('jquery', 'bootstrap-scripts'),
    '',
    true
  );

  wp_enqueue_script('bootstrap-popper');
  wp_enqueue_script('bootstrap-scripts');
  wp_enqueue_script('mosley-scripts');
}

add_filter('script_loader_tag', 'mosley_add_script_meta', 10, 2);
function mosley_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-popper':
      $tag = str_replace('></script>', ' integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

add_action('wp_enqueue_scripts', 'mosley_styles');
function mosley_styles(){
  wp_register_style(
    'google-fonts',
    'https://fonts.googleapis.com/css?family=Crimson+Text:400,600i,700&display=swap'
  );

  wp_register_style(
    'typekit-fonts',
    'https://use.typekit.net/jad8odt.css'
  );
  wp_register_style(
    'fontawesome',
    'https://use.fontawesome.com/releases/v5.6.3/css/all.css'
  );

  wp_register_style(
    'mosley-css',
    get_stylesheet_directory_uri() . '/style.css'
  );

  wp_enqueue_style('google-fonts');
  wp_enqueue_style('typekit-fonts');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('mosley-css');
}

add_filter('style_loader_tag', 'mosley_add_css_meta', 10, 2);
function mosley_add_css_meta($link, $handle){
  switch($handle){
    case 'fontawesome':
      $link = str_replace('/>', ' integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">', $link);
      break;
  }

  return $link;
}

add_action('after_setup_theme', 'mosley_setup');
function mosley_setup(){
  add_theme_support('post-thumbnails');
  //set_post_thumbnail_size(320, 320);

  register_nav_menus(array(
    'header-nav' => 'Header Navigation',
    'footer-services-nav' => 'Footer Services Navigation'
  ));

  load_theme_textdomain('mosley', get_stylesheet_directory_uri() . '/languages');
}

require_once dirname(__FILE__) . '/includes/class-wp-bootstrap-navwalker.php';

function mosley_header_fallback_menu(){ ?>
  <div id="navbar" class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown<?php if(is_page('services') || is_singular('services')){ echo ' active'; } ?>">
        <a href="#" class="nav-link dropdown-toggle text-nowrap" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo esc_html__('Services', 'mosley'); ?></a>
        <div class="dropdown-menu">
          <a href="<?php echo esc_url(home_url('services')); ?>" class="dropdown-item"><?php echo esc_html__('All Services', 'mosley'); ?></a>
          <a href="<?php echo esc_url(home_url('stormwater')); ?>" class="dropdown-item"><?php echo esc_html__('Stormwater', 'mosley'); ?></a>
          <a href="<?php echo esc_url(home_url('environmental-assessment')); ?>" class="dropdown-item"><?php echo esc_html__('Environmental Assessment', 'mosley'); ?></a>
          <a href="<?php echo esc_url(home_url('environmental-studies')); ?>" class="dropdown-item"><?php echo esc_html__('Environmental Studies', 'mosley'); ?></a>
          <a href="<?php echo esc_url(home_url('environmental-consulting')); ?>" class="dropdown-item"><?php echo esc_html__('Environmental Consulting', 'mosley'); ?></a>
        </div>
      </li>
      <li class="nav-item<?php if(is_page('about-us')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('about-us')); ?>" class="nav-link"><?php echo esc_html__('About Us', 'mosley'); ?></a>
      </li>
      <li class="nav-item<?php if(is_page('faq')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('faq')); ?>" class="nav-link"><?php echo esc_html__('FAQ', 'mosley'); ?></a>
      </li>
      <li class="nav-item<?php if(is_home()){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('news')); ?>" class="nav-link"><?php echo esc_html__('News', 'mosley'); ?></a>
      </li>
      <li class="nav-item<?php if(is_page('contact-us')){ echo ' active'; } ?>">
        <a href="<?php echo esc_url(home_url('contact-us')); ?>" class="nav-link"><?php echo esc_html__('Contact Us', 'mosley'); ?></a>
      </li>
    </ul>
  </div>
<?php }

function mosley_footer_services_fallback_menu(){ ?>
  <ul class="footer-service-list">
    <li>
      <a href="<?php echo esc_url(home_url('stormwater')); ?>"><?php echo esc_html__('Stormwater', 'mosley'); ?></a>
    </li>
    <li>
      <a href="<?php echo esc_url(home_url('environmental-assessments')); ?>"><?php echo esc_html__('Environmental Assessments', 'mosley'); ?></a>
    </li>
    <li>
      <a href="<?php echo esc_url(home_url('environmental-studies')); ?>"><?php echo esc_html__('Environmental Studies', 'mosley'); ?></a>
    </li>
    <li>
      <a href="<?php echo esc_url(home_url('environment-consulting')); ?>"><?php echo esc_html__('Environmental Consulting', 'mosley'); ?></a>
    </li>
  </ul>
<?php }

add_action('widgets_init', 'mosley_register_sidebars');
function mosley_register_sidebars(){
  register_sidebar(array(
    'name' => esc_html__('Blog Sidebar', 'mosley'),
    'id' => 'sidebar-blog',
    'description' => esc_html__('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'mosley'),
    'before_widget' => '<div class="sidebar-section">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

add_filter('block_categories', 'mosley_custom_block_category', 10, 2);
function mosley_custom_block_category($categories, $post){
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'custom-blocks',
        'title' => esc_html__('Custom Blocks', 'mosley'),
        'icon' => 'wordpress'
      )
    )
  );
}

add_action('acf/init', 'mosley_register_blocks');
function mosley_register_blocks(){
  if(function_exists('acf_register_block_type')){
    acf_register_block_type(array(
      'name' => 'callout-block',
      'title' => esc_html__('Callout Block', 'mosley'),
      'description' => esc_html__('Add a Callout Block.', 'mosley'),
      'category' => 'custom-blocks',
      'mode' => 'auto',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/callout_block.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/callout_block.css'
    ));

    acf_register_block_type(array(
      'name' => 'prestyled_button',
      'title' => esc_html__('Pre-Styled Button', 'mosley'),
      'description' => esc_html__('Add a pre-styled button.', 'mosley'),
      'category' => 'custom-blocks',
      'mode' => 'auto',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/prestyled-button.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/prestyled-button.css'
    ));

    acf_register_block_type(array(
      'name' => 'quick_link',
      'title' => esc_html__('Quick Link Block', 'mosley'),
      'description' => esc_html__('Add a Quick Link styled block.', 'mosley'),
      'category' => 'custom-blocks',
      'mode' => 'auto',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/quick-link.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/quick-link.css'
    ));
  }
}