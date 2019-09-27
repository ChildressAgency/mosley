<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <article class="text-center">
        <?php
          if(have_posts()){
            while(have_posts()){
              the_post();

              the_content();
            }
          }
        ?>
      </article>
    </div>

    <section id="contact-us">
      <div class="container">
        <?php echo do_shortcode(get_field('contact_form_shortcode')); ?>
      </div>
    </section>
  </main>

<?php get_footer();