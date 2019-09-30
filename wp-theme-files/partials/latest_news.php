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
                  $post_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
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
