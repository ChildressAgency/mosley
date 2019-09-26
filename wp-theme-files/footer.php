<?php if(!is_page('contact-us')): ?>
  <section id="contact">
    <div class="row no-gutters">
      <div class="col-lg-6 image-side">
        <?php 
          $contact_section_image = get_field('contact_section_image', 'option'); 
          if($contact_section_image): ?>
            <img src="<?php echo esc_url($contact_section_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($contact_section_image['alt']); ?>" />
      </div>
      <div class="col-lg-6 text-side">
        <?php echo do_shortcode(get_field('contact_section_form_shortcode')); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if(have_rows('affiliations', 'option')): ?>
  <section id="affiliations">
    <div class="container">
      <h2 class="section-title"><?php echo esc_html__('Affiliations', 'option'); ?></h2>
      <ul class="affiliation-list">
        <?php while(have_rows('affiliations', 'option')): the_row(); ?>
          <?php
            $affiliate_link = get_sub_field('affiliate_link');
            $affiliate_image = get_sub_field('affiliate_image');
          ?>
          <li>
            <?php if($affiliate_link){ echo '<a href="' . esc_url($affiliate_link['url']) . '" target="_blank">'; } ?>
              <img src="<?php echo esc_url($affiliate_image['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($affiliate_image['alt']); ?>" />
            <?php if($affiliate_link){ echo '</a>'; } ?>
          </li>

        <?php endwhile; ?>
      </ul>
    </div>
  </section>
<?php endif; ?>

  <footer id="footer">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-md-5">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.png" class="img-fluid d-block" alt="<?php echo esc_attr(bloginfo('name')); ?>" />
        </div>
        <div class="col-md-7 footer-nav">
          <div class="row">
            <div class="col-md-6">
              <a href="<?php echo esc_url(home_url('services')); ?>" class="footer-nav-link"><?php echo esc_html__('Services', 'mosley'); ?></a>
              <?php
                $services_nav_args = array(
                  'theme_location' => 'footer-services-nav',
                  'menu' => '',
                  'container' => '',
                  'container_id' => '',
                  'container_class' => '',
                  'menu_id' => '',
                  'menu_class' => 'footer-service-list',
                  'echo' => true,
                  'fallback_cb' => 'mosley_footer_services_fallback_menu',
                  'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                  'depth' => 1,
                );
                wp_nav_menu($services_nav_args);
              ?>
            </div>
            <div class="col-md-6">
              <a href="<?php echo esc_url(home_url('about-us')); ?>" class="footer-nav-link"><?php echo esc_html__('About Us', 'mosley'); ?></a>
              <a href="<?php echo esc_url(home_url('faq')); ?>" class="footer-nav-link"><?php echo esc_html__('FAQ', 'mosley'); ?></a>
              <a href="<?php echo esc_url(home_url('contact-us')); ?>" class="footer-nav-link"><?php echo esc_html__('Contact Us', 'mosley'); ?></a>

              <?php get_template_part('partials/social'); ?>
            </div>
          </div>
          <?php
            $email = get_field('email', 'option');
            $phone = get_field('phone', 'option'); 
          ?>
          <p class="email-phone"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>&nbsp;|&nbsp;<a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></p>
        </div>
      </div>
      <p class="colophon">&copy;<?php echo date('Y'); ?> <?php echo esc_html(bloginfo('name')); ?>&nbsp;|&nbsp; Website by <a href="https://childressagency.com" target="_blank">Childress Agency</a></p>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>