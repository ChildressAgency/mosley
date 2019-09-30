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
        ?>
      </article>
    </div>

    <?php if(have_rows('faqs')): ?>
      <section id="faqs">
        <div class="container">
          <div id="faqs-accordion" class="accordion">
            <?php $c = 1; while(have_rows('faqs')): the_row(); ?>

              <div class="card">
                <div id="question-<?php echo $c; ?>" class="card-header">
                  <h3>
                    <a href="#answer-<?php echo $c; ?>" class="collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="answer-<?php echo $c; ?>">
                      <span class="expander"></span>
                      <?php echo esc_html(get_sub_field('question')); ?>
                    </a>
                  </h3>
                </div>
                <div id="answer-<?php echo $c; ?>" class="collapse" aria-labelledby="question-<?php echo $c; ?>" data-parent="#faqs-accordion">
                  <div class="card-body">
                    <?php echo wp_kses_post(get_sub_field('answer')); ?>
                  </div>
                </div>
              </div>

            <?php $c++; endwhile; ?>

          </div>
        </div>
      </section>
    <?php endif; ?>
  </main>
<?php get_footer();