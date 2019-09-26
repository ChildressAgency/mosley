<?php get_header(); ?>
  <main id="main">
    <section id="hp-about">
      <div class="container">
        <?php
          if(have_posts()){
            while(have_posts()){
              the_post();

              echo '<article>';
                the_content();
              echo '</article>';
            }
          }
        ?>
        <div class="card-deck">
          <div class="card about-card">
            <?php
              $mission_image = get_field('mission_image');
              if($mission_image): ?>
                <img src="<?php echo esc_url($mission_image['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($mission_image['alt']); ?>" />
            <?php endif; ?>
            <div class="card-body">
              <h3 class="card-title"><?php echo esc_html(get_field('mission_title')); ?></h3>
              <p class="card-text"><?php echo esc_html(get_field('mission_text')); ?></p>
            </div>
          </div>

          <div class="card about-card">
            <?php
              $passion_image = get_field('passion_image');
              if($passion_image): ?>
                <img src="<?php echo esc_url($passion_image['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($passion_image['alt']); ?>" />
            <?php endif; ?>
            <div class="card-body">
              <h3 class="card-title"><?php echo esc_html(get_field('passion_title')); ?></h3>
              <p class="card-text"><?php echo esc_html(get_field('passion_text')); ?></p>
            </div>
          </div>
        </div>

        <a href="<?php echo esc_url(home_url('about-us')); ?>" class="btn-main btn-lg"><?php echo esc_html__('About Us', 'mosley'); ?></a>
      </div>
    </section>

    <?php if(have_rows('services')): ?>
      <section id="hp-services">
        <div class="row no-gutters">
          <?php while(have_rows('services')): the_row(); ?>

            <div class="col-md-6 col-lg-3">
              <?php 
                $service_image = get_sub_field('service_image');
                $service_link = get_sub_field('service_link');
              ?>
              <a href="<?php echo esc_url($service_link['url']); ?>" class="hp-service" style="background-image:url(<?php echo esc_url($service_image['url']); ?>);">
                <h2 class="service-title"><?php echo esc_html(get_sub_field('service_title')); ?></h2>
                <div class="service-card">
                  <h3 class="service-card-title"><?php echo esc_html(get_sub_field('service_title')); ?></h3>
                  <hr />
                  <p><?php echo esc_html(get_sub_field('service_description')); ?></p>
                  <div class="service-card-footer">
                    <span><?php echo esc_html__('Learn More', 'mosley'); ?></span>
                  </div>
                </div>
                <div class="overlay"></div>
              </a>
            </div>

          <?php endwhile; ?>
        </div>

        <div class="row no-gutters">
          <div class="col-lg-6 offset-lg-3">
            <a href="<?php echo esc_url(home_url('services')); ?>" class="btn-main btn-lg btn-block"><?php echo esc_html__('View All Services', 'mosley'); ?></a>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if(have_rows('quick_access_links')): ?>
      <section id="quick-links">
        <div class="container">
          <h2 class="section-title"><?php echo esc_html(get_field('quick_access_links_section_title')); ?></h2>
          <div class="row">
            <?php $i = 0; while(have_rows('quick_access_links')): the_row(); ?>
              <?php if($i % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>

              <div class="col-lg-6">
                <div class="media">
                  <?php $quick_link_image = get_sub_field('quick_link_image'); ?>
                  <img src="<?php echo esc_url($quick_link_image['url']); ?>" alt="<?php echo esc_attr($quick_link_image['alt']); ?>" />
                  <div class="media-body">
                    <?php $quick_link = get_sub_field('quick_link'); ?>
                    <h3><a href="<?php echo esc_url($quick_link['url']); ?>"><?php echo esc_html($quick_link['title']); ?></a></h3>
                    <p><?php echo esc_html(get_sub_field('quick_link_description')); ?></p>
                  </div>
                </div>
              </div>

            <?php $i++; endwhile; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php
      $latest_news = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => '3',
        'post_status' => 'publish'
      ));

      if($latest_news->have_posts()): ?>
        <section id="latest-news">
          <div class="container">
            <h2 class="section-title"><?php echo esc_html__('Latest News', 'mosley'); ?></h2>
            <div class="card-deck latest-loop">
              <?php while($latest_news->have_posts()): $latest_news->the_post(); ?>

                <div class="card">
                  <?php 
                    if(has_post_thumbnail()){
                      $post_image_url = get_the_post_thumbnail_url('full');
                      $post_image_id = get_post_thumbnail_id();
                      $post_image_alt = get_post_meta($post_image_id, '_wp_attachment_image_alt', true);
                    }
                    else{
                      $post_image = get_field('default_post_featured_image', 'option');
                      $post_image_url = $post_image['url'];
                      $post_image_alt = $post_image['alt'];
                    }
                  ?>
                  <img src="<?php echo esc_url($post_image_url); ?>" class="card-img-top" alt="<?php echo esc_attr($post_image_alt); ?>" />
                  <div class="card-body">
                    <h3 class="card-title"><?php the_title(); ?></h3>
                    <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('Find Out More', 'mosley'); ?></a>
                  </div>
                </div>

              <?php endwhile; ?>
            </div>
        </section>
    <?php endif; ?>
  </main>
<?php get_footer();