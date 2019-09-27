<?php get_header(); ?>
<main id="main">
  <div class="container">
    <article>
      <?php
        if(have_posts()){
          while(have_posts()){
            the_post();

            the_content(); 
          }
        }
        else{
          echo '<p>' . esc_html__('Sorry, we could not find what you were looking for.', 'mosley') . '</p>';
        }
      ?>
    </article>
  </div>
</main>
<?php get_footer();