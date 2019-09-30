<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <article>
        <?php echo apply_filters('the_content', wp_kses_post(get_field('news_page_intro', 'option'))); ?>
      </article>
    </div>

    <?php get_template_part('partials/latest_news'); ?>

    <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged'): 1;
      $per_page = 5;
      $default_offset = 3;

      if($paged == 1){
        $offset = $default_offset;
      }
      else{
        $offset = (($paged - 1) * $per_page) + $default_offset;
      }

      $blog_posts = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'offset' => $offset
      ));
    ?>

    <section id="blog-loop">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <?php if($blog_posts->have_posts()): ?>

                <div class="archive-loop">
                  <?php while($blog_posts->have_posts()): $blog_posts->the_post(); ?>

                    <div class="media blog-loop-item">
                      <?php
                        if(has_post_thumbnail()){
                          $post_image_url = get_the_post_thumbnail_url('full');
                          $post_image_id = get_post_thumbnail_id();
                          $post_image_alt = get_post_meta($post_image_id, '_wp_attachment_image_alt', true);
                        }
                        else{
                          $post_image_url = get_stylesheet_directory_uri() . '/images/blog-placeholder.png';
                          $post_image_alt = '';
                        }
                      ?>
                      <img src="<?php echo esc_url($post_image_url); ?>" alt="<?php echo esc_attr($post_image_alt); ?>" />
                      <div class="media-body">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('Find Out More', 'mosley'); ?></a>
                      </div>
                    </div>

                  <?php endwhile; ?>
                </div>

            <?php endif; ?>
            <div class="pagination"><?php wp_pagenavi(array('query' => $blog_posts)); ?></div>
          </div>
          <div class="col-lg-4">
            <?php get_sidebar('blog'); ?>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer();