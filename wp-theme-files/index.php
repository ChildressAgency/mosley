<?php get_header(); ?>
<main id="main">
  <div class="container">
    <?php
      if(have_posts()){
        while(have_posts()){
          the_post();

          if(is_singular()){
            echo '<article>';
              the_content();
            echo '</article>';
          }
          else{
            echo '<div class="loop-item">';
              echo '<h3>' . get_the_title() . '</h3>';
              the_excerpt();
              echo '<a href="' . get_permalink() . '" class="read-more">' . esc_html__('Read more', 'mosley') . '</a>';
            echo '</div>';
          }
        }
        echo '<div class="pagination">';
        wp_pagenavi();
        echo '</div>';
      }
      else{
        echo '<p>' . esc_html__('Sorry, we could not find what you were looking for.', 'mosley') . '</p>';
      }
    ?>
  </div>
</main>
<?php get_footer();